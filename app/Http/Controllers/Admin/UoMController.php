<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\Uom;
use Illuminate\Http\Request;

class UoMController extends Controller
{
    public function index(){
        return view('admin.uom.index', ['uom'=> Uom::all()]);
    }

    public function addmodal(){
        return view('admin.uom.addmodal');
    }

    public function store(Request $request){
        Uom::create(['uom_name' => $request->uom_name,'uom_symbol' => $request->uom_symbol, 'description'=>$request->description]);
        return redirect()->back()->with('success', 'Uom Ditambahkan');
    }

    public function destroy(Request $request){
        // dd($request->id);
        Uom::where(['id_uom' => $request->id])->delete();
        return redirect()->back()->with('success', 'Data Uom Dihapus !');
    }

    public function editmodal(Request $request){

        return view('admin.uom.editmodal', ['uom'=> Uom::where(['id_uom'=>$request->id])->first()]);
    }

    public function update(Request $request){
        Uom::where(['id_uom' => $request->id_uom])->update(['uom_name' => $request->uom_name,'uom_symbol' => $request->uom_symbol, 'description'=>$request->description]);
        return redirect()->back()->with('success', 'Data Uom diUpdate !');
    }
}
