<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\Test;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    public function index(){

        return view('admin.dashboard.index', ['title' => 'Dashboard']);
    }

    public function useractivity(){


        return view('admin.useractivity.index');
    }
    public function listuseractivity(){
        $activity = DB::connection('masterdata')->select('SELECT a.created_at, a.menu, a.aktivitas, a.keterangan, b.email FROM user_activities a JOIN users b ON a.id_user = b.id');

        // dd($activity);
        return  Datatables::of($activity)->addIndexColumn()->make(true);
    }

    public function checkonline(){

        return view('admin.layouts.viewonline');
    }

    public function checknotification(){
      return response()->json(UserActivity::count());
    }

    public function loadmenu(Request $request){
        // dd($request->role_id);
        $menu = DB::connection('masterdata')->select("select b.id, b.parent, b.name, b.url, b.icon from menu_access a join menus b on a.menu_id = b.id where a.role_id = $request->role_id and status = 1 and b.parent = $request->parent");
        // dd($request->parent);
        $html = '';
        foreach ($menu as $mn){
            $submenu = DB::connection('masterdata')->select("select b.id, b.parent, b.name, b.url, b.icon from menu_access a join menus b on a.menu_id = b.id where a.role_id = $request->role_id and status = 1 and b.parent = $mn->id");
            if($submenu){
                $html .= "<div data-kt-menu-trigger='click' data-kt-menu-placement='bottom-start' class='menu-item menu-lg-down-accordion me-lg-1'>
                <span class='menu-link  py-3'>
                    <span class='menu-title'>$mn->name</span>
                    <span class='menu-arrow d-lg-none'></span>
                </span>
                <div class='menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px'>";



                foreach($submenu as $sm){
                    $tandapetik = '"';
                    $subOnSubmenu = DB::connection('masterdata')->select("select b.id, b.parent, b.name, b.url, b.icon from menu_access a join menus b on a.menu_id = b.id where a.role_id = $request->role_id and status = 1 and b.parent = $sm->id");

                    if($subOnSubmenu){
                        $html .= "<div data-kt-menu-trigger=". $tandapetik . "{default:'click', lg: 'hover'}". $tandapetik." data-kt-menu-placement='right-start' class='menu-item menu-lg-down-accordion'>
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

                        foreach($subOnSubmenu as $sosm){
                            $html .= "<div class='menu-item'>
                                        <a class='menu-link py-3' href='$sosm->url'>
                                            <span class='menu-bullet'>
                                                <span class='bullet bullet-dot'></span>
                                            </span>
                                            <span class='menu-title  text-gray-700'>$sosm->name</span>
                                        </a>
                                    </div>";
                        }
                        $html .= "</div></div>";
                    }else{
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
                $html .= '</div></div>';
            }else{
                $html .= "<div data-kt-menu-placement='bottom-start' class='menu-item menu-lg-down-accordion me-lg-1'>
                <a class='menu-link py-3' href='$mn->url'>
                <span class='menu-title'>$mn->name</span>
                <span class='menu-arrow d-lg-none'></span>
                </a>
                </div>";
            }
        }


        return response()->json($html);
    }
}
