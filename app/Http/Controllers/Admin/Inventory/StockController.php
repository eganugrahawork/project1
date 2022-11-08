<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(){
        return view('admin.inventory.stock.index');
    }

    public function filter(Request $request){
       $datesFilter = explode(' - ', $request->date_range);
        // dd($datesFilter);

        return response()->json(['data'=> $datesFilter]);
    }
}
