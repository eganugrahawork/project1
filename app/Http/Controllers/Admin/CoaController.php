<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coa;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoaController extends Controller
{
    public function index(){
        return view('admin.coa.index', ['coa'=>DB::select('call sp_list_coa()')]);
    }

    public function addmodal(){
        return view('admin.coa.addmodal');
    }


    public function store(Request $request){
        // Coa::create([
        //     'id_parent' => $request->id_parent,
        //     'coa' => $request->coa,
        //     'description' => $request->description
        // ]);
// dd($request);
        DB::select("call sp_insert_coa(
            $request->id_parent,
            '$request->coa',
            '$request->description',
            $request->status
        )");

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "COA",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah COA ". $request->coa
        ]);

        return redirect()->back()->with('success', 'Coa ditambahkan!');
    }

    public function editmodal(Request $request){

        return view('admin.coa.editmodal', ['coa' => Coa::where(['id' => $request->id])->first()]);
    }

    public function update(Request $request){
        // Coa::where(['id'=>$request->id])->update([
        //     'id_parent' => $request->id_parent,
        //     'coa' => $request->coa,
        //     'description' => $request->description
        // ]);

        DB::select("call sp_update_coa(
            $request->id,
            '$request->coa',
            '$request->description',
            $request->status
        )");
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "COA",
            'aktivitas' => "Ubah",
            'keterangan' => "Ubah COA ". $request->coa
        ]);
        return redirect()->back()->with('success', 'Coa di Update!');
    }

    public function destroy(Request $request){
       $coa = Coa::where(['id' => $request->id])->first();
       UserActivity::create([
           'id_user' => auth()->user()->id,
           'menu' => "COA",
           'aktivitas' => "Hapus",
           'keterangan' => "Hapus COA ". $coa->coa
        ]);

        // Coa::where(['id' => $request->id])->delete();
        DB::select("call sp_delete_coa(
            $request->id
        )");
        return redirect()->back()->with('success', 'Coa di Hapus!');

    }
}
