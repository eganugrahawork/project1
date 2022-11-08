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

class DashboardController extends Controller {
    public function index() {

        return view('admin.dashboard.index', ['title' => 'Dashboard']);
    }

    public function useractivity() {

        return view('admin.useractivity.index');
    }

    public function listuseractivity() {
        $activity = DB::connection('masterdata')->select('SELECT a.created_at, a.menu, a.aktivitas, a.keterangan, b.name, b.username, b.image FROM user_activities a JOIN users b ON a.id_user = b.id ORDER BY a.id DESC');

        return  Datatables::of($activity)->addIndexColumn()->addColumn('usernya', function($model){
            $url = url('storage/'. $model->image);
            $user = "<div class='symbol symbol-circle symbol-50px overflow-hidden me-3'>
            <a href='#'>
                <div class='symbol-label'>
                    <img src='$url' alt='' class='w-100' />
                </div>
            </a>
        </div>
        <div class='d-flex flex-column'>
            <a href='#' class='text-gray-800 text-hover-primary mb-1'>$model->name</a>
            <span>$model->username</span>
        </div>";
        return $user;
        })->rawColumns(['usernya'])->make(true);
    }

    public function listnotification() {
        $activity = DB::connection('masterdata')->select('SELECT a.created_at, a.menu, a.aktivitas, a.keterangan, b.email, b.username, b.image FROM user_activities a JOIN users b ON a.id_user = b.id ORDER BY a.id DESC');
        return view('admin.layouts.listnotification', ['activity' => $activity]);
    }

    public function checknotification() {
        return response()->json(UserActivity::count());
    }

    public function listuseronline() {
        $uonline = DB::connection('masterdata')->select('select * from users where status_access = 1 and id <> ' . auth()->user()->id);
        return view('admin.layouts.listuseronline', ['uonline' => $uonline]);
    }

    public function openchat(Request $request) {
        $user = User::where(['id' => $request->id])->first();
        return view('admin.layouts.chatroom', ['user' => $user]);
    }

    public function loadmenu(Request $request) {
        // dd($request->role_id);
        $menu = DB::connection('masterdata')->select("select b.id, b.parent, b.name, b.url, b.icon from menu_access a join menus b on a.menu_id = b.id where a.role_id = $request->role_id and status = 1 and b.parent = $request->parent");
        // dd($request->parent);
        $html = '';
        foreach ($menu as $mn) {
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

        $request->session()->push('menu', $html);

        return response()->json($html);
    }
}
