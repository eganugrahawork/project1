<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserAccessMenu;
use App\Models\UserMenu;
use App\Models\UserSubmenu;
use Illuminate\Http\Request;

class UserSubmenuController extends Controller
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
        $submenu = UserSubmenu::all();
        // dd($submenu);
        $menu = UserMenu::where(['is_submenu' => 1])->get();
        return view('admin.usersubmenu.index', ['title' => 'Configuration Submenu', 'submenu' => $submenu, 'menu'=>$menu]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        UserSubmenu::create([
            'submenu' => $request->submenu,
            'id_menu' => $request->id_menu,
            'urlsubmenu' => $request->urlsubmenu
        ]);

        return redirect()->back()->with('success', 'Submenu ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserSubmenu  $userSubmenu
     * @return \Illuminate\Http\Response
     */
    public function show(UserSubmenu $userSubmenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserSubmenu  $userSubmenu
     * @return \Illuminate\Http\Response
     */
    public function edit(UserSubmenu $userSubmenu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserSubmenu  $userSubmenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        UserSubmenu::where(['id' => $request->id])->update([
            'submenu' => $request->submenu,
            'id_menu' => $request->id_menu,
            'urlsubmenu' => $request->urlsubmenu
        ]);

        return redirect()->back()->with('success', 'Submenu diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserSubmenu  $userSubmenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        UserSubmenu::destroy(['id'=>$request->id]);
        return redirect()->back()->with('success', 'Submenu dihapus');
    }
}
