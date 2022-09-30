<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserAccessMenu;
use App\Models\UserActivity;
use App\Models\UserMenu;
use App\Models\UserSubmenu;
use Illuminate\Http\Request;

class UserSubmenuController extends Controller
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

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Submenu",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah Submenu  $request->submenu"
        ]);

        UserSubmenu::create([
            'submenu' => $request->submenu,
            'icon' => $request->icon,
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
        $oldSubmenu = UserSubmenu::where(['id'=>$request->id])->first();
        if($oldSubmenu->icon !== $request->icon && $oldSubmenu->submenu === $request->submenu){
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Submenu",
            'aktivitas' => "Ubah",
            'keterangan' => "Ubah Icon $oldSubmenu->icon menjadi $request->icon"
        ]);
        }elseif($oldSubmenu->submenu !== $request->submenu){
            UserActivity::create([
                'id_user' => auth()->user()->id,
                'menu' => "Submenu",
                'aktivitas' => "Ubah",
                'keterangan' => "Ubah Submenu $oldSubmenu->submenu menjadi $request->submenu etc."
            ]);
        }elseif($oldSubmenu->urlsubmenu !== $request->urlsubmenu && $oldSubmenu->submenu === $request->submenu){
            UserActivity::create([
                'id_user' => auth()->user()->id,
                'menu' => "Submenu",
                'aktivitas' => "Ubah",
                'keterangan' => "Ubah Url $oldSubmenu->urlsubmenu menjadi $request->urlsubmenu"
            ]);
        }elseif($oldSubmenu->id_menu !== $request->id_menu && $oldSubmenu->submenu !== $request->submenu){
            UserActivity::create([
                'id_user' => auth()->user()->id,
                'menu' => "Submenu",
                'aktivitas' => "Ubah",
                'keterangan' => "Ubah Id_menu $oldSubmenu->id_menu menjadi $request->id_menu"
            ]);
        }
        UserSubmenu::where(['id' => $request->id])->update([
            'submenu' => $request->submenu,
            'icon' => $request->icon,
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
        $oldSubmenu = UserSubmenu::where(['id'=>$request->id])->first();
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Submenu",
            'aktivitas' => "Hapus",
            'keterangan' => "Hapus Submenu  $oldSubmenu->submenu"
        ]);
        UserSubmenu::destroy(['id'=>$request->id]);
        return redirect()->back()->with('success', 'Submenu dihapus');
    }

    public function editmodal(Request $request) {

       $submenu = UserSubmenu::where(['id' => $request->id])->first();
       $menu = UserMenu::where(['is_submenu' => 1])->get();
       return view('admin.usersubmenu.editmodal', ['submenu' => $submenu, 'menu' => $menu]);
    }
}
