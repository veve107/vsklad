<?php

namespace App\Http\Controllers;

use App\Mail\RequestVerification;
use App\Models\Hardware\Device;
use App\Models\Hardware\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\VarDumper\VarDumper;

class RequestController extends Controller
{
    public function index()
    {
        $requests = \App\Models\Request::all();
        return view('admin.request.request_index', compact('requests'));
    }

    public function add()
    {
        $types = Type::all();
        return view('admin.request.add_request', compact('types'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'reason' => 'required|max:255',
            'types' => 'required|array|min:1',
        ]);
        $r = new \App\Models\Request();
        $r->user_id = Auth::user()->id;
        $r->reason = $request->reason;
        $r->save();
        foreach ($request->types as $type) {
            $t = Type::find($type);
            $r->types()->attach($t);
        }

        $notification = array(
            'message' => 'Žiadosť úspešne zadaná.',
            'alert-type' => 'success',
        );
        return Redirect()->route('request.index')->with($notification);
    }

    public function process($id)
    {
        $request = \App\Models\Request::find($id);
        if (empty($request->user->department)) {
            $notification = array(
                'message' => 'Žiadateľ nemá nastavené oddelenie! Doplniť!',
                'alert-type' => 'error',
            );
            return Redirect()->back()->with($notification);
        }
        $types = $request->types;
        $accessories = [];
        // Ak je request o laptop
        if (!empty($types->find('1'))) {
            if (empty($types->find('3'))) {
                array_push($accessories, Type::find(3));
            }
            if (empty($types->find('4'))) {
                array_push($accessories, Type::find(4));
            }
        }
        // Ak je request o pocitac
        if (!empty($types->find('2'))) {
            if (empty($types->find('3'))) {
                array_push($accessories, Type::find(3));
            }
            if (empty($types->find('5'))) {
                array_push($accessories, Type::find(5));
            }
        }
        return view('admin.request.process', compact('types', 'request', 'accessories'));
    }

    public function processStore(Request $request, $id)
    {
        $r = \App\Models\Request::find($id);
        $types = $r->types;
        $valArr = array();
        foreach ($types as $type) {
            $valArr[$type->name] = 'required';
        }
        if (!empty($types->find(1))) {
            $valArr['Myš'] = 'required';
            $valArr['Taška'] = 'required';
        }
        if (!empty($types->find(2))) {
            $valArr['Myš'] = 'required';
            $valArr['Klávesnica'] = 'required';
        }
        $this->validate($request, $valArr);
        $requestArray = $request->request->all();
        array_shift($requestArray);
        foreach ($requestArray as $key => $item) {
            $device = Device::find($item);
            if ($device->type->type == 1) {
                $device->status = 2;
            } else {
                $device->stock -= 1;
            }
            $device->save();
            $r->devices()->attach($device);
        }
        $r->technician_id = Auth::user()->id;
        $r->state_id = 2;
        $r->touch();
        $r->save();
        $notification = array(
            'message' => 'Žiadosť úspešne spracovaná.',
            'alert-type' => 'success',
        );
        return Redirect()->route('request.index')->with($notification);
    }

    public function processForIssue($id)
    {
        $request = \App\Models\Request::find($id);
        $request->state_id = 3;
        $request->touch();
        $request->save();
        $notification = array(
            'message' => 'Žiadosť pripravená pre odovzdanie.',
            'alert-type' => 'info',
        );
        return Redirect()->back()->with($notification);
    }

    public function receive($id)
    {
        $request = \App\Models\Request::find($id);
        if (Auth::user()->id == $request->user->id) {
            $request->state_id = 4;
            $request->touch();
            $request->save();
            $notification = array(
                'message' => 'Žiadosť vyzdvihnutá.',
                'alert-type' => 'info',
            );
        } else {
            $notification = array(
                'message' => 'Na vykonanie tejto činnosti nemáte práva!',
                'alert-type' => 'error',
            );
        }
        return Redirect()->back()->with($notification);
    }

    public function returnRequest($id)
    {
        $request = \App\Models\Request::find($id);
        return view('admin.request.return', compact('request'));
    }

    public function returnStore(Request $r)
    {
        $requestData = $r->all();
        $request = \App\Models\Request::find($requestData['request_id']);
        if (Auth::user()->id == $request->user->id) {
            foreach ($request->devices as $device) {
                if (empty($requestData[$device->type->name . "-checkbox"]) ||  $requestData[$device->type->name . "-checkbox"] != "on") {
                    $notification = array(
                        'message' => 'Nevrátili ste všetky zariadenia!',
                        'alert-type' => 'error',
                    );
                    return Redirect()->back()->with($notification);
                }
                if ($device->type->type == 1) {
                    if ($device->serial_number != $requestData[$device->type->name . '-serial']) {
                        $notification = array(
                            'message' => 'Nevrátili ste správny hardvér!',
                            'alert-type' => 'error',
                        );
                        return Redirect()->back()->with($notification);
                    }
                }
            }

            $request->state_id = 5;
            $request->touch();
            $request->save();
            $notification = array(
                'message' => 'Zariadenia vrátené.',
                'alert-type' => 'info',
            );
        } else {
            $notification = array(
                'message' => 'Na vykonanie tejto činnosti nemáte práva!',
                'alert-type' => 'error',
            );
        }
        return Redirect()->route('request.index')->with($notification);
    }

    public function confirmReturnRequest($id)
    {
        $request = \App\Models\Request::find($id);
        foreach ($request->devices as $device) {
            if ($device->type->type == 1) {
                $device->status = 1;

            } else {
                $device->stock++;
            }
            $device->save();
//                $request->devices()->detach($device);
        }
        $request->state_id = 6;
        $request->touch();
        $request->save();
        $notification = array(
            'message' => 'Vrátenie žiadosťi potvrdené.',
            'alert-type' => 'info',
        );

        return Redirect()->back()->with($notification);
    }

    public function detail($id)
    {
        $request = \App\Models\Request::find($id);
        return view('admin.request.detail', compact('request'));
    }

    public function edit($id)
    {
        $request = \App\Models\Request::find($id);
        if ($request->state_id == 1) {

        }
    }

    public function delete($id)
    {
        $request = \App\Models\Request::find($id);
        $request->types()->detach();
        $notification = array(
            'message' => 'Žiadosť bola úspešne zmazaná.',
            'alert-type' => 'success',
        );
        $request->delete();
        return Redirect()->route('request.index')->with($notification);
    }

    public function verify($id)
    {
        $request = \App\Models\Request::find($id);
        $request->state_id = 4;
        $request->save();
        $notification = array(
            'message' => 'Žiadosť bola úspešne potvrdená.',
            'alert-type' => 'success',
        );
        return Redirect()->route('admin.home')->with($notification);
    }

}
