<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Region;
use App\Models\UserActivity;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function store(Request $request){
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Region",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah Region  $request->name"
        ]);
        Region::create(['name'=> $request->name, 'status' => 1]);
        return redirect()->back()->with('success', 'Success adding Location');
    }

    public function destroy(Request $request){
        $oldRegion = Region::where(['id'=>$request->id])->first();
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Lokasi",
            'aktivitas' => "Hapus",
            'keterangan' => "Hapus Lokasi $oldRegion->name"
        ]);
        Region::destroy($request->id);
        return redirect('/admin/configuration/menu')->with('success', 'Location Deleted');
    }

    public function update(Request $request){
        $oldRegion = Region::where(['id'=>$request->id])->first();
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Region",
            'aktivitas' => "Ubah",
            'keterangan' => "Ubah Region $oldRegion->name menjadi $request->name"
        ]);
        Region::where(['id'=> $request->id])->update(['name' => $request->name]);
        return redirect()->back()->with('success', 'Location Updated');
    }

    public function editmodal(Request $request){
        $region = Region::where(['id'=> $request->id])->first();

        return view('admin.configuration.region.editmodalregion', ['region'=>$region]);
    }
}
