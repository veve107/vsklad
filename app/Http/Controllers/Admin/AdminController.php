<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home(){
        return view('admin.home');
    }
    public function users(){
        $users = User::all();
        $positions = Position::all();
        $roles = Role::all();
        $departments = Department::all();
        return view('admin.users.index', compact('users', 'positions', 'roles', 'departments'));
    }

    public function roles(){
        $roles = Role::all();
        return view('admin.others.roles', compact('roles'));
    }

    public function positions(){
        $positions = Position::all();
        return view('admin.others.positions', compact('positions'));
    }

    public function storeRole(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:roles|max:50',
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->save();
        $notification = array(
            'message' => 'Rola úspešne pridaná.',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function storePosition(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:positions|max:50',
        ]);

        $role = new Position();
        $role->name = $request->name;
        $role->save();
        $notification = array(
            'message' => 'Pozícia úspešne pridaná.',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }
    //todo
    public function deleteRole($id){

    }

    public function departments(){
        $departments = Department::all();
        return view('admin.others.departments', compact('departments'));
    }

    public function storeDepartment(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:positions|max:50',
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
    //todo
    public function deleteDepartment($id){

    }

}
