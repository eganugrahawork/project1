<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrudPermission;
use App\Models\Region;
use App\Models\UserAccessMenu;
use App\Models\UserActivity;
use App\Models\UserMenu;
use App\Models\UserRole;
use App\Models\UserSubmenu;
use Illuminate\Http\Request;


class UserMenuController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = UserMenu::all();
        $region = Region::all();
        $submenu = UserSubmenu::all();
        $role = UserRole::all();
        return view('admin.usermenu.index', ['title'=> 'Configuration Menu', 'menu' => $menu, 'submenu' => $submenu,'role'=>$role, 'region'=>$region]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $is_submenu = null;
        $url = $request->url;
        if($request->is_submenu){
            $is_submenu = 1;
            $url=null;
        }

        $data = [
            'menu' => $request->menu,
            'url' => $url,
            'is_submenu' => $is_submenu
        ];

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Menu",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah Menu  ". $request->menu
        ]);

        UserMenu::create($data);
        $menu = UserMenu::latest()->first();
        UserAccessMenu::create(['id_role' => 1, 'id_menu' => $menu['id']]);
        return redirect('/admin/configuration/menu')->with('success', 'Menu Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserMenu  $userMenu
     * @return \Illuminate\Http\Response
     */
    public function show(UserMenu $userMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserMenu  $userMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(UserMenu $userMenu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserMenu  $userMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        if($request->is_submenu){

            $data = [
                'menu' => $request->menu
            ];
        }else{

            $data = [
                'menu' => $request->menu,
                'url' => $request->url
            ];
        }

        $menues=  UserMenu::where(['id'=> $request->id])->first();

        if($request->url == $menues->url){

            UserActivity::create([
                'id_user' => auth()->user()->id,
                'menu' => "Menu",
                'aktivitas' => "Ubah",
                'keterangan' => "Ubah Menu $menues->menu menjadi $request->menu "
            ]);
        }else{
            UserActivity::create([
                'id_user' => auth()->user()->id,
                'menu' => "Menu",
                'aktivitas' => "Ubah",
                'keterangan' => "Ubah Url $menues->url menjadi $request->url "
            ]);

        }

        UserMenu::where(['id' => $request->id])->update($data);
        return redirect('/admin/configuration/menu')->with('success', 'Menu diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserMenu  $userMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $menues=  UserMenu::where(['id'=> $request->id])->first();

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Menu",
            'aktivitas' => "Hapus",
            'keterangan' => "Hapus Menu  ". $menues->menu
        ]);
        UserMenu::destroy(['id' => $request->id]);
        $uam = UserAccessMenu::where(['id_menu' => $request->id])->get();
       $crud =  CrudPermission::where('id_menu', $request->id)->get();
        foreach($uam as $uam){
            UserAccessMenu::destroy(['id'=> $uam->id]);
        }

        foreach ($crud as $crud){
            CrudPermission::destroy(['id' => $crud->id]);
        }
        return redirect('/admin/configuration/menu')->with('success', 'Menu dihapus');
    }

    public function editmodal(Request $request){
        $menu = UserMenu::where(['id' => $request->id])->first();

        return view('admin.usermenu.editmodal', ['menu' => $menu]);
    }
}
