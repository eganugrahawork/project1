<?php

namespace App\Http\Controllers\Admin\Configuration;

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
        // $this->middleware(function($request, $next){
        //     if(auth()->user()->userrole->role === "Super Admin"){
        //         return $next($request);
        //     }else{
        //         return redirect('/blocked');
        //     }
        // });
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
        $menu = DB::connection('masterdata')->select("select b.id, b.parent, b.name, b.url, b.icon from menu_access a join menus b on a.menu_id = b.id where a.role_id = $request->role_id and status = 1 and b.parent = $request->parent ORDER BY b.sequence ASC");
        // dd($request->parent);
        $html = '';
        foreach ($menu as $mn) {
            $checkBlock2 = CustomAccessBlock::where(['menu_id' => $mn->id, 'user_id' => auth()->user()->id])->first();
            if ($checkBlock2) {
            } else {

                $submenu = DB::connection('masterdata')->select("select b.id, b.parent, b.name, b.url, b.icon from menu_access a join menus b on a.menu_id = b.id where a.role_id = $request->role_id and status = 1 and b.parent = $mn->id");
                if ($submenu) {
                    $html .= "<div data-kt-menu-trigger='click' class='menu-item menu-accordion'>
                    <span class='menu-link'>
                        <span class='menu-icon'>
                        <i class='fas fa-$mn->icon'></i>
                            </span>
                        <span class='menu-title'>$mn->name</span>
                        <span class='menu-arrow'></span>
                    </span>
                    <div class='menu-sub menu-sub-accordion menu-active-bg'>";



                    foreach ($submenu as $sm) {
                        $tandapetik = '"';
                        $subOnSubmenu = DB::connection('masterdata')->select("select b.id, b.parent, b.name, b.url, b.icon from menu_access a join menus b on a.menu_id = b.id where a.role_id = $request->role_id and status = 1 and b.parent = $sm->id");

                        $checkBlock2 = CustomAccessBlock::where(['menu_id' => $sm->id, 'user_id' => auth()->user()->id])->first();
                        if ($checkBlock2) {
                        } else {

                            if ($subOnSubmenu) {
                                $html .= "<div data-kt-menu-trigger='click' class='menu-item menu-accordion'>
                                <span class='menu-link'>
                                    <span class='menu-bullet'>
                                        <span class='bullet bullet-dot'></span>
                                    </span>
                                    <span class='menu-title'>$sm->name</span>
                                    <span class='menu-arrow'></span>
                                </span>
                                <div class='menu-sub menu-sub-accordion menu-active-bg'>";

                                foreach ($subOnSubmenu as $sosm) {
                                    $checkBlock2 = CustomAccessBlock::where(['menu_id' => $sosm->id, 'user_id' => auth()->user()->id])->first();
                                    if ($checkBlock2) {
                                    } else {
                                        $html .= "<div class='menu-item'>
                                        <a class='menu-link' href='$sosm->url'>
                                            <span class='menu-bullet'>
                                                <span class='bullet bullet-dot'></span>
                                            </span>
                                            <span class='menu-title'>$sosm->name</span>
                                        </a>
                                    </div>";
                                    }
                                }
                                $html .= "</div></div>";
                            } else {
                                $html .= " <div class='menu-item'>
                                <a class='menu-link' href='$sm->url'>
                                    <span class='menu-bullet'>
                                        <span class='bullet bullet-dot'></span>
                                    </span>
                                    <span class='menu-title'>$sm->name</span>
                                </a>
                            </div>";
                            }
                            // baru yg submenu
                        }
                    }
                    $html .= '</div></div>';
                } else {
                    $html .= "<div class='menu-item'>
                    <a class='menu-link' href='$mn->url'>
                        <span class='menu-icon'>
                            <i class='fas fa-$mn->icon'></i>
                        </span>
                        <span class='menu-title'>$mn->name</span>
                    </a>
                </div>";
                }
            }
        }

        $request->session()->push('menu', $html);

        return response()->json($html);
    }

}
