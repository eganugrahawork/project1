<?php

namespace App\Http\Controllers\Admin\Procurement;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrderInvoice;
use App\Models\UserActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceProcurementController extends Controller {
  public function index() {
    return view('admin.procurement.invoice.index');
  }

  public function list() {
    return  Datatables::of(DB::connection('procurement')->select('Call sp_list_invoice()'))->addIndexColumn()
      ->addColumn('action', function ($model) {
        $action = "<a onclick='info($model->id)' class='btn btn-icon btn-sm btn-info me-1 btn-hover-rise'><i class='bi bi-info-square'></i></a>";
        if (Gate::allows('edit', ['/admin/procurement/invoice'])) {
          $action .= "<a onclick='edit($model->id)' class='btn btn-icon btn-sm btn-warning me-1 btn-hover-rise'><i class='bi bi-pencil-square'></i></a>";
        }
        if (Gate::allows('delete', ['/admin/procurement/invoice'])) {
          $action .= " <a href='/admin/procurement/invoice/delete/$model->id' class='btn btn-icon btn-sm btn-danger me-1 btn-hover-rise' id='deleteInvoice'><i class='bi bi-trash'></i></a>";
        }
        $action .= "<a onclick='exportPDF($model->id)' class='btn btn-icon btn-sm btn-outline btn-outline-dashed btn-outline-dark btn-active-light-dark btn-hover-rise me-1'><i class='bi bi-file-earmark-pdf'></i></a>";
        return $action;
      })->addColumn('invoice_date', function ($model) {
        return Carbon::parse($model->invoice_date)->format('d-M-Y');
      })->addColumn('due_date', function ($model) {
        return Carbon::parse($model->due_date)->format('d-M-Y');
      })->addColumn('balance', function ($model) {
        $total_bayar = 0;
        $sisa = $model->price - $total_bayar;
        return $sisa;
      })->make(true);
  }

  public function create() {
    $list = DB::connection('procurement')->select('Call sp_list_item_receipt()');
    return view('admin.procurement.invoice.create', ['list' => $list]);
  }

  public function store(Request $request) {
    // dd($request);
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
      $id_item_receipt_detail = $request->id_item_receipt_detail[$i];
      $getCoa = DB::connection('procurement')->select("Call sp_search_coa_id($id_item_receipt_detail)");
      $po_item_id = $request->po_item_id[$i];
      $qty_receipt = $request->qty[$i];
      $unit_price = $request->unit_price[$i];
      $price = $qty_receipt * $unit_price + (($qty_receipt * $unit_price) * $request->ppn);
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

      $coa_id = $getCoa[0]->coa_id;
      $date = $request->date_invoice;
      $value = $request->total_po;
      $value_real = $price;
      $adjusment = 0;
      $type_cash = 0;
      $notes =  $description;
      $rate =  $request->rate;
      $descriptioncoa = $request->description;
      $invoice_number = $invoiceLast->invoice_number;
      $assets_id = 0;
      DB::connection('procurement')->select("Call sp_insert_coa_value(
                0,
                '$coa_id',
                '$date',
                '$value',
                '$value_real',
                '$adjusment',
                $type_cash,
                '$notes',
                '$rate',
                '$descriptioncoa',
                '$invoice_number',
                '$assets_id'

            )");
    }
    UserActivity::create([
      'id_user' => auth()->user()->id,
      'menu' => "Invoice Procurement",
      'aktivitas' => "Tambah",
      'keterangan' => "Tambah Invoice Procurement ". $request->no_invoice
   ]);
    return response()->json(['success' => 'Invoices Dibuat']);
  }

  public function edit(Request $request) {
    $data = DB::connection('procurement')->select('Call sp_search_id_invoice(' . $request->id . ')');

    return view('admin.procurement.invoice.edit', ['data' => $data]);
  }

  public function update(Request $request) {
    DB::connection('procurement')->select("call sp_update_invoice(
            $request->id_invoice,
            '$request->no_invoice',
            '$request->date_invoice',
            '$request->due_date',
            '$request->description_invoice',
            '$request->sign',
            '$request->tax_invoice'
        )");

        UserActivity::create([
          'id_user' => auth()->user()->id,
          'menu' => "Invoice Procurement",
          'aktivitas' => "Update",
          'keterangan' => "Update Invoice Procurement ". $request->no_invoice
       ]);
    return response()->json(['success' => 'Invoices Diperbarui']);
  }

  public function info(Request $request) {
    $data = DB::connection('procurement')->select('Call sp_search_id_invoice(' . $request->id . ')');

    return view('admin.procurement.invoice.info', ['data' => $data]);
  }

  public function destroy(Request $request) {

    DB::connection('procurement')->select("call sp_delete_invoice(
            $request->id
        )");

        UserActivity::create([
          'id_user' => auth()->user()->id,
          'menu' => "Invoice Procurement",
          'aktivitas' => "Tambah",
          'keterangan' => "Tambah Invoice Procurement ". $request->id
       ]);
    return response()->json(['success' => 'Invoices Updated']);
  }
  public function getdata(Request $request) {
    $data = DB::connection('procurement')->select('Call sp_search_id_item_receipt(' . $request->id . ')');
    $html = '';
    foreach ($data as $item) {
      $html .= "<div class='row'>
            <input type='hidden' name='po_item_id[]' value='$item->po_item_id'/>
            <input type='hidden' name='unit_price[]' value='$item->unit_price'/>
            <input type='hidden' name='id_item_receipt_detail[]' value='$item->id_item_receipt_detail'/>
            <div class='fv-row mb-3 col-lg-2'>
                <label class=' form-label fw-bold'>Item</label>
                <select class='form-select  form-select-white mb-3 mb-lg-0' id='item_id' name='item_id[]'   required>
                        <option value='$item->item_id'>$item->item_name</option>
                </select>
            </div>
            <div class='fv-row mb-3 col-lg-2'>
                <label class=' fw-bold fs-6 mb-2'>Qty Order</label>
                <input type='number' name='qty_order[]' id='qty_order' value='$item->qty' readonly class='form-control form-control-white mb-3 mb-lg-0 '  required/>
            </div>
            <input type='hidden'  id='nowBalance' value='$item->qty_balance' readonly class='form-control form-control-white mb-3 mb-lg-0 '  required/>
            <div class='fv-row mb-3 col-lg-2'>
                <label class=' fw-bold fs-6 mb-2'>Sisa</label>
                <input type='number' name='balance[]' id='balance' value='$item->qty_balances' readonly class='form-control form-control-white mb-3 mb-lg-0 '  required/>
            </div>
            <div class='fv-row mb-3 col-lg-2'>
                <label class='required fw-bold fs-6 mb-2'>Diterima</label>
                <input type='number' name='qty[]' id='qty' onkeyup='balanceEdit(this)' value='$item->qty_receipt' readonly  class='form-control form-control-solid mb-3 mb-lg-0 ' required/>
            </div>
            <div class='fv-row mb-3 col-lg-1'>
                <label class='required fw-bold fs-6 mb-2'>Bonus</label>
                <input type='number' name='qty_bonus[]' id='qty_bonus' value='$item->qty_bonus' readonly  class='form-control form-control-solid mb-3 mb-lg-0 ' required/>
            </div>

            <div class='fv-row mb-3 col-lg-1'>
                <label class='required fw-bold fs-6 mb-2'>Diskon</label>
                <input type='number' name='qty_discount[]' id='qty_discount'  value='$item->qty_discount' readonly class='form-control form-control-solid mb-3 mb-lg-0 ' required/>
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
      'rate' => $data[0]->rate,
      'total_po' => $data[0]->total_po,
      'html' => $html
    ]);
  }

  public function exportpdf(Request $request) {
      $data = DB::connection('procurement')->select('Call sp_search_id_invoice(' . $request->id . ')');
      dd($data);
    $order_date = Carbon::parse($data[0]->order_date)->format('d-M-Y');
    $pdf = Pdf::loadView('admin.procurement.invoice.exportpdf', ['data' => $data, 'order_date' =>$order_date]);
    // dd($data);
    UserActivity::create([
      'id_user' => auth()->user()->id,
      'menu' => "Invoice Procurement",
      'aktivitas' => "Export PDF",
      'keterangan' => "Export PDF Invoice Procurement ". $data[0]->invoice_number
   ]);
    return $pdf->download("Invoice-" . $data[0]->invoice_number . ".pdf");
  }
}
