<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAccessMenu;
use App\Models\UserDetail;
use App\Models\UserMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{


    public function __construct()
    {
        $this->middleware(function($request, $next){
            $id_menu = UserMenu::select('id')->where(['url' => '/admin/profile'])->first();
            $id_role = auth()->user()->id_role;

            $check = UserAccessMenu::where(['id_role' => $id_role, 'id_menu' => $id_menu->id])->first();

            if($check){
                return $next($request);
            }else{
                return redirect('/blocked');
            }
        });
    }


    public function index(){
        $user = auth()->user();

        return view('admin.profile.index', ['title' => 'Profile', 'user'=>$user]);
    }

    public function update(Request $request){

        $onUser = User::where(['id' => $request->id])->first();
        $request->validate([
            'nama' => 'required|min:3',
            'email' => 'required|unique:users,email,'.$onUser->id,
            'username' => 'required|unique:users,username,'.$onUser->id,
            'alamat' => 'required|min:4',
            'nokontak' => 'required|unique:user_details,nokontak,'.$onUser->id_detail_user,
            'id_role' => 'required',
            'lokasi' => 'required',
            'image' => 'image|file|max:1024',
            'password' => 'confirmed',
            'oldpassword' => 'required|min:8'
        ]);

        if(!password_verify($request->oldpassword, $onUser->password)){
            return redirect()->back()->with('fail', 'Password Salah');
        }

        $image = $onUser->userdetail->image;
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

        $user_detail = [
            'nama' => $request->nama,
            'image'=> $image,
            'alamat' => $request->alamat,
            'nokontak' => $request->nokontak,
            'lokasi' => $request->lokasi
        ];

        UserDetail::where(['id'=> $request->id_detail_user])->update($user_detail);

        $users = [
            'email' => $request->email,
            'username' => $request->username,
            'id_detail_user' => $request->id,
            'id_role' => $request->id_role,
            'password' => $password
        ];

        User::where(['id'=>$request->id])->update($users);

        return redirect()->back()->with('success', 'User Berhasil di Update');
    }
}
