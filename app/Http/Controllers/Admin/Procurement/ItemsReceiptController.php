<?php

namespace App\Http\Controllers\Admin\Procurement;

use App\Http\Controllers\Controller;
use App\Models\ItemReceipt;
use App\Models\ItemReceiptDetail;
use App\Models\Mutation;
use App\Models\PurchaseOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use PDO;
use Yajra\DataTables\DataTables;

class ItemsReceiptController extends Controller {
    public function __construct() {
    }
    public function index() {
        return view('admin.procurement.itemsreceipt.index');
    }

    public function list() {
        return  Datatables::of(DB::connection('procurement')->select('Call sp_list_item_receipt()'))->addIndexColumn()
            ->addColumn('action', function ($model) {
                $action = "<a onclick='info($model->id_po)' class='btn btn-icon btn-sm btn-info me-1 btn-hover-rise'><i class='bi bi-info-square'></i></a>";
                if (Gate::allows('edit', ['/admin/procurement/items-receipt'])) {
                    $action .= "<a onclick='edit($model->id_po)' class='btn btn-icon btn-sm btn-warning me-1 btn-hover-rise'><i class='bi bi-pencil-square'></i></a>";
                }
                if (Gate::allows('delete', ['/admin/procurement/items-receipt'])) {
                    $action .= " <a href='/admin/procurement/items-receipt/delete/$model->id_receipt' class='btn btn-icon btn-sm btn-danger me-1 btn-hover-rise' id='deleteItemReceipt'><i class='bi bi-trash'></i></a>";
                }
                return $action;
            })->addColumn('order_datenya', function ($model) {
                return Carbon::parse($model->order_date)->format('d-M-Y');
            })->addColumn('receipt_date_filter', function ($model) {
                return Carbon::parse($model->receipt_date)->format('d-M-Y');
            })->make(true);
    }

    public function create() {
        return view('admin.procurement.itemsreceipt.create', ['purchase_orders' => PurchaseOrder::where(['status' => 1])->get()]);
    }
    public function info(Request $request) {
        $po = DB::connection('procurement')->select('Call sp_search_id_item_receipt(' . $request->id . ')');
        return view('admin.procurement.itemsreceipt.info', ['po' => $po]);
    }
    public function edit(Request $request) {
        $po = DB::connection('procurement')->select('Call sp_search_id_item_receipt(' . $request->id . ')');
        return view('admin.procurement.itemsreceipt.edit', ['po' => $po]);
    }

    public function getdatapo(Request $request) {
        $po = DB::connection('procurement')->select('Call sp_search_id_item_receipt(' . $request->id . ')');
        // dd($po);
        $html = '';
        foreach ($po as $item) {
            // $getBalance = DB::connection('procurement')->select('SELECT * FROM items_receipt_details a WHERE a.`po_item_id` = ' . $item->po_item_id . ' ORDER BY a.`id` DESC LIMIT 1');
            // if (count($getBalance) > 0) {
            //     $balance = $getBalance[0]->qty_balance;
            // } else {
            //     $balance = $item->qty;
            // }

            // if ($balance < 1) {
            //     $disabled = 'disabled';
            // } else {
            //     $disabled = '';
            // }

            $html .= "<div class='row'>
            <input type='hidden' name='po_item_id[]' value='$item->po_item_id'/>
            <input type='hidden' name='unit_price[]' value='$item->unit_price'/>
            <div class='fv-row mb-3 col-lg-2'>
                <label class=' form-label fw-bold'>Item</label>
                <select class='form-select  form-select-white mb-3 mb-lg-0' id='item_id' name='item_id[]'   required>
                        <option value='$item->item_id'>$item->item_name</option>
                </select>
            </div>
            <div class='fv-row mb-3 col-lg-2'>
                <label class=' fw-bold fs-6 mb-2'>Order Qty</label>
                <input type='number' name='qty_order[]' id='qty_order' value='$item->qty' readonly class='form-control form-control-white mb-3 mb-lg-0 '  required/>
            </div>
            <input type='hidden'  id='nowBalance' value='$item->qty_balance' readonly class='form-control form-control-white mb-3 mb-lg-0 '  required/>
            <div class='fv-row mb-3 col-lg-2'>
                <label class=' fw-bold fs-6 mb-2'>Balance</label>
                <input type='number' name='balance[]' id='balance' value='$item->qty_balance' readonly class='form-control form-control-white mb-3 mb-lg-0 '  required/>
            </div>
            <div class='fv-row mb-3 col-lg-2'>
                <label class='required fw-bold fs-6 mb-2'>Receipt</label>
                <input type='number' name='qty[]' id='qty' onkeyup='balanceEdit(this)' value='0'  class='form-control form-control-solid mb-3 mb-lg-0 ' required/>
            </div>
            <div class='fv-row mb-3 col-lg-1'>
                <label class='required fw-bold fs-6 mb-2'>Bonus</label>
                <input type='number' name='qty_bonus[]' id='qty_bonus' value='0'  class='form-control form-control-solid mb-3 mb-lg-0 ' required/>
            </div>

            <div class='fv-row mb-3 col-lg-1'>
                <label class='required fw-bold fs-6 mb-2'>Discount</label>
                <input type='number' name='qty_discount[]' id='qty_discount'  value='0' class='form-control form-control-solid mb-3 mb-lg-0 ' required/>
            </div>
            <div class='fv-row mb-3 col-lg-2'>
                <label class='required fw-bold fs-6 mb-2'>Note</label>
                <input type='text' name='notes[]' id='notes'  class='form-control form-control-solid mb-3 mb-lg-0 descriptionnya'  value='-'/>
            </div>
        </div>";
        }
        return response()->json([
            'code' => $po[0]->number_po,
            'order_date' => $po[0]->order_date,
            'partner' => $po[0]->partner_name,
            'address' => $po[0]->address,
            'phone' => $po[0]->phone,
            'fax' => $po[0]->fax,
            'html' => $html
        ]);
    }

