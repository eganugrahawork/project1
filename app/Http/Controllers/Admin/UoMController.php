<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\Uom;
use App\Models\UserActivity;
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
        Uom::create(['name' => $request->name,'symbol' => $request->symbol, 'description'=>$request->description]);

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "UOM",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah UOM ". $request->name
         ]);
        return redirect()->back()->with('success', 'Uom Ditambahkan');
    }

    public function destroy(Request $request){
        // dd($request->id);
       $uom = Uom::where(['id' => $request->id])->first();
       UserActivity::create([
        'id_user' => auth()->user()->id,
        'menu' => "UOM",
        'aktivitas' => "Hapus",
        'keterangan' => "Hapus UOM ". $uom->name
        ]);
        Uom::where(['id' => $request->id])->delete();
        return redirect()->back()->with('success', 'Data Uom Dihapus !');
    }

    public function editmodal(Request $request){

        return view('admin.uom.editmodal', ['uom'=> Uom::where(['id'=>$request->id])->first()]);
    }

    public function update(Request $request){
        Uom::where(['id' => $request->id])->update(['name' => $request->name,'symbol' => $request->symbol, 'description'=>$request->description]);
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "UOM",
            'aktivitas' => "Ubah",
            'keterangan' => "Ubah UOM ". $request->name
         ]);
        return redirect()->back()->with('success', 'Data Uom diUpdate !');
    }
}
