<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Eksternal;
use App\Models\Principal;
use App\Models\UserActivity;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function index(){

        return view('admin.principal.index', ['principal' => Principal::all()]);
    }

    public function addmodal(){
        return view('admin.principal.addmodal');
    }

    public function store(Request $request){

        Principal::create([
            'code' => $request->code,
			'name' => $request->name,
			'phone' => $request->phone,
			'fax' => $request->fax,
			'email' =>$request->email,
			'address' => $request->address,
			'ship_address' => $request->ship_address,
			'bank_name' => $request->bank_name,
			'account_number' => $request->account_number,
            'status' => 1
        ]);

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Principal",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah Principal ". $request->name
        ]);
        return back()->with('success', 'Principal berhasil ditambahkan!');
    }

    public function destroy(Request $request){
        $principalnya = Principal::where(['id' =>$request->id])->first();
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Principal",
            'aktivitas' => "Hapus",
            'keterangan' => "Hapus Principal ". $principalnya->name
        ]);
        Principal::where(['id'=>$request->id])->delete();
        return back()->with('success', 'Principal berhasil dihapus!');
    }

    public function editmodal(Request $request){

        return view('admin.principal.editmodal', ['principal' => Principal::where(['id'=> $request->id])->first()]);
    }

    public function update(Request $request){
        Principal::where(['id' => $request->id])->update([
            'code' => $request->code,
			'name' => $request->name,
			'phone' => $request->phone,
			'fax' => $request->fax,
			'email' =>$request->email,
			'address' => $request->address,
			'ship_address' => $request->ship_address,
			'bank_name' => $request->bank_name,
			'account_number' => $request->account_number,
            'status' => $request->status
        ]);
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Principal",
            'aktivitas' => "Update",
            'keterangan' => "Update Principal ". $request->name
        ]);
        return back()->with('success', 'Principal berhasil diUpdate!');
    }
}
