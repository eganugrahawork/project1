<?php

namespace App\Http\Controllers\Admin\Procurement;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PurchaseBasisController extends Controller
{
    public function index(){
        return view('admin.procurement.purchasebasis.index');
    }

    public function filter(Request $request){
       $x = explode(' - ',$request->date_range);
    //    dd($x);


        return response()->json(['data' => $request->date_range]);
    }
}
