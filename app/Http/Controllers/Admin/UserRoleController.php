<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\CrudPermission;
use App\Models\CustomAccessBlock;
use App\Models\Menu;
use App\Models\MenuAccess;
use App\Models\User;
use App\Models\UserAccessMenu;
use App\Models\UserAccessSubmenu;
use App\Models\UserActivity;
use App\Models\UserMenu;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PDO;

class UserRoleController extends Controller
{

    public function __construct()
    {
        $this->middleware(function($request, $next){
            if(auth()->user()->userrole->role === "Super Admin"){
                return $next($request);
            }else{
                return redirect('/blocked');
            }
        });
    }

    public function index(){

    }

    public function store(Request $request){
        UserRole::create(['role' => $request->role]);

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Role",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah Role $request->role"
        ]);

        return redirect()->back()->with('success', 'Role ditambahkan!');

    }
    public function update(Request $request){
        $old = UserRole::where(['id' => $request->id])->first();
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Role",
            'aktivitas' => "Ubah",
            'keterangan' => "Ubah Role $old->role menjadi $request->role"
        ]);
        UserRole::where(['id'=>$request->id])->update(['role' => $request->role]);


        return redirect()->back()->with('success', 'Role diubah!');

    }
    public function destroy(Request $request){

        $old = UserRole::where(['id'=>$request->id])->first();
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Role",
            'aktivitas' => "Hapus",
            'keterangan' => "Hapus Role $old->role"
        ]);
        UserRole::destroy(['id' =>$request->id]);

        return redirect()->back()->with('success', 'Role dihapus!');
    }
    public function viewuseraccess(Request $request){
        // dd($request->id);
        $role = UserRole::where(['id' =>$request->id])->first();
        $menu = UserMenu::all();
        return view('admin.userrole.useraccess',['title'=> 'User Access',  'menu' => $menu, 'id_role' => $request->id,'role'=> $role->role]);

    }

    public function changeaccess(Request $request){

        // dd($request);
        $data = [
            "menu_id" =>$request->menuId,
            "role_id" => $request->roleId
        ];

        $result = MenuAccess::where($data)->first();

        if($result == false){

            UserActivity::create([
                'id_user' => auth()->user()->id,
                'menu' => "Access Menu",
                'aktivitas' => "Tambah",
                'keterangan' => "Tambah Akses Role id $request->roleId pada Menu id $request->menuId"
            ]);
            MenuAccess::create($data);
        }else{
            UserActivity::create([
                'id_user' => auth()->user()->id,
                'menu' => "Access Menu",
                'aktivitas' => "Hapus",
                'keterangan' => "Hapus Akses Role id $request->roleId pada Menu id $request->menuId"
            ]);
            MenuAccess::where($data)->delete();
        }

        return ;
    }



    public function editmodalaccess(Request $request){
        $menu = Menu::where(['parent' => 0])->get();

        return view('admin.userrole.editmodalaccess', ['menu' => $menu, 'role_id' => $request->id]);
    }


    public function editmodalrole(Request $request){

        $role = UserRole::where(['id' => $request->id])->first();

        return view('admin.userrole.editmodalrole', ['role' => $role]);
    }


    public function viewrole(Request $request) {
        $role = UserRole::where(['id' => $request->id])->first();
        $menuRole = UserAccessMenu::where(['id_role' => $request->id])->get();

        $user = User::where(['id_role' => $request->id])->get();

        return view('admin.userrole.viewrole', ['role' => $role, 'menurole'=> $menuRole, 'user' => $user]);
    }

    public function editcustomaccess(Request $request){
       $user= User::where(['id' => $request->id])->first();
       $uaccess = UserAccessMenu::where(['id_role' => $user->id_role])->get();

       return view('admin.userrole.editcustomaccess', ['user' => $user, 'useraccess' => $uaccess ]);

    }

    public function editcustomaccesssubmenu(Request $request){
        $user= User::where(['id' => $request->id])->first();
        $uaccess = UserAccessSubmenu::where(['id_role' => $user->id_role])->get();

       return view('admin.userrole.editcustomaccesssubmenu', ['user' => $user, 'useraccesssubmenu' => $uaccess ]);
    }

    // public function updateaccess(Request $request){
    //     $check = UserAccessMenu::where(['id_role' => $request->id_role, 'id_menu' =>$request->id_menu])->first();

    //     if($check == null && $request->status = 1){
    //         UserAccessMenu::create(['id_role' => $request->id_role, 'id_menu' =>$request->id_menu]);
    //         return redirect()->back()->with('success', 'Access changed');
    //     }elseif($check && $request->status == 0){
    //         UserAccessMenu::where(['id_role' => $request->id_role, 'id_menu' => $request->id_menu])->delete();
    //         return redirect()->back()->with('success', 'Access changed');
    //     }else{
    //         return redirect()->back()->with('fail', 'You didnt make a change !');
    //     }

    // }

    public function blockaccess(Request $request){
        CustomAccessBlock::create(['id_user' => $request->idUser, 'id_menu' => $request->idMenu]);
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Role",
            'aktivitas' => "Hide",
            'keterangan' => "Hide Akses User id $request->idUser pada Menu id $request->idMenu "
        ]);
        return response()->json('success');

    }
    public function unblockaccess(Request $request){

        CustomAccessBlock::where(['id_user' => $request->idUser, 'id_menu' => $request->idMenu])->delete();
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Role",
            'aktivitas' => "Unhide",
            'keterangan' => "Unhide Akses User id $request->idUser pada Menu id $request->idMenu "
        ]);
        return response()->json('success');
    }

    public function blockaccesssubmenu(Request $request){
        CustomAccessBlock::create(['id_user' => $request->idUser, 'id_submenu' => $request->idSubmenu]);
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Role",
            'aktivitas' => "Hide",
            'keterangan' => "Hide Akses User id $request->idUser pada Submenu id $request->idSubmenu "
        ]);
        return response()->json('success');

    }

    public function unblockaccesssubmenu(Request $request){

        CustomAccessBlock::where(['id_user' => $request->idUser, 'id_submenu' => $request->idSubmenu])->delete();
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Role",
            'aktivitas' => "Unhide",
            'keterangan' => "Unhide Akses User id $request->idUser pada Submenu id $request->idSubmenu "
        ]);
        return response()->json('success');
    }

    public function editpermissionmodal(Request $request){
        $menu = DB::select("select b.menu, b.id from user_access_menus a join user_menus b on a.id_menu = b.id where a.id_role = $request->id and b.is_submenu <> 1");

        return view('admin.userrole.editpermissionmodal', ['menu'=> $menu, 'submenu' =>UserAccessSubmenu::where(['id_role' =>$request->id])->get(),'id_role' => $request->id]);
    }

    public function storepermissionmenu(Request $request){
        dd($request);
        // print_r($request);die;
    }

    public function permissionmenu(Request $request){
        if($request->permission === "create"){
            $isAvailable = CrudPermission::where(['id_role' => $request->roleId, 'id_menu'=>$request->menuId])->first();
            // dd($isAvailable);
            if($isAvailable){
                if($isAvailable->created == 1){
                    CrudPermission::where(['id_role' => $request->roleId, 'id_menu'=>$request->menuId])->update(['created' => 0]);
                    return response()->json('success');
                }else{
                    CrudPermission::where(['id_role' => $request->roleId, 'id_menu'=>$request->menuId])->update(['created' => 1]);
                    return response()->json('success');
                }
            }else{
                CrudPermission::create(['id_role' => $request->roleId, 'id_menu' =>$request->menuId, 'created' =>1]);
                return response()->json('success');
            }
        }

        if($request->permission === "edit"){
            $isAvailable = CrudPermission::where(['id_role' => $request->roleId, 'id_menu'=>$request->menuId])->first();
            // dd($isAvailable);
            if($isAvailable){
                if($isAvailable->edit == 1){
                    CrudPermission::where(['id_role' => $request->roleId, 'id_menu'=>$request->menuId])->update(['edit' => 0]);
                    return response()->json('success');
                }else{
                    CrudPermission::where(['id_role' => $request->roleId, 'id_menu'=>$request->menuId])->update(['edit' => 1]);
                    return response()->json('success');
                }
            }else{
                CrudPermission::create(['id_role' => $request->roleId, 'id_menu' =>$request->menuId, 'edit' =>1]);
                return response()->json('success');
            }
        }

        if($request->permission === "delete"){
            $isAvailable = CrudPermission::where(['id_role' => $request->roleId, 'id_menu'=>$request->menuId])->first();
            // dd($isAvailable);
            if($isAvailable){
                if($isAvailable->deleted == 1){
                    CrudPermission::where(['id_role' => $request->roleId, 'id_menu'=>$request->menuId])->update(['deleted' => 0]);
                    return response()->json('success');
                }else{
                    CrudPermission::where(['id_role' => $request->roleId, 'id_menu'=>$request->menuId])->update(['deleted' => 1]);
                    return response()->json('success');
                }
            }else{
                CrudPermission::create(['id_role' => $request->roleId, 'id_menu' =>$request->menuId, 'deleted' =>1]);
                return response()->json('success');
            }
        }
    }

    public function permissionsubmenu(Request $request){
        if($request->permission === "create"){
            $isAvailable = CrudPermission::where(['id_role' => $request->roleId, 'id_submenu'=>$request->submenuId])->first();
            // dd($isAvailable);
            if($isAvailable){
                if($isAvailable->created == 1){
                    CrudPermission::where(['id_role' => $request->roleId, 'id_submenu'=>$request->submenuId])->update(['created' => 0]);
                    return response()->json('success');
                }else{
                    CrudPermission::where(['id_role' => $request->roleId, 'id_submenu'=>$request->submenuId])->update(['created' => 1]);
                    return response()->json('success');
                }
            }else{
                CrudPermission::create(['id_role' => $request->roleId, 'id_submenu' =>$request->submenuId, 'created' =>1]);
                return response()->json('success');
            }
        }


        if($request->permission === "edit"){
            $isAvailable = CrudPermission::where(['id_role' => $request->roleId, 'id_submenu'=>$request->submenuId])->first();
            // dd($isAvailable);
            if($isAvailable){
                if($isAvailable->edit == 1){
                    CrudPermission::where(['id_role' => $request->roleId, 'id_submenu'=>$request->submenuId])->update(['edit' => 0]);
                    return response()->json('success');
                }else{
                    CrudPermission::where(['id_role' => $request->roleId, 'id_submenu'=>$request->submenuId])->update(['edit' => 1]);
                    return response()->json('success');
                }
            }else{
                CrudPermission::create(['id_role' => $request->roleId, 'id_submenu' =>$request->submenuId, 'edit' =>1]);
                return response()->json('success');
            }
        }


        if($request->permission === "delete"){
            $isAvailable = CrudPermission::where(['id_role' => $request->roleId, 'id_submenu'=>$request->submenuId])->first();
            // dd($isAvailable);
            if($isAvailable){
                if($isAvailable->deleted == 1){
                    CrudPermission::where(['id_role' => $request->roleId, 'id_submenu'=>$request->submenuId])->update(['deleted' => 0]);
                    return response()->json('success');
                }else{
                    CrudPermission::where(['id_role' => $request->roleId, 'id_submenu'=>$request->submenuId])->update(['deleted' => 1]);
                    return response()->json('success');
                }
            }else{
                CrudPermission::create(['id_role' => $request->roleId, 'id_submenu' =>$request->submenuId, 'deleted' =>1]);
                return response()->json('success');
            }
        }

    }


}
