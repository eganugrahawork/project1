<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StockInTransitController extends Controller
{
    public function index(){
        return view('admin.inventory.stockintransit.index');
    }

    public function filter(Request $request){
        $date = explode(' - ',$request->date_range);


        return response()->json(['data' => $date[0]]);
    }
}
