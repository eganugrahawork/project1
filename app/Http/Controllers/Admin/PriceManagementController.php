<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class PriceManagementController extends Controller
{
    public function index(){

        return view('admin.pricemanagement.index', ['items' => Material::all()]);
    }

    public function editmodal(Request $request){

        return view('admin.pricemanagement.editmodal',['item' => Material::where(['id_mat' => $request->id])->first()]);
    }

    public function update(Request $request){
        Material::where(['id_mat' =>$request->id_mat])->update([
            'top_price' => $request->top_price,
            'bottom_price' => $request->bottom_price,
            'buy_price' => $request->buy_price
        ]);
        return redirect()->back()->with('success', 'Data Item diUpdate !');
    }
}
