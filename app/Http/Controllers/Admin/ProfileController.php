<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{


    public function __construct()
    {

    }


    public function index(){
        return view('admin.myprofile.index');
    }

    public function editmyprofile(){
        $region = Region::all();
        return view('admin.myprofile.edit', ['region'=>$region]);
    }

    public function update(Request $request){

        $onUser = User::where(['id' => $request->id])->first();
        // dd($onUser);
        // $request->validate([
        //     'name' => 'required|min:3',
        //     'address' => 'required|min:4',
        //     'no_hp' => 'required',
        //     'id_role' => 'required',
        //     'region' => 'required',
        //     'image' => 'image|file|max:1024',
        //     'password' => 'confirmed',
        //     'oldpassword' => 'required|min:8'
        // ]);

        if(!password_verify($request->oldpassword, $onUser->password)){
            return redirect()->back()->with('fail', 'Wrong Password');
        }

        $image = $onUser->image;
        $password = $onUser->password;

        if($request->file('image')){
            if($request->oldimage !== 'img-users/default.png'){
                Storage::delete($request->oldimage);
            }
            $image = $request->file('image')->store('img-users');
        }



        if($request->password !== null){
            $password = Hash::make($request->password);
        }



        $users = [
            'email' => $request->email,
            'username' => $request->username,
            'role_id' => $request->role_id,
            'name' => $request->name,
            'address' => $request->address,
            'image' => $image,
            'no_hp' => $request->no_hp,
            'region' => $request->region,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'religion' => $request->religion,
            'password' => $password
        ];

        User::where(['id'=>$request->id])->update($users);

        return redirect()->back()->with('success', 'User Berhasil di Update');
    }
}
