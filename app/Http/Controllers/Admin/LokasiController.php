<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;



use App\Models\Lokasi;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use PDO;

class LokasiController extends Controller
{
    public function store(Request $request){
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Lokasi",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah Lokasi  $request->lokasi"
        ]);
        Lokasi::create(['lokasi'=> $request->lokasi]);
        return redirect()->back()->with('success', 'Success adding Location');
    }

    public function destroy(Request $request){
        $oldLokasi = Lokasi::where(['id'=>$request->id])->first();
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Lokasi",
            'aktivitas' => "Hapus",
            'keterangan' => "Hapus Lokasi $oldLokasi->lokasi"
        ]);
        Lokasi::destroy($request->id);
        return redirect('/admin/configuration/menu')->with('success', 'Location Deleted');
    }

    public function update(Request $request){
        $oldLokasi = Lokasi::where(['id'=>$request->id])->first();
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Lokasi",
            'aktivitas' => "Ubah",
            'keterangan' => "Ubah Lokasi $oldLokasi->lokasi menjadi $request->lokasi"
        ]);
        Lokasi::where(['id'=> $request->id])->update(['lokasi' => $request->lokasi]);
        return redirect()->back()->with('success', 'Location Updated');
    }

    public function editmodal(Request $request){
        $lokasi = Lokasi::where(['id'=> $request->id])->first();

        return view('admin.usermenu.editmodallokasi', ['lokasi'=>$lokasi]);
    }
}
