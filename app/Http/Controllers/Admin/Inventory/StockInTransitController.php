<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StockInTransitController extends Controller
{
    public function index(){
        return view('admin.inventory.stockintransit.index');
    }
}
