<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrudPermission;
use App\Models\CustomAccessBlock;
use App\Models\Menu;
use App\Models\MenuAccess;
use App\Models\Region;
use App\Models\UserActivity;
use App\Models\UserRole;
use App\Models\UserSubmenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
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


    public function index()
    {
        $menu = Menu::all();
        $region = Region::all();
        $role = UserRole::all();
        return view('admin.configuration.menu.index', ['title'=> 'Configuration Menu', 'menu' => $menu, 'role'=>$role, 'region'=>$region]);
    }


    public function create()
    {
    }


    public function store(Request $request)
    {


        $data = [
            'parent' => $request->parent,
            'name' => $request->name,
            'url' => $request->url,
            'icon' => $request->icon,
            'sequence' => $request->sequence,
            'status' =>$request->status
        ];

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Menu",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah Menu  ". $request->menu
        ]);

        Menu::create($data);
        $menu = Menu::latest()->first();
        MenuAccess::create(['role_id' => 1, 'menu_id' => $menu['id']]);
        return redirect('/admin/configuration/menu')->with('success', 'Menu Ditambahkan');
    }

     public function show()
    {
        //
    }

    public function edit()
    {
        //
    }

    public function update(Request $request)
    {

        $menues=  Menu::where(['id'=> $request->id])->first();

        if($request->url == $menues->url){

            UserActivity::create([
                'id_user' => auth()->user()->id,
                'menu' => "Menu",
                'aktivitas' => "Ubah",
                'keterangan' => "Ubah Menu $menues->name menjadi $request->name "
            ]);
        }else{
            UserActivity::create([
                'id_user' => auth()->user()->id,
                'menu' => "Menu",
                'aktivitas' => "Ubah",
                'keterangan' => "Ubah Url $menues->url menjadi $request->url "
            ]);

        }

        Menu::where(['id' => $request->id])->update([
            'parent' => $request->parent,
            'name' => $request->name,
            'url' => $request->url,
            'icon' => $request->icon,
            'sequence' => $request->sequence,
            'status' =>$request->status
        ]);

        session()->forget('menu');
        return redirect('/admin/configuration/menu')->with('success', 'Menu diubah');
    }


    public function destroy(Request $request)
    {
      $menues=  Menu::where(['id'=> $request->id])->first();

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Menu",
            'aktivitas' => "Hapus",
            'keterangan' => "Hapus Menu  ". $menues->menu
        ]);
        Menu::destroy(['id' => $request->id]);
        $uam = MenuAccess::where(['menu_id' => $request->id])->get();
       $crud =  CrudPermission::where('menu_id', $request->id)->get();
        foreach($uam as $uam){
            MenuAccess::destroy(['id'=> $uam->id]);
        }

        foreach ($crud as $crud){
            CrudPermission::destroy(['id' => $crud->id]);
        }
        return redirect('/admin/configuration/menu')->with('success', 'Menu dihapus');
    }

    public function editmodal(Request $request){
        $menu = Menu::where(['id' => $request->id])->first();

        return view('admin.configuration.menu.editmodal', ['menu' => $menu, 'allmenu' => Menu::all()]);
    }

    public function loadmenu(Request $request) {

        // dd($request->role_id);
        $menu = DB::connection('masterdata')->select("select b.id, b.parent, b.name, b.url, b.icon from menu_access a join menus b on a.menu_id = b.id where a.role_id = $request->role_id and status = 1 and b.parent = $request->parent");
        // dd($request->parent);
        $html = '';
        foreach ($menu as $mn) {
            $checkBlock2 = CustomAccessBlock::where(['menu_id' => $mn->id, 'user_id' => auth()->user()->id])->first();
            if ($checkBlock2) {
            } else {

                $submenu = DB::connection('masterdata')->select("select b.id, b.parent, b.name, b.url, b.icon from menu_access a join menus b on a.menu_id = b.id where a.role_id = $request->role_id and status = 1 and b.parent = $mn->id");
                if ($submenu) {
                    $html .= "<div data-kt-menu-trigger='click' data-kt-menu-placement='bottom-start' class='menu-item menu-lg-down-accordion me-lg-1'>
                <span class='menu-link  py-3'>
                    <span class='menu-title'>$mn->name</span>
                    <span class='menu-arrow d-lg-none'></span>
                </span>
                <div class='menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px'>";



                    foreach ($submenu as $sm) {
                        $tandapetik = '"';
                        $subOnSubmenu = DB::connection('masterdata')->select("select b.id, b.parent, b.name, b.url, b.icon from menu_access a join menus b on a.menu_id = b.id where a.role_id = $request->role_id and status = 1 and b.parent = $sm->id");

                        $checkBlock2 = CustomAccessBlock::where(['menu_id' => $sm->id, 'user_id' => auth()->user()->id])->first();
                        if ($checkBlock2) {
                        } else {

                            if ($subOnSubmenu) {
                                $html .= "<div data-kt-menu-trigger=" . $tandapetik . "{default:'click', lg: 'hover'}" . $tandapetik . " data-kt-menu-placement='right-start' class='menu-item menu-lg-down-accordion'>
                        <span class='menu-link py-3'>
                            <span class='menu-icon'>
                                <span class='svg-icon svg-icon-2'>
                                    <i class='bi bi-$sm->icon'></i>
                                </span>
                            </span>
                            <span class='menu-title text-gray-700'>$sm->name</span>
                            <span class='menu-arrow'></span>
                        </span>
                        <div class='menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg py-lg-4 w-lg-225px'>";

                                foreach ($subOnSubmenu as $sosm) {
                                    $checkBlock2 = CustomAccessBlock::where(['menu_id' => $sosm->id, 'user_id' => auth()->user()->id])->first();
                                    if ($checkBlock2) {
                                    } else {
                                        $html .= "<div class='menu-item'>
                                        <a class='menu-link py-3' href='$sosm->url'>
                                            <span class='menu-bullet'>
                                                <span class='bullet bullet-dot'></span>
                                            </span>
                                            <span class='menu-title  text-gray-700'>$sosm->name</span>
                                        </a>
                                    </div>";
                                    }
                                }
                                $html .= "</div></div>";
                            } else {
                                $html .= "<div class='menu-item'>
                        <a class='menu-link py-3' href='$sm->url'  data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-dismiss='click' data-bs-placement='right'>
                        <span class='menu-icon'>
                        <span class='svg-icon svg-icon-2'>
                        <i class='bi bi-$sm->icon'></i>
                        </span>
                        </span>
                        <span class='menu-title text-gray-700'>$sm->name</span>
                        </a>
                        </div>";
                            }
                        }
                    }
                    $html .= '</div></div>';
                } else {
                    $html .= "<div data-kt-menu-placement='bottom-start' class='menu-item menu-lg-down-accordion me-lg-1'>
                <a class='menu-link py-3' href='$mn->url'>
                <span class='menu-title'>$mn->name</span>
                <span class='menu-arrow d-lg-none'></span>
                </a>
                </div>";
                }
            }
        }

        $request->session()->push('menu', $html);

        return response()->json($html);
    }

}
