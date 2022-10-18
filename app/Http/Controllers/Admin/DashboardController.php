<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
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

        $activity = DB::select('SELECT a.created_at, a.menu, a.aktivitas, a.keterangan, b.email FROM user_activities a JOIN users b ON a.id_user = b.id');

        // dd($activity);
        return  Datatables::of($activity)->addIndexColumn()->make(true);
    }

    public function checkonline(){

        return view('admin.layouts.viewonline');
    }

    public function checknotification(){
      return response()->json(UserActivity::count());
    }
}
