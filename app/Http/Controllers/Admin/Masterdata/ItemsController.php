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
                $action = "<a onclick='info($model->id)' class='btn btn-sm btn-icon btn-info btn-hover-rise me-1'><i class='bi bi-info-square'></i></a>";
                if (Gate::allows('edit', ['/admin/masterdata/items'])) {
                    $action .= "<a onclick='edit($model->id)' class='btn btn-sm btn-icon btn-warning btn-hover-rise me-1'><i class='bi bi-pencil-square'></i></a>";
                }
                if (Gate::allows('delete', ['/admin/masterdata/items'])) {
                    $action .= " <a href='/admin/masterdata/items/delete/$model->id' class='btn btn-sm btn-icon btn-danger btn-hover-rise me-1' id='deleteItem'><i class='bi bi-trash'></i></a>";
                }
                return $action;
            })->make(true);
    }

    public function create() {
        return view('admin.masterdata.items.create', ['partner' => Partners::all(), 'uom' => Uom::all(), 'type' => TypeItems::all()]);
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

    public function info(Request $request) {
        $item = Items::where(['id' => $request->id])->first();

        return view('admin.masterdata.items.info', ['item' => $item]);
    }

    public function getinfoitemreceipt(Request $request) {
        // return  Datatables::of(ItemReceipt::where([]))->addIndexColumn()
        // ->addColumn('action', function ($model) {

        //     return $action;
        // })->make(true);
    }

    public function edit(Request $request) {
        $item = Items::where(['id' => $request->id])->first();

        return view('admin.masterdata.items.edit', ['item' => $item, 'uom' => Uom::all(), 'partner' => Partners::all(), 'type' => TypeItems::all()]);
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


    public function itemprice() {

        return view('admin.masterdata.items.itemprice.index', ['itemprice' => ItemPrice::all()]);
    }
    public function itemqty() {

        return view('admin.masterdata.items.itemqty.index', ['itemqty' => ItemQty::all()]);
    }


}
