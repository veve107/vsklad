<?php

namespace App\Http\Controllers;

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
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->position_id = $request->position_id;
        $user->password = bcrypt('password');
        $user->save();
        $notification = array(
            'message' => 'Používateľ úspešne pridaný.',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }
}
