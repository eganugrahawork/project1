<?php

namespace App\Http\Controllers\Admin\Procurement;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrderInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller {
    public function index() {
        return view('admin.procurement.invoice.index');
    }

    public function create() {
        $list = DB::connection('procurement')->select('Call sp_list_item_receipt()');
        return view('admin.procurement.invoice.create', ['list' => $list]);
    }

    public function store(Request $request) {
        DB::connection('procurement')->select("Call sp_insert_invoice(
            '$request->no_invoice',
            $request->purchase_order_id,
            '$request->date_invoice',
            '$request->due_date',
            '$request->att',
            '$request->sign',
            '$request->description_invoice',
            '$request->tax_invoice',
            '0'
        )");
        $invoiceLast = PurchaseOrderInvoice::latest()->first();

        for ($i = 0; $i < count($request->po_item_id); $i++) {
            $po_item_id = $request->po_item_id[$i];
            $qty_receipt = $request->qty[$i];
            $unit_price = $request->unit_price[$i];
            $price = $qty_receipt * $unit_price + (($qty_receipt * $unit_price)*$request->ppn);
            $description = $request->notes[$i];
            DB::connection('procurement')->select("Call sp_insert_invoice_detail(
                $po_item_id,
                $invoiceLast->id,
                $request->id_receipt,
                $qty_receipt,
                $unit_price,
                $price,
                '$description'
            )");
        }

        DB::connection('procurement')->select("Call sp_insert_coa_value(

        )");
        return response()->json(['success' => 'Invoices Created']);
    }


    public function getdata(Request $request) {
        $data = DB::connection('procurement')->select('Call sp_search_id_item_receipt(' . $request->id . ')');
        $html = '';
        foreach ($data as $item) {
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
                <input type='number' name='balance[]' id='balance' value='$item->qty_balances' readonly class='form-control form-control-white mb-3 mb-lg-0 '  required/>
            </div>
            <div class='fv-row mb-3 col-lg-2'>
                <label class='required fw-bold fs-6 mb-2'>Receipt</label>
                <input type='number' name='qty[]' id='qty' onkeyup='balanceEdit(this)' value='$item->qty_receipt' readonly  class='form-control form-control-solid mb-3 mb-lg-0 ' required/>
            </div>
            <div class='fv-row mb-3 col-lg-1'>
                <label class='required fw-bold fs-6 mb-2'>Bonus</label>
                <input type='number' name='qty_bonus[]' id='qty_bonus' value='$item->qty_bonus' readonly  class='form-control form-control-solid mb-3 mb-lg-0 ' required/>
            </div>

            <div class='fv-row mb-3 col-lg-1'>
                <label class='required fw-bold fs-6 mb-2'>Discount</label>
                <input type='number' name='qty_discount[]' id='qty_discount'  value='$item->qty_bonus' readonly class='form-control form-control-solid mb-3 mb-lg-0 ' required/>
            </div>
            <div class='fv-row mb-3 col-lg-2'>
                <label class='required fw-bold fs-6 mb-2'>Note</label>
                <input type='text' name='notes[]' id='notes' readonly  class='form-control form-control-solid mb-3 mb-lg-0 descriptionnya'  value='$item->deskripsi_items'/>
            </div>
        </div>";
        }
        return response()->json([
            'code' => $data[0]->number_po,
            'order_date' => $data[0]->order_date,
            'partner' => $data[0]->partner_name,
            'address' => $data[0]->address,
            'phone' => $data[0]->phone,
            'fax' => $data[0]->fax,
            'shipment' => $data[0]->shipment,
            'vat' => $data[0]->ppn,
            'term_of_payment' => $data[0]->term_of_payment,
            'description' => $data[0]->description,
            'id_receipt' => $data[0]->id_receipt,
            'html' => $html
        ]);
    }
}
