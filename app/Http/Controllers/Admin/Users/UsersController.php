<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuAccess;
use App\Models\Region;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\UserRole;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{

    public function __construct()
    {

        $this->middleware(function($request, $next){
            $menu_id = Menu::select('id')->where(['url' => '/admin/users'])->first();
            $role_id = auth()->user()->role_id;

            $check = MenuAccess::where(['role_id' => $role_id, 'menu_id' => $menu_id->id])->first();

            if($check){
                return $next($request);
            }else{
                return redirect('/blocked');
            }
        });
    }

    public function index(){
        $role = UserRole::all();
        $region = Region::all();
        return view('admin.users.index', ['title' => 'Users']);
    }

    public function list(Request $request){

        $user = User::with(['UserRole', 'RegionDetail'])->get();
        return Datatables::of($user)->addIndexColumn()
        ->addColumn('action', function($model){
            $action = "";
            $action = " <a href='/admin/users/show/$model->id' class='btn btn-sm btn-icon btn-primary btn-hover-rise me-1'><i class='bi bi-info-circle'></i></a>";


                if(Gate::allows('edit', ['/admin/users'])){
                    $action .= "<a onclick='editModal($model->id)' class='btn btn-sm btn-icon btn-warning btn-hover-rise me-1'><i class='bi bi-pencil-square'></i></a>";
                }
                if(Gate::allows('delete', ['/admin/users'])){
                    $action .= " <a href='/admin/users/delete/$model->id' class='btn btn-sm btn-icon btn-danger btn-hover-rise me-1' id='deleteUsers'><i class='bi bi-trash'></i></a>";
                }

            return $action;
        })->addColumn('user', function($model){
            $url = url('storage/'. $model->image);
            $userhtml = " <div class='symbol symbol-circle symbol-50px overflow-hidden me-3'>
            <a href='#'>
                <div class='symbol-label'>
                    <img src='$url' alt='' class='w-100' />
                </div>
            </a>
        </div>
        <div class='d-flex flex-column'>
            <a href='#' class='text-gray-800 text-hover-primary mb-1'>$model->name</a>
            <span>$model->username</span>
        </div>";
        return $userhtml;
        })->addColumn('created', function($model){
            return $model->created_at->format('d-m-Y');
        })->addColumn('role', function($model){
        return $model->userrole->role;
        })->addColumn('region', function($model){
            return $model->regiondetail->name;
        })->rawColumns(['action', 'user'])->make(true);
    }

    public function store(Request $request){
        // dd($request);

        if($request->file('image')){
            $request->image = $request->file('image')->store('img-users');
        }else{
            $request->image = 'img-users/default.png';
        }


        $users = [
            'email' => $request->email,
            'username' => $request->username,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'address' => $request->address,
            'image' => $request->image,
            'no_hp' => $request->no_hp,
            'region' => $request->region,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'religion' => $request->religion,
            'is_active' => 1,

        ];

        User::create($users);

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Users",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah Data ". $request->email
        ]);
        return response()->json(['success'=>'Data ditambahkan']);

    }

    public function addmodal(Request $request){
        $user = User::where(['id' =>$request->id])->first();
        $role = UserRole::all();
        $region = Region::all();
        return view('admin.users.addmodal', ['title' => 'Create User','role' => $role, 'region' => $region]);
    }

    public function edit(Request $request){
        $user = User::where(['id' =>$request->id])->first();
        $role = UserRole::all();
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
            'role_id' => $request->role_id,
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


        return response()->json(['success' => 'Users Updated']);

    }

    public function destroy(Request $request){
        $user = User::where(['id' => $request->id])->first();

        if($user->image !=='img-users/default.png'){
            Storage::delete($user->image);
        }


        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Users",
            'aktivitas' => "Hapus",
            'keterangan' => "Hapus Users ". $user->email
        ]);
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
            return response()->json(['success'=>'false']);
        }else{
            return response()->json(['success'=>'true']);
        }
    }

    public function editmodal(Request $request){
        $user = User::where(['id' => $request->id])->first();
        $region = Region::all();
        $role = UserRole::all();
        return view('admin.users.editmodal', ['user' => $user, 'role' => $role, 'region'=>$region]);

    }
}
