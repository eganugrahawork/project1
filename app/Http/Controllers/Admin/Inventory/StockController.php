<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(){
        return view('admin.inventory.stock.index');
    }
}
