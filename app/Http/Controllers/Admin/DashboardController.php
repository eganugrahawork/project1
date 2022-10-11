<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index(){

        return view('admin.dashboard.index', ['title' => 'Dashboard']);
    }

    public function useractivity(){

        $user = UserActivity::orderBy('id','DESC')->get();
        return view('admin.useractivity.index', ['user' => $user]);
    }

}