    public function store(Request $request) {
        // dd($request);
        // dd( Mutation::orderBy('id', 'desc')->first());
        $usrid = auth()->user()->id;
        $usrname = auth()->user()->username;
        DB::connection('procurement')->select("call sp_insert_item_receipt(
            $request->purchase_order_id,
            '$request->do_number',
           '$request->shipment',
            '$request->plate_number',
            $usrid,
            '$request->receipt_date',
            $request->status,
            '$usrname'
        )");

        $itemReceipt = ItemReceipt::latest()->first();

        for ($i = 0; $i < count($request->item_id); $i++) {
            // Declare the data from Request
            $amountMutation = $request->qty[$i] + $request->qty_bonus[$i] + $request->qty_discount[$i];
            $datemutation = Carbon::now();
            $item_id = $request->item_id[$i];
            $qty = $request->qty[$i];
            $qty_bonus = $request->qty_bonus[$i];
            $qty_discount = $request->qty_discount[$i];
            $notes = $request->notes[$i];
            $po_item_id = $request->po_item_id[$i];
            $qty_order = $request->qty_order[$i];
            $unit_price = $request->unit_price[$i];
            $balance = $request->balance[$i];
            // End Declare


            DB::connection('procurement')->select("call sp_insert_mutation_receipt(
                        $item_id,
                       '$datemutation',
                       $amountMutation,
                       1,
                       $usrid,
                       $qty,
                       $qty_bonus,
                       $qty_discount,
                       '$notes'
                    )");

            $mutationnya = Mutation::orderBy('id', 'desc')->first();

            DB::connection('procurement')->select("call sp_insert_item_receipt_details(
                        '$itemReceipt->id',
                        $po_item_id,
                        $mutationnya->id,
                        $qty,
                        $balance,
                        '$notes'
                    )");

            $item_receipt_item = ItemReceiptDetail::latest()->first();

            DB::connection('procurement')->select("Call sp_insert_update_items_price(
                        $item_id,
                        $unit_price
                    )");

            DB::connection('procurement')->select("call sp_insert_update_items_receipt(
                        $item_id,
                        $qty,
                        $qty_bonus,
                        $qty_discount

                    )");


            DB::connection('procurement')->select("call sp_insert_item_history(
                        $item_id,
                        $item_receipt_item->id,
                        $unit_price,
                        $qty,
                        $qty_discount,
                        $qty_bonus,
                        1
                    )");
            // 1 diatas berarti status bernilai po
        }
        return response()->json(['success' => 'Item Receiving']);
    }

    public function update(Request $request){
        // dd($request);
        DB::connection('procurement')->select("call sp_update_item_receipt(
            $request->id_po,
            '$request->do_number',
            '$request->plate_number',
            '$request->shipment',
            '$request->receipt_date'
        )");
        return response()->json(['success' => 'Item Receipt Updated']);
    }

    public function destroy(Request $request){
        $detail = ItemReceiptDetail::where(['item_receipt_id' => $request->id])->get();

        foreach($detail as $dt){
            DB::connection('procurement')->select("call sp_delete_item_receipt_qty(
                $dt->id
            )");
        }

        DB::connection('procurement')->select("call sp_delete_item_receipt(
            $request->id
        )");

        return response()->json(['success' => 'Item Receipt Deleted']);
    }
}
