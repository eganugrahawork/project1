<?php

namespace App\Http\Controllers\Admin;

use App\Events\NotifEvent;
use App\Http\Controllers\Controller;

use App\Models\Items;
use App\Models\Partners;
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
        return view('admin.items.addmodal', ['partner'=> Partners::all(), 'uom'=>Uom::all(), 'type' => TypeItems::all()]);
    }

    public function store(Request $request){
        $data = [
                  'item_code' =>  $request->item_code,
                  'item_name'=>  $request->item_name,
                  'item_description'=> $request->item_description,
                  'type_id'=> $request->type_id,
                  'uom_id'=> $request->uom_id,
                  'partner_id'=> $request->partner_id,
                  'vat'=> $request->vat,
                  'status'=> $request->status
                ];

        Items::create($data);

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Items",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah items ". $request->item_name
        ]);
        NotifEvent::dispatch(auth()->user()->name .' menambahkan Items '. $request->item_name);
        return redirect()->back()->with('success', 'Data Item Ditambahkan !');
    }

    public function editmodal(Request $request){
        $item = Items::where(['id'=>$request->id])->first();

        return view('admin.items.editmodal', ['item' => $item, 'uom' => Uom::all(), 'partner' => Partners::all(), 'type'=>TypeItems::all()]);
    }

    public function update(Request $request){
        $data = [
            'item_code' =>  $request->item_code,
            'item_name'=>  $request->item_name,
            'item_description'=> $request->item_description,
            'type_id'=> $request->type_id,
            'uom_id'=> $request->uom_id,
            'partner_id'=> $request->partner_id,
            'vat'=> $request->vat,
            'status'=> $request->status
          ];

        Items::where(['id' => $request->id])->update($data);

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Items",
            'aktivitas' => "Ubah",
            'keterangan' => "Ubah items ". $request->item_name
        ]);
        NotifEvent::dispatch(auth()->user()->name .' mengubah Items menjadi '. $request->item_name);
        return redirect()->back()->with('success', 'Data Item diUpdate !');
    }

    public function destroy(Request $request){
        $items = Items::where(['id' => $request->id])->first();

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Items",
            'aktivitas' => "Hapus",
            'keterangan' => "Hapus items ". $items->item_name
        ]);
        NotifEvent::dispatch(auth()->user()->name .' menghapus Items  '. $items->item_name);
        DB::select("CALL sp_delete_items($request->id)");
        return redirect()->back()->with('success', 'Data Item Dihapus !');
    }

    public function typeitems(){
        return view('admin.items.typeitems');
    }
}
