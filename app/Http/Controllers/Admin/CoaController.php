<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coa;
use Illuminate\Http\Request;

class CoaController extends Controller
{
    public function index(){
        return view('admin.coa.index', ['coa'=>Coa::all()]);
    }

    public function addmodal(){
        return view('admin.coa.addmodal');
    }


    public function store(Request $request){
        Coa::create([
            'id_parent' => $request->id_parent,
            'coa' => $request->coa,
            'description' => $request->description
        ]);

        return redirect()->back()->with('success', 'Coa ditambahkan!');
    }

    public function editmodal(Request $request){

        return view('admin.coa.editmodal', ['coa' => Coa::where(['id' => $request->id])->first()]);
    }

    public function update(Request $request){
        Coa::where(['id'=>$request->id])->update([
            'id_parent' => $request->id_parent,
            'coa' => $request->coa,
            'description' => $request->description
        ]);

        return redirect()->back()->with('success', 'Coa di Update!');
    }

    public function destroy(Request $request){
        Coa::where(['id' => $request->id])->delete();
        return redirect()->back()->with('success', 'Coa di Hapus!');

    }
}
