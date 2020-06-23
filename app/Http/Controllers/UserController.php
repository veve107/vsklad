<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Position;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function storeUser(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
            'position_id' => 'required',
            'department_id' => 'required',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->position_id = $request->position_id;
        $user->department_id = $request->department_id;
        $user->password = bcrypt('password');
        $user->save();
        $notification = array(
            'message' => 'Používateľ úspešne pridaný.',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
            'position_id' => 'required',
            'department_id' => 'required',
        ]);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->position_id = $request->position_id;
        $user->department_id = $request->department_id;
        $user->save();
        $notification = array(
            'message' => 'Používateľ úspešne upravený.',
            'alert-type' => 'success',
        );
        return Redirect()->route('admin.positions.users')->with($notification);
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $positions = Position::all();
        $roles = Role::all();
        $departments = Department::all();
        return view('admin.users.edit', compact('user', 'positions', 'roles', 'departments'));    }
    public function delete($id){

    }
    public function profile($id){
        $user = User::find($id);
        return view('admin.users.profile', compact('user'));
    }
}
