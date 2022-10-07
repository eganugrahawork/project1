<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\User;
use App\Models\UserAccessMenu;
use App\Models\UserActivity;
use App\Models\UserMenu;
use App\Models\UserRole;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{

    public function __construct()
    {

        $this->middleware(function($request, $next){
            $id_menu = UserMenu::select('id')->where(['url' => '/admin/users'])->first();
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
        if(auth()->user()->id_role == 1){
            $user = User::all();
        }else{
            $user = User::where('id_role', '!=', 1)->get();
        }
        $role = UserRole::all();
        $region = Region::all();
        return view('admin.users.index', ['title' => 'Users', 'users' => $user, 'role' => $role, 'region' => $region]);
    }

    public function create(){
        $role = UserRole::where('id', '!=', 1)->get();
        return view('admin.users.create', ['title'=> 'Create Users', 'role' =>$role ]);
    }

    public function store(Request $request){


        if($request->file('image')){
            $request->image = $request->file('image')->store('img-users');
        }else{
            $request->image = 'img-users/default.png';
        }


        $users = [
            'email' => $request->email,
            'username' => $request->username,
            'id_role' => $request->id_role,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'address' => $request->address,
            'image' => $request->image,
            'no_hp' => $request->no_hp,
            'region' => $request->region,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'religion' => $request->religion

        ];

        User::create($users);

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Users",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah Data ". $request->email
        ]);
        return redirect('/admin/users')->with('success', 'User Baru ditambahkan');

    }

    public function edit(Request $request){
        $user = User::where(['id' =>$request->id])->first();
        $role = UserRole::where('id', '!=', 1)->get();
        return view('admin.users.edit', ['title' => 'Edit User', 'user' => $user, 'role' => $role]);
    }

    public function update(Request $request){
        $image = $request->oldimage;
        $password = $request->oldpassword;

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
            'id_role' => $request->id_role,
            'password' => $password,
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

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Users",
            'aktivitas' => "Ubah",
            'keterangan' => "Ubah Data ". $request->email
        ]);


        return redirect('/admin/users')->with('success', 'User Berhasil di Update');

    }

    public function destroy(Request $request){
        $user = User::where(['id' => $request->id])->first();

        if($user->image !=='img-users/default.png'){
            Storage::delete($user->image);
        }


        User::destroy(['id' =>$request->id]);
        return redirect()->back()->with('success', 'User berhasil dihapus');
    }

    public function show(Request $request){
        $user = User::where(['id' => $request->id])->first();

        return view('admin.users.show', ['title' => 'Profile', 'user'=> $user]);
    }

    public function checkusername(Request $request){

        $user = User::where(['username'=> $request->value])->first();

        if($user){
            return response()->json(['success'=>false]);
        }else{
            return response()->json(['success'=>true]);
        }


    }
    public function checkemail(Request $request){

        $user = User::where(['email'=> $request->value])->first();

        if($user){
            return response()->json(['success'=>false]);
        }else{
            return response()->json(['success'=>true]);
        }
    }

    public function editmodal(Request $request){
        $user = User::where(['id' => $request->id])->first();
        $region = Region::all();
        $role = UserRole::all();
        return view('admin.users.editmodal', ['user' => $user, 'role' => $role, 'region'=>$region]);

    }
}
