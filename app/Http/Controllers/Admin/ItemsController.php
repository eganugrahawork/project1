<?php

namespace App\Http\Controllers\Admin;

use App\Events\NotifEvent;
use App\Http\Controllers\Controller;
use App\Models\ItemPrice;
use App\Models\ItemQty;
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

        return view('admin.items.index', ['items' => DB::connection('masterdata')->select("CALL sp_list_items()")]);
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
        DB::connection('masterdata')->select("CALL sp_delete_items($request->id)");
        return redirect()->back()->with('success', 'Data Item Dihapus !');
    }

    public function typeitems(){

        return view('admin.items.typeitems', ['itemtype' => TypeItems::all()]);
    }

    public function typeitemsaddmodal(){
        return view('admin.items.addtypeitemsmodal');
    }

    public function typeitemseditmodal(Request $request){

        return view('admin.items.edittypeitemsmodal', ['typeitems'=>TypeItems::where(['id'=>$request->id])->first()]);
    }

    public function typeitemsstore(Request $request){
        TypeItems::create([
            'type_code' => $request->type_code,
            'name_type' => $request->name_type,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect()->back()->with(['success' => 'Type Items added']);
    }

    public function typeitemsupdate(Request $request){
        TypeItems::where(['id' => $request->id])->update([
            'type_code' => $request->type_code,
            'name_type' => $request->name_type,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect()->back()->with(['success' => 'Type Items edited']);
    }

    public function typeitemsdelete(Request $request){
        TypeItems::where(['id' => $request->id])->delete();

        return redirect()->back()->with(['success' => 'Type Items Deleted']);
    }

    public function itemprice(){

        return view('admin.items.itemprice.index', ['itemprice' => ItemPrice::all()]);
    }
    public function itemqty(){

        return view('admin.items.itemqty.index', ['itemqty' => ItemQty::all()]);
    }

    public function addModalItemPrice(){
        // $items = DB::connection('masterdata')->select("SELECT a.id, CONCAT_WS(" - ",a.`item_code`,a.`item_name`,b.`name`) itemnya FROM items a JOIN uom b ON a.uom_id = b.id JOIN partners c ON a.partner_id = c.id");
        $items=Items::all();
        return view('admin.items.itemprice.addmodal', ['items' =>$items]);
    }

    public function getdetailitem(Request $request){
    //    $itemss = DB::connection('masterdata')->select("select b.name , c.name  from items a join uom b on a.uom_id = b.id join partners c on a.partner_id = c.id where a.id = $request->id");
        $itemss = Items::where(['id' => $request->id])->first();
        // dd($itemss);
        // $item = json_decode($itemss, true);
        return response()->json(['uom' => $itemss->uom->name, 'partner' => $itemss->partner->name]);
    }

    public function storeitemprice(Request $request){
        ItemQty::create(['item_id' => $request->item_id, 'status'=>1]);
        $lastItemqty = ItemQty::latest()->first();

        ItemPrice::create([
            'item_id' => $request->item_id,
            'qty_item_id' => $lastItemqty->id,
            'buy_price' => $request->buy_price,
            'base_price' => $request->base_price,
            'bottom_price' => $request->bottom_price,
            'top_price' => $request->top_price,
            'price_pcs' => $request->price_pcs,
            'status' => 1
        ]);



        return redirect()->back()->with(['success'=>  'Item Price ditambahkan']);
    }

    public function editmodalitemprice(Request $request){

        return view('admin.items.itemprice.editmodal', ['itemprice' =>  ItemPrice::where(['id' => $request->id])->first()]);
    }

    public function updateitemprice(Request $request){
        ItemPrice::where(['id'=>$request->id])->update(['status' => 0]);

       $itemqty = ItemQty::where(['id' => $request->qty_item_id])->first();

       ItemQty::create(['item_id' => $request->item_id, 'base_qty' => $itemqty->base_qty, 'unit_box' => $itemqty->unit_box, 'qty_receive' => $itemqty->qty_receive, 'qty_discount'=> $itemqty->qty_discount, 'qty_bonus' => $itemqty->qty_bonus, 'status' => 1]);

       ItemQty::where(['id' => $request->qty_item_id])->update(['status' => 0]);
       $lastItemqty = ItemQty::latest()->first();
        ItemPrice::create([
            'item_id' => $request->item_id,
            'qty_item_id' => $lastItemqty->id,
            'buy_price' => $request->buy_price,
            'base_price' => $request->base_price,
            'bottom_price' => $request->bottom_price,
            'top_price' => $request->top_price,
            'price_pcs' => $request->price_pcs,
            'status'=> 1
        ]);

        return redirect()->back()->with(['success'=> 'Item Price diupdate']);
    }
}
