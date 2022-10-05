<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Eksternal;
use App\Models\Items;
use App\Models\Material;
use App\Models\TypeMaterial;
use App\Models\Uom;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index(){
        return view('admin.items.index', ['items' => Items::all()]);
    }

    public function addmodal(){
        return view('admin.items.addmodal', ['principal'=> Eksternal::all(), 'uom'=>Uom::all(), 'type' => TypeMaterial::all()]);
    }

    public function store(Request $request){
        Material::create([
            'stock_code' => $request->stock_code,
            'stock_name' => $request->stock_name,
            'stock_desc' => $request->stock_desc,
            'base_qty' => $request->base_qty,
            'unit_terkecil' => $request->unit_terkecil,
            'unit_box' => $request->unit_box,
            'type' => $request->type,
            'pajak' => $request->pajak,
            'dist_id' => $request->dist_id,
            'sts_show' => 1
        ]);
        return redirect()->back()->with('success', 'Data Item Ditambahkan !');
    }

    public function destroy(Request $request){
        // dd($request->id);
        Material::where(['id_mat' => $request->id])->delete();
        return redirect()->back()->with('success', 'Data Item Dihapus !');
    }

    public function editmodal(Request $request){
        $item = Material::where(['id_mat'=>$request->id])->first();

        return view('admin.items.editmodal', ['item' => $item, 'uom' => Uom::all(), 'principal' => Eksternal::all(), 'type'=>TypeMaterial::all()]);
    }

    public function update(Request $request){
        Material::where(['id_mat' =>$request->id_mat])->update([
            'stock_code' => $request->stock_code,
            'stock_name' => $request->stock_name,
            'stock_desc' => $request->stock_desc,
            'base_qty' => $request->base_qty,
            'unit_terkecil' => $request->unit_terkecil,
            'unit_box' => $request->unit_box,
            'type' => $request->type,
            'pajak' => $request->pajak,
            'dist_id' => $request->dist_id,
            'sts_show' => $request->sts_show
        ]);
        return redirect()->back()->with('success', 'Data Item diUpdate !');
    }
}
