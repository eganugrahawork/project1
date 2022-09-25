<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserAccessMenu;
use App\Models\UserMenu;
use App\Models\UserSubmenu;
use Illuminate\Http\Request;

class UserMenuController extends Controller
{


    public function __construct()
    {
        $this->middleware(function($request, $next){

            $submenu = UserSubmenu::where(['urlsubmenu' => '/admin/configuration/menu'])->first();
            $id_role = auth()->user()->id_role;

            $check = UserAccessMenu::where(['id_role' => $id_role, 'id_menu' => $submenu->usermenu->id])->first();

            if($check){
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
        return view('admin.usermenu.index', ['title'=> 'Configuration Menu', 'menu' => $menu]);
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
        $is_submenu = 0;
        if($request->is_submenu){
            $is_submenu = 1;
        }

        $data = [
            'menu' => $request->menu,
            'icon' => $request->icon,
            'url' => $request->url,
            'is_submenu' => $is_submenu
        ];

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
        $is_submenu = 0;
        if($request->is_submenu){
            $is_submenu = 1;
        }

        $data = [
            'menu' => $request->menu,
            'icon' => $request->icon,
            'url' => $request->url,
            'is_submenu' => $is_submenu
        ];

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
        UserMenu::destroy(['id' => $request->id]);
        $uam = UserAccessMenu::where(['id_menu' => $request->id])->get();
        foreach($uam as $uam){
            UserAccessMenu::destroy(['id'=> $uam->id]);
        }
        return redirect('/admin/configuration/menu')->with('success', 'Menu dihapus');
    }
}
