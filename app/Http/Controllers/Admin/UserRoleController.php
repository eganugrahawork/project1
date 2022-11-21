<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrudPermission;
use App\Models\CustomAccessBlock;
use App\Models\Menu;
use App\Models\MenuAccess;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRoleController extends Controller {

    public function __construct() {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->userrole->role === "Super Admin") {
                return $next($request);
            } else {
                return redirect('/blocked');
            }
        });
    }

    public function index() {
    }

    public function store(Request $request) {
        UserRole::create(['role' => $request->role]);

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Role",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah Role $request->role"
        ]);

        return redirect()->back()->with('success', 'Role ditambahkan!');
    }
    public function update(Request $request) {
        $old = UserRole::where(['id' => $request->id])->first();
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Role",
            'aktivitas' => "Ubah",
            'keterangan' => "Ubah Role $old->role menjadi $request->role"
        ]);
        UserRole::where(['id' => $request->id])->update(['role' => $request->role]);

        return redirect()->back()->with('success', 'Role diubah!');
    }
    public function destroy(Request $request) {

        $old = UserRole::where(['id' => $request->id])->first();
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Role",
            'aktivitas' => "Hapus",
            'keterangan' => "Hapus Role $old->role"
        ]);
        UserRole::destroy(['id' => $request->id]);

        return redirect()->back()->with('success', 'Role dihapus!');
    }
    public function viewuseraccess(Request $request) {
        // dd($request->id);
        $role = UserRole::where(['id' => $request->id])->first();
        $menu = Menu::all();
        return view('admin.configuration.role.useraccess', ['title' => 'User Access',  'menu' => $menu, 'role_id' => $request->id, 'role' => $role->role]);
    }

    public function changeaccess(Request $request) {

        // dd($request);
        $data = [
            "menu_id" => $request->menuId,
            "role_id" => $request->roleId
        ];

        $result = MenuAccess::where($data)->first();

        if ($result == false) {

            UserActivity::create([
                'id_user' => auth()->user()->id,
                'menu' => "Access Menu",
                'aktivitas' => "Tambah",
                'keterangan' => "Tambah Akses Role id $request->roleId pada Menu id $request->menuId"
            ]);
            MenuAccess::create($data);
        } else {
            UserActivity::create([
                'id_user' => auth()->user()->id,
                'menu' => "Access Menu",
                'aktivitas' => "Hapus",
                'keterangan' => "Hapus Akses Role id $request->roleId pada Menu id $request->menuId"
            ]);
            MenuAccess::where($data)->delete();
        }
        session()->forget('menu');
        return;
    }



    public function editmodalaccess(Request $request) {
        $menu = Menu::where(['parent' => 0])->get();

        return view('admin.configuration.role.editmodalaccess', ['menu' => $menu, 'role_id' => $request->id]);
    }


    public function editmodalrole(Request $request) {

        $role = UserRole::where(['id' => $request->id])->first();

        return view('admin.configuration.role.editmodalrole', ['role' => $role]);
    }


    public function viewrole(Request $request) {
        $role = UserRole::where(['id' => $request->id])->first();
        $menuRole = MenuAccess::where(['role_id' => $request->id])->get();

        $user = User::where(['role_id' => $request->id])->get();

        return view('admin.configuration.role.viewrole', ['role' => $role, 'menurole' => $menuRole, 'user' => $user]);
    }

    public function editcustomaccess(Request $request) {
        $user = User::where(['id' => $request->id])->first();
        $uaccess = MenuAccess::where(['role_id' => $user->role_id])->get();

        return view('admin.configuration.role.editcustomaccess', ['user' => $user, 'useraccess' => $uaccess]);
    }


    public function blockaccess(Request $request) {
        CustomAccessBlock::create(['user_id' => $request->idUser, 'menu_id' => $request->idMenu]);
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Role",
            'aktivitas' => "Hide",
            'keterangan' => "Hide Akses User id $request->idUser pada Menu id $request->idMenu "
        ]);

        session()->forget('menu');
        return response()->json('success');
    }
    public function unblockaccess(Request $request) {

        CustomAccessBlock::where(['user_id' => $request->idUser, 'menu_id' => $request->idMenu])->delete();
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Role",
            'aktivitas' => "Unhide",
            'keterangan' => "Unhide Akses User id $request->idUser pada Menu id $request->idMenu "
        ]);
        session()->forget('menu');
        return response()->json('success');
    }

    public function editpermissionmodal(Request $request) {
        $menu = DB::connection('masterdata')->select("select b.name, b.id from menu_access a join menus b on a.menu_id = b.id where a.role_id = $request->id");

        return view('admin.configuration.role.editpermissionmodal', ['menu' => $menu, 'role_id' => $request->id]);
    }

    public function permissionmenu(Request $request) {
        if ($request->permission === "approve") {
            $isAvailable = CrudPermission::where(['role_id' => $request->roleId, 'menu_id' => $request->menuId])->first();
            // dd($isAvailable);
            if ($isAvailable) {
                if ($isAvailable->approve == 1) {
                    CrudPermission::where(['role_id' => $request->roleId, 'menu_id' => $request->menuId])->update(['approve' => 0]);
                    return response()->json('success');
                } else {
                    CrudPermission::where(['role_id' => $request->roleId, 'menu_id' => $request->menuId])->update(['approve' => 1]);
                    return response()->json('success');
                }
            } else {
                CrudPermission::create(['role_id' => $request->roleId, 'menu_id' => $request->menuId, 'approve' => 1]);
                return response()->json('success');
            }
        }

        if ($request->permission === "create") {
            $isAvailable = CrudPermission::where(['role_id' => $request->roleId, 'menu_id' => $request->menuId])->first();
            // dd($isAvailable);
            if ($isAvailable) {
                if ($isAvailable->created == 1) {
                    CrudPermission::where(['role_id' => $request->roleId, 'menu_id' => $request->menuId])->update(['created' => 0]);
                    return response()->json('success');
                } else {
                    CrudPermission::where(['role_id' => $request->roleId, 'menu_id' => $request->menuId])->update(['created' => 1]);
                    return response()->json('success');
                }
            } else {
                CrudPermission::create(['role_id' => $request->roleId, 'menu_id' => $request->menuId, 'created' => 1]);
                return response()->json('success');
            }
        }

        if ($request->permission === "edit") {
            $isAvailable = CrudPermission::where(['role_id' => $request->roleId, 'menu_id' => $request->menuId])->first();
            // dd($isAvailable);
            if ($isAvailable) {
                if ($isAvailable->edit == 1) {
                    CrudPermission::where(['role_id' => $request->roleId, 'menu_id' => $request->menuId])->update(['edit' => 0]);
                    return response()->json('success');
                } else {
                    CrudPermission::where(['role_id' => $request->roleId, 'menu_id' => $request->menuId])->update(['edit' => 1]);
                    return response()->json('success');
                }
            } else {
                CrudPermission::create(['role_id' => $request->roleId, 'menu_id' => $request->menuId, 'edit' => 1]);
                return response()->json('success');
            }
        }

        if ($request->permission === "delete") {
            $isAvailable = CrudPermission::where(['role_id' => $request->roleId, 'menu_id' => $request->menuId])->first();
            // dd($isAvailable);
            if ($isAvailable) {
                if ($isAvailable->deleted == 1) {
                    CrudPermission::where(['role_id' => $request->roleId, 'menu_id' => $request->menuId])->update(['deleted' => 0]);
                    return response()->json('success');
                } else {
                    CrudPermission::where(['role_id' => $request->roleId, 'menu_id' => $request->menuId])->update(['deleted' => 1]);
                    return response()->json('success');
                }
            } else {
                CrudPermission::create(['role_id' => $request->roleId, 'menu_id' => $request->menuId, 'deleted' => 1]);
                return response()->json('success');
            }
        }
    }
}
