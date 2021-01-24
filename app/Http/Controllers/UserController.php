<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show(Request $req)
    {
        return view('admin/home', [
            "users" => User::all()
        ]);
    }

    public function showEdit($id)
    {
        return view('admin/edit', [
            "user" => User::find($id)
        ]);
    }

    public function edit($id, Request $req)
    {

        $user = User::find($id);
        if ($user->role == 'Admin') {
            return redirect()
                ->route('editForm', [$user])
                ->withErrors('You are not able to change the permissions of another admin!');
        } else {

            $role = $req->input('role');
            $user->role = $role;

            $user->save();
            return redirect()->route('editForm', [$user])->with('message','User has succesfully been updated!');
        }
    }

    public function delete($id){
        $user=User::find($id);
        if ($user->role == 'Admin') {
            return redirect()
                ->route('admin')
                ->withErrors('You are not able to delete another admin!');
        } else {
            $user->delete();
            return redirect()->route('admin')->with('message', 'User has successfully been deleted');
        }

    }

    public function showCreate(){
        return view('admin/create');
    }

    public function create(Request $req){
        $name= $req->input('name');
        $email=$req->input('email');
        $role=$req->input('role');
        $type=$req->input('type');

        $validatedData=$req->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($req->input('password')),
            'role'=>$role,
            'type'=>$type
        ]);

        return redirect()->to('/admin/')->with('message', 'User was successfully created!');

    }


}
