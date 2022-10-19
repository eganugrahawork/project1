<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrudPermission;
use App\Models\Menu;
use App\Models\MenuAccess;
use App\Models\Region;
use App\Models\UserActivity;
use App\Models\UserRole;
use App\Models\UserSubmenu;
use Illuminate\Http\Request;

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
        return view('admin.usermenu.index', ['title'=> 'Configuration Menu', 'menu' => $menu, 'role'=>$role, 'region'=>$region]);
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

        return view('admin.usermenu.editmodal', ['menu' => $menu, 'allmenu' => Menu::all()]);
    }

}
