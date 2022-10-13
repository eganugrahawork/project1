<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Items;
use App\Models\PriceHistory;
use App\Models\Principal;
use App\Models\TypeItems;
use App\Models\Uom;
use App\Models\UserActivity;
use DateTime;
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
        $request->partner_id,
        $request->vat,
        1)");
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Items",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah items ". $request->name
        ]);
        return redirect()->back()->with('success', 'Data Item Ditambahkan !');
    }

    public function editmodal(Request $request){
        $item = Items::where(['id'=>$request->id])->first();

        return view('admin.items.editmodal', ['item' => $item, 'uom' => Uom::all(), 'principal' => Principal::all(), 'type'=>TypeItems::all()]);
    }

    public function update(Request $request){
        // Items::where(['id' =>$request->id])->update([
        //     'code' => $request->code,
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'base_qty' => $request->base_qty,
        //     'uom_id' => $request->uom_id,
        //     'unit_box' => $request->unit_box,
        //     'type' => $request->type,
        //     'vat' => $request->vat,
        //     'partner_id' => $request->partner_id,
        //     'status' => $request->status
        // ]);

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
            'keterangan' => "Ubah items ". $request->name
        ]);
        return redirect()->back()->with('success', 'Data Item diUpdate !');
    }

    public function destroy(Request $request){
        $items = Items::where(['id' => $request->id])->first();

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Items",
            'aktivitas' => "Hapus",
            'keterangan' => "Hapus items ". $items->name
        ]);
        DB::select("CALL sp_delete_items($request->id)");
        // Items::where(['id' => $request->id])->delete();
        return redirect()->back()->with('success', 'Data Item Dihapus !');
    }
}
