<?php

namespace App\Http\Controllers\Admin;

use App\Events\NotifEvent;
use App\Http\Controllers\Controller;

use App\Models\Items;
use App\Models\Principal;
use App\Models\TypeItems;
use App\Models\Uom;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
    public function index(){

        return view('admin.items.index', ['items' => DB::select("CALL sp_list_items()")]);
    }

    public function addmodal(){
        return view('admin.items.addmodal', ['principal'=> Principal::all(), 'uom'=>Uom::all(), 'type' => TypeItems::all()]);
    }

    public function store(Request $request){
        $data = [
                    $request->stock_code,
                    $request->stock_name,
                    $request->description,
                    $request->type,
                    $request->base_qty,
                    $request->uom_id,
                    $request->unit_box,
                    $request->partner_id,
                    $request->vat,
                    1
                ];
        DB::select("CALL sp_insert_items('".$request->stock_code."',
        '".$request->stock_name."',
        '".$request->description."',
        '".$request->type."',
        $request->base_qty,
        $request->uom_id,
        $request->unit_box,
        0,
        0,
        0,
        0,
        0,
        0,
        0,
        0,
        0,
        0,
        0,
        0,
        0,
        0,
        $request->partner_id,
        0,
        0,
        $request->vat,
        1)");
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Items",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah items ". $request->stock_name
        ]);
        NotifEvent::dispatch(auth()->user()->name .' menambahkan Items '. $request->stock_name);
        return redirect()->back()->with('success', 'Data Item Ditambahkan !');
    }

    public function editmodal(Request $request){
        $item = Items::where(['id'=>$request->id])->first();

        return view('admin.items.editmodal', ['item' => $item, 'uom' => Uom::all(), 'principal' => Principal::all(), 'type'=>TypeItems::all()]);
    }

    public function update(Request $request){
        DB::select("CALL sp_update_items($request->id, '".$request->stock_code."',
        '".$request->stock_name."',
        '".$request->description."',
        '".$request->type."',
        $request->base_qty,
        $request->uom_id,
        $request->unit_box,
        $request->partner_id,
        $request->vat,
        1)");
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Items",
            'aktivitas' => "Ubah",
            'keterangan' => "Ubah items ". $request->stock_name
        ]);
        NotifEvent::dispatch(auth()->user()->name .' mengubah Items menjadi '. $request->stock_name);
        return redirect()->back()->with('success', 'Data Item diUpdate !');
    }

    public function destroy(Request $request){
        $items = Items::where(['id' => $request->id])->first();

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Items",
            'aktivitas' => "Hapus",
            'keterangan' => "Hapus items ". $items->stock_name
        ]);
        NotifEvent::dispatch(auth()->user()->name .' menghapus Items  '. $items->stock_name);
        DB::select("CALL sp_delete_items($request->id)");
        return redirect()->back()->with('success', 'Data Item Dihapus !');
    }
}
