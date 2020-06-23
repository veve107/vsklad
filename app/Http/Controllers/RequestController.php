<?php

namespace App\Http\Controllers;

use App\Mail\RequestVerification;
use App\Models\Hardware\Device;
use App\Models\Hardware\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
        $types = $request->types;
        return view('admin.request.process', compact('types', 'request'));
    }

    public function processStore(Request $request, $id)
    {
        $r = \App\Models\Request::find($id);
        $types = $r->types;
        $valArr = array();
        foreach ($types as $type) {
            $valArr[$type->name] = 'required';
        }
        $this->validate($request, $valArr);

        foreach ($types as $type) {
            $device = Device::find($request[$type->name]);
            $device->status = 2;
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

    public function sendMail($id)
    {
        $request = \App\Models\Request::find($id);
        $request->state_id = 3;
        $request->touch();
        $request->save();
        Mail::to($request->user->email)->send(new RequestVerification($request));
        $notification = array(
            'message' => 'Žiadosť o potvrdenie úspešne odoslaná.',
            'alert-type' => 'info',
        );
        return Redirect()->route('request.index')->with($notification);
    }

    public function detail($id)
    {
        $request = \App\Models\Request::find($id);
        return view('admin.request.detail', compact('request'));
    }

    public function edit($id){
        $request = \App\Models\Request::find($id);
        if($request->state_id == 1){

        }
    }

    public function delete($id){
        $request = \App\Models\Request::find($id);
        $request->types()->detach();
        $notification = array(
            'message' => 'Žiadosť bola úspešne zmazaná.',
            'alert-type' => 'success',
        );
        $request->delete();
        return Redirect()->route('request.index')->with($notification);
    }

    public function verify($id){
        $request = \App\Models\Request::find($id);
        $request->state_id = 4;
        $request->save();
        $notification = array(
            'message' => 'Žiadosť bola úspešne potvrdená.',
            'alert-type' => 'success',
        );
        return Redirect()->route('home')->with($notification);
   }

}
