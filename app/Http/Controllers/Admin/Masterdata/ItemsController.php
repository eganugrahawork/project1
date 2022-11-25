<?php

namespace App\Http\Controllers\Admin\Masterdata;

use App\Events\NotifEvent;
use App\Http\Controllers\Controller;
use App\Models\ItemPrice;
use App\Models\ItemQty;
use App\Models\ItemReceipt;
use App\Models\Items;
use App\Models\Partners;
use App\Models\TypeItems;
use App\Models\Uom;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class ItemsController extends Controller {
    public function index() {

        return view('admin.masterdata.items.index');
    }

    public function list() {
        return  Datatables::of(DB::connection('masterdata')->select("CALL sp_list_items()"))->addIndexColumn()
            ->addColumn('action', function ($model) {
                $action = "<a onclick='infoModal($model->id)' class='btn btn-sm btn-icon btn-info btn-hover-rise me-1'><i class='bi bi-info-square'></i></a>";
                if (Gate::allows('edit', ['/admin/masterdata/items'])) {
                    $action .= "<a onclick='editModal($model->id)' class='btn btn-sm btn-icon btn-warning btn-hover-rise me-1'><i class='bi bi-pencil-square'></i></a>";
                }
                if (Gate::allows('delete', ['/admin/masterdata/items'])) {
                    $action .= " <a href='/admin/masterdata/items/delete/$model->id' class='btn btn-sm btn-icon btn-danger btn-hover-rise me-1' id='deleteItem'><i class='bi bi-trash'></i></a>";
                }
                return $action;
            })->make(true);
    }

    public function addmodal() {
        return view('admin.masterdata.items.addmodal', ['partner' => Partners::all(), 'uom' => Uom::all(), 'type' => TypeItems::all()]);
    }

    public function store(Request $request) {
        DB::connection('masterdata')->select("call sp_insert_items(
                    '$request->item_code',
                     '$request->item_name',
                    '$request->item_description',
                    '$request->type_id',
                    $request->uom_id,
                    $request->partner_id,
                    $request->vat,
                    $request->status,
                    1,
                    $request->unit_box
    )");

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Items",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah items " . $request->item_name
        ]);
        NotifEvent::dispatch(auth()->user()->name . ' menambahkan Items ' . $request->item_name);
        return response()->json(['success' => 'Data Item Ditambahkan !']);
    }

    public function infomodal(Request $request) {
        $item = Items::where(['id' => $request->id])->first();

        return view('admin.masterdata.items.infomodal', ['item' => $item]);
    }

    public function getinfoitemreceipt(Request $request) {
        // return  Datatables::of(ItemReceipt::where([]))->addIndexColumn()
        // ->addColumn('action', function ($model) {

        //     return $action;
        // })->make(true);
    }

    public function editmodal(Request $request) {
        $item = Items::where(['id' => $request->id])->first();

        return view('admin.masterdata.items.editmodal', ['item' => $item, 'uom' => Uom::all(), 'partner' => Partners::all(), 'type' => TypeItems::all()]);
    }

    public function update(Request $request) {

        DB::connection('masterdata')->select("call sp_update_items(
        $request->id,
         '$request->item_code',
             '$request->item_name',
             '$request->item_description',
             '$request->type_id',
             $request->uom_id,
             $request->unit_box,
             $request->partner_id,
             $request->vat,
             $request->status
    )");

        // Items::where(['id' => $request->id])->update($data);

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Items",
            'aktivitas' => "Ubah",
            'keterangan' => "Ubah items " . $request->item_name
        ]);
        NotifEvent::dispatch(auth()->user()->name . ' mengubah Items menjadi ' . $request->item_name);
        return response()->json(['success' => 'Data Item diUpdate !']);
    }

    public function destroy(Request $request) {
        $items = Items::where(['id' => $request->id])->first();

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Items",
            'aktivitas' => "Hapus",
            'keterangan' => "Hapus items " . $items->item_name
        ]);
        NotifEvent::dispatch(auth()->user()->name . ' menghapus Items  ' . $items->item_name);
        DB::connection('masterdata')->select("CALL sp_delete_items($request->id)");
        return redirect()->back()->with('success', 'Data Item Dihapus !');
    }

    public function typeitems() {

        return view('admin.masterdata.items.typeitem.index', ['itemtype' => DB::connection('masterdata')->select('call sp_list_item_types')]);
    }

    public function typeitemsaddmodal() {
        return view('admin.masterdata.items.typeitem.addtypeitemsmodal');
    }

    public function typeitemseditmodal(Request $request) {

        return view('admin.masterdata.items.typeitem.edittypeitemsmodal', ['typeitems' => TypeItems::where(['id' => $request->id])->first()]);
    }

    public function typeitemsstore(Request $request) {

        DB::connection('masterdata')->select("call sp_insert_item_types(
            '$request->type_code',
            '$request->name_type',
            '$request->description',
            $request->status
        )");

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Type Items",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah Type items " . $request->name_type
        ]);
        NotifEvent::dispatch(auth()->user()->name . ' Tambah Type Items  ' . $request->name_type);

        return redirect()->back()->with('success',  'Type Items added');
    }

    public function typeitemsupdate(Request $request) {
        DB::connection('masterdata')->select("call sp_update_item_types(
            $request->id,
            '$request->type_code',
            '$request->name_type',
            '$request->description',
            $request->status
        )");

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Type Items",
            'aktivitas' => "Update",
            'keterangan' => "Update Type items " . $request->name_type
        ]);
        NotifEvent::dispatch(auth()->user()->name . ' Update Type Items  ' . $request->name_type);
        return redirect('/admin/masterdata/typeitems')->with(['success' => 'Type Items edited']);
    }

    public function typeitemsdelete(Request $request) {
        DB::connection('masterdata')->select("call sp_delete_item_types(
            $request->id
        )");
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Type Items",
            'aktivitas' => "Hapus",
            'keterangan' => "Hapus Type items dengan id " . $request->id
        ]);
        NotifEvent::dispatch(auth()->user()->name . ' Hapus Type Items dengan id  ' . $request->id);
        return redirect('/admin/masterdata/typeitems')->with(['success' => 'Type Items Deleted']);
    }

    public function itemprice() {

        return view('admin.masterdata.items.itemprice.index', ['itemprice' => ItemPrice::all()]);
    }
    public function itemqty() {

        return view('admin.masterdata.items.itemqty.index', ['itemqty' => ItemQty::all()]);
    }

    public function addModalItemPrice() {

        $items = Items::all();
        return view('admin.masterdata.items.itemprice.addmodal', ['items' => $items]);
    }

    public function getdetailitem(Request $request) {

        $itemss = Items::where(['id' => $request->id])->first();

        return response()->json(['uom' => $itemss->uom->name, 'partner' => $itemss->partner->name]);
    }

    public function storeitemprice(Request $request) {
        ItemQty::create(['item_id' => $request->item_id, 'status' => 1]);
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

        return redirect()->back()->with(['success' =>  'Item Price ditambahkan']);
    }

    public function editmodalitemprice(Request $request) {

        return view('admin.masterdata.items.itemprice.editmodal', ['itemprice' =>  ItemPrice::where(['id' => $request->id])->first()]);
    }

    public function updateitemprice(Request $request) {
        ItemPrice::where(['id' => $request->id])->update(['status' => 0]);

        $itemqty = ItemQty::where(['id' => $request->qty_item_id])->first();

        ItemQty::create(['item_id' => $request->item_id, 'base_qty' => $itemqty->base_qty, 'unit_box' => $itemqty->unit_box, 'qty_receive' => $itemqty->qty_receive, 'qty_discount' => $itemqty->qty_discount, 'qty_bonus' => $itemqty->qty_bonus, 'status' => 1]);

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
            'status' => 1
        ]);

        return redirect()->back()->with(['success' => 'Item Price diupdate']);
    }
}
