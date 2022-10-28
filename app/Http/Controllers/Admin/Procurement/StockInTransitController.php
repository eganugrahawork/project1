<?php

namespace App\Http\Controllers\Admin\Procurement;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StockInTransitController extends Controller
{
    public function index(){
        return view('admin.inventory.stockintransit.index');
    }
}
