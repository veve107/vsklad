<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use App\Http\Controllers\Controller;
use App\Models\Hardware\Device;
use App\Models\Position;
use App\Models\Role;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\VarDumper;

class AdminController extends Controller
{
    public function home()
    {
        $availableDevices = \App\Models\Hardware\Device::all()->where('status', '=', '1')->count();
        $unavailableDevices = \App\Models\Hardware\Device::all()->where('status', '=', '2')->count();
        $allDevices = \App\Models\Hardware\Device::all()->count();
        $devicesByTypes = \App\Models\Hardware\Device::all()->where('status', '=', '1')->groupBy('type_id');
        return view('admin.others.dashboard', compact('availableDevices', 'unavailableDevices', 'devicesByTypes', 'allDevices'));
    }


//    public function roles(){
//        $roles = Role::all();
//        return view('admin.others.roles', compact('roles'));
//    }
//
//    public function storeRole(Request $request){
//        $this->validate($request, [
//            'name' => 'required|unique:roles|max:50',
//        ]);
//
//        $role = new Role();
//        $role->name = $request->name;
//        $role->save();
//        $notification = array(
//            'message' => 'Rola úspešne pridaná.',
//            'alert-type' => 'success',
//        );
//        return Redirect()->back()->with($notification);
//    }
//
//    //todo
//    public function deleteRole($id){
//
//    }

    public function positions()
    {
        $positions = Position::all();
        return view('admin.others.positions', compact('positions'));
    }

    public function storePosition(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:positions|max:50',
        ]);

        $position = new Position();
        $position->name = $request->name;
        $position->save();
        $notification = array(
            'message' => 'Pozícia úspešne pridaná.',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function updatePosition($id, Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:50',
        ]);

        $position = Position::findOrFail($id);
        $position->name = $request->name;
        $position->save();
        $notification = array(
            'message' => 'Pozícia úspešne upravená.',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function deletePosition($id)
    {
        $position = Position::findOrFail($id);
        if ($position->users->isEmpty()) {
            $position->delete();
            $notification = array(
                'message' => 'Pozícia úspešne zmazaná.',
                'alert-type' => 'success',
            );
        } else {
            $notification = array(
                'message' => 'Nie je možné zmazať používanú pozíciu!',
                'alert-type' => 'error',
            );
        }
        return Redirect()->back()->with($notification);
    }

    public function departments()
    {
        $departments = Department::all();
        return view('admin.others.departments', compact('departments'));
    }

    public function storeDepartment(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:departments|max:50',
        ]);

        $role = new Department();
        $role->name = $request->name;
        $role->save();
        $notification = array(
            'message' => 'Oddelenie úspešne pridané.',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function updateDepartment($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:departments|max:50',
        ]);
        $position = Department::findOrFail($id);
        $position->name = $request->name;
        $position->save();
        $notification = array(
            'message' => 'Oddelenie úspešne upravené.',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function deleteDepartment($id)
    {
        $department = Department::findOrFail($id);
        if ($department->users->isEmpty()) {
            $department->delete();
            $notification = array(
                'message' => 'Oddelenie úspešne zmazané.',
                'alert-type' => 'success',
            );
        } else {
            $notification = array(
                'message' => 'Nie je možné zmazať používané oddelenie!',
                'alert-type' => 'error',
            );
        }
        return Redirect()->back()->with($notification);
    }

}
