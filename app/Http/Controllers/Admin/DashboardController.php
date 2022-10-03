<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index(){

        return view('admin.dashboard.index', ['title' => 'Dashboard']);
    }

    public function myprofile(){
        return view('admin.myprofile.index');
    }

    public function editmyprofile(){
        $lokasi = Lokasi::all();
        return view('admin.myprofile.edit', ['lokasi'=>$lokasi]);
    }

    public function updateprofile(Request $request){


        $onUser = User::where(['id' => $request->id])->first();
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users,username,'.$onUser->id,
            'nokontak' => 'required',
            'lokasi' => 'required',
            'alamat' => 'required',
            'password' => 'confirmed',
            'oldpassword' => 'required|min:8'
        ]);

        // dd($request);
        $image = $onUser->userdetail->image;
        $password = $onUser->password;

        if(!password_verify($request->oldpassword, $onUser->password)){
            return redirect('/admin/myprofile/edit')->with('fail', 'Wrong Password');
        }

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

        UserDetail::where(['id'=> $onUser->id_detail_user])->update($user_detail);

        $users = [
            'email' => $request->email,
            'username' => $request->username,
            'id_detail_user' => $onUser->id_detail_user,
            'id_role' => $request->id_role,
            'password' => $password
        ];

        User::where(['id'=>$request->id])->update($users);


        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Profile",
            'aktivitas' => "Update",
            'keterangan' => "Update Profile ". $request->email
        ]);


        return redirect('/admin/myprofile')->with('success', 'User Berhasil di Update');

    }

    public function useractivity(){

        $user = UserActivity::orderBy('id','DESC')->get();
        return view('admin.useractivity.index', ['user' => $user]);
    }

}
