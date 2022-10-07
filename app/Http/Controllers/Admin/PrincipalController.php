<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Eksternal;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function index(){

        return view('admin.principal.index', ['principal' => Eksternal::all()]);
    }

    public function addmodal(){
        return view('admin.principal.addmodal');
    }

    public function store(Request $request){

        Eksternal::create([
            'kode_eksternal' => $request->kode_eksternal,
			'name_eksternal' => $request->name_eksternal,
			'eksternal_address' => $request->eksternal_address,
			'phone_1' => $request->phone_1,
			'fax' =>$request->fax,
			'bank1' => $request->bank1,
			'email' => $request->email,
			'rek1' => $request->rek1,
			'bank2' => $request->bank2,
			'rek2' => $request->rek2,
			'bank3' => $request->bank3,
			'rek3' =>$request->rek3,
			'type_eksternal' => $request->type_eksternal,
            'sts_show' => 1
        ]);

        return back()->with('success', 'Principal berhasil ditambahkan!');
    }

    public function destroy(Request $request){
        Eksternal::where(['id'=>$request->id])->delete();
        return back()->with('success', 'Principal berhasil dihapus!');
    }

    public function editmodal(Request $request){

        return view('admin.principal.editmodal', ['eks' => Eksternal::where(['id'=> $request->id])->first()]);
    }

    public function update(Request $request){
        Eksternal::where(['id' => $request->id])->update([
            'kode_eksternal' => $request->kode_eksternal,
			'name_eksternal' => $request->name_eksternal,
			'eksternal_address' => $request->eksternal_address,
			'phone_1' => $request->phone_1,
			'fax' =>$request->fax,
			'bank1' => $request->bank1,
			'email' => $request->email,
			'rek1' => $request->rek1,
			'bank2' => $request->bank2,
			'rek2' => $request->rek2,
			'bank3' => $request->bank3,
			'rek3' =>$request->rek3,
			'type_eksternal' => $request->type_eksternal,
            'sts_show' => $request->sts_show
        ]);

        return back()->with('success', 'Principal berhasil diUpdate!');
    }
}
