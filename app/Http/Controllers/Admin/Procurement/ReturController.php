<?php

namespace App\Http\Controllers\Admin\Procurement;

use App\Events\NotifEvent;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ReturController extends Controller
{
    public function index(){
        return view('admin.procurement.retur.index');
    }

    public function list(){

    }
}
