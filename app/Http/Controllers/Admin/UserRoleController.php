<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\UserAccessMenu;
use App\Models\UserMenu;
use App\Models\UserRole;
use Illuminate\Http\Request;
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
        $role = UserRole::all();
        return view('admin.userrole.index', ['title' => 'Configuration Role', 'role' =>$role]);
    }

    public function store(Request $request){
        UserRole::create(['role' => $request->role]);

        return redirect()->back()->with('success', 'Role ditambahkan!');

    }
    public function update(Request $request){
        UserRole::where(['id'=>$request->id])->update(['role' => $request->role]);

        return redirect()->back()->with('success', 'Role diubah!');

    }
    public function destroy(Request $request){

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
            "id_menu" =>$request->menuId,
            "id_role" => $request->roleId
        ];

        $result = UserAccessMenu::where($data)->first();

        if($result == false){
            UserAccessMenu::create($data);
        }else{
            UserAccessMenu::where($data)->delete();
        }

        return ;
    }

    public function updateaccess(Request $request){
        $check = UserAccessMenu::where(['id_role' => $request->id_role, 'id_menu' =>$request->id_menu])->first();

        if($check == null && $request->status = 1){
            UserAccessMenu::create(['id_role' => $request->id_role, 'id_menu' =>$request->id_menu]);
            return redirect()->back()->with('success', 'Access changed');
        }elseif($check && $request->status == 0){
            UserAccessMenu::where(['id_role' => $request->id_role, 'id_menu' => $request->id_menu])->delete();
            return redirect()->back()->with('success', 'Access changed');
        }else{
            return redirect()->back()->with('fail', 'You didnt make a change !');
        }

    }

}
