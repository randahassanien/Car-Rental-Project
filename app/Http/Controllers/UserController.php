<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(){
        $users=User::get();
        return view('admin/users',compact("users"));
    }

    public function create(){
        return view('admin.addUser');
    }

    public function store(Request $request){
        $messages=[
            'name.required'=>'Name is required',
            'name.string'=>'name must be string',
            'username.required'=>'UserName is required',
            'username.string'=>'Username must be string',
            'email.required'=>'email is required',
            'email.unique'=>'email must be unique'
        ];
        $request->validate([
            'name'=>'required|string',
            'username'=>'required|string',
            'email'=>'required|unique:Users|max:255'
        ], $messages );

        $new_user = new User();
        $new_user->name = $request->name;
        $new_user->username = $request->username;
        $new_user->email = $request->email;
        $new_user->password = $request->password;
        $new_user->save();

        return redirect('admin/users');

    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.edituser', compact('user'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        User::where('id', $id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return redirect('admin/users');
    }
}
