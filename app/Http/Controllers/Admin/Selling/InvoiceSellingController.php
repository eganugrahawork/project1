<?php

namespace App\Http\Controllers\Admin\Selling;

use App\Http\Controllers\Controller;
use App\Models\InvoiceSelling;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class InvoiceSellingController extends Controller {

    public function index() {
        return view('admin.selling.invoice.index');
    }

    public function list(Request $request) {
        return Datatables::of(DB::connection('selling')->select('Call sp_list_selling_invoice()'))->addIndexColumn()
            ->addColumn('action', function ($model) {
                // $action = "";
                $action = "<a onclick='info($model->id_invoice)' class='btn btn-icon btn-sm btn-info btn-hover-rise me-1'><i class='bi bi-info-square'></i></a>";
                    if (Gate::allows('edit', ['/admin/selling/invoice'])) {
                        $action .= "<a onclick='edit($model->id_invoice)' class='btn btn-icon btn-sm btn-warning btn-hover-rise me-1'><i class='bi bi-pencil-square'></i></a>";
                    }
                    if (Gate::allows('delete', ['/admin/selling/invoice'])) {
                        $action .= " <a href='/admin/selling/invoice/delete/$model->id_invoice' class='btn btn-icon btn-sm btn-danger btn-hover-rise me-1' id='deleteInvoice'><i class='bi bi-trash'></i></a>";
                    }

                return $action;
            })->addColumn('status', function ($model) {
                $status = "";

                if ($model->status == 0 || $model->status === null) {
                        $status .= "<a class='btn btn-sm btn-secondary btn-hover-rise me-1 '><i class='bi bi-question-octagon'></i> Belum Lunas</a>";
                } else {
                    $status .= "<a class='btn btn-sm btn-primary btn-hover-rise me-1'><i class='bi bi-patch-check'></i> Lunas</a>";
                }
                return $status;
            })->addColumn('date_invoice', function ($model) {
                return Carbon::parse($model->date_invoice)->format('d-M-Y');
            })->addColumn('due_date', function ($model) {
                return Carbon::parse($model->due_date)->format('d-M-Y');
            })->rawColumns(['action', 'status', 'date_invoice', 'due_date'])->make(true);
    }

    public function create() {
        $list_penjualan = DB::connection('selling')->select('Call sp_list_selling()');
        return view('admin.selling.invoice.create', ['list_penjualan' => $list_penjualan]);
    }

    public function edit(Request $request) {
        $data = DB::connection('selling')->select("call sp_search_id_invoice($request->id)");
        return view('admin.selling.invoice.edit', ['data' => $data ]);
    }

    public function update(Request $request){

        for($i= 0; $i < count($request->selling_invoice_detail_id); $i++){
            $unit_price = $request->price[$i];
            $total_qty = $request->total_qty[$i];
            $qty_box = $request->qty_box[$i];
            $qty_satuan = $request->qty[$i];
            $qty_per_box = $request->qty_per_box[$i];
            $total_box = $qty_box + ($total_qty / $qty_per_box);
            $total_price = $request->total_price[$i];
            $notes = $request->notes[$i];
            $item_id = $request->item_id[$i];
            $discount = '0';

            DB::connection('selling')->select("call sp_update_selling_invoice(
                '$request->invoice_id',
                '$request->invoice_number',
                '$request->invoice_date',
                '$request->due_date',
                '$request->att',
                '$request->sign',
                '$request->tax_invoice',
                '$unit_price',
                '$total_qty',
                '$qty_box',
                '$qty_satuan',
                '$total_box',
                '$total_price',
                '$discount',
                '$notes',
                '$item_id',
                '$request->invoice_date',
                '$total_price'
            )");
        }

        return response()->json(['success' => 'Data Berhasil Diperbarui']);
    }

    public function destroy(Request $request){
        DB::connection('selling')->select("call sp_delete_selling_invoice($request->id)");

        return response()->json(['success' => 'Data Berhasil Dihapus']);
    }

    public function getdataselling(Request $request) {
        $data = DB::connection('selling')->select("call sp_search_id($request->id)");
        $html = '';
        foreach ($data as $d) {
            $html .= "<div class='row'>
        <div class='fv-row mb-3 col-lg-3'>
        <input type='hidden' name='selling_detail_id[]' value='$d->selling_detail_id' />
            <label class=' form-label fs-6 fw-bold'>Item</label>
            <select class='form-select  form-select-solid mb-3 mb-lg-0 select-2' readonly onchange='getDetailItem(this)' id='item_id' name='item_id[]'
                required>
                <option value='$d->item_id'>$d->item_code - $d->item_name</option></select>
        </div>
        <div class='fv-row mb-3 col-lg-1'>
            <label class=' fw-bold fs-6 mb-2'>Q Box</label>
            <input type='number' name='qty_box[]' id='qty_box' onkeyup='countTotalQty(this)'
                class='form-control form-control-solid mb-3 mb-lg-0 '  value='$d->qty_box'   required />
                <p class='fs-9 fw-bolder' id='detail_box'></p>
                <input type='hidden' name='qty_per_box[]' value='$d->qty_per_box' id='qty_per_box'>
                <input type='hidden' name='stock[]' value='$d->stock' id='stock'>
                <input type='hidden' name='vat_item[]' value='$d->vat' id='vat_item'>
        </div>
        <div class='fv-row mb-3 col-lg-1'>
            <label class=' fw-bold fs-6 mb-2'>Qty</label>
            <input type='number' name='qty[]' id='qty'
                class='form-control form-control-solid mb-3 mb-lg-0'  value='$d->qty_satuan' onkeyup='countTotalQty(this)'   required />
        </div>
        <div class='fv-row mb-3 col-lg-1'>
            <label class='required fw-bold fs-6 mb-2'>Total Q</label>
            <input type='number' name='total_qty[]' id='total_qty' readonly
                class='form-control form-control-solid mb-3 mb-lg-0 '  value='$d->qty' required />
        </div>
        <div class='fv-row mb-3 col-lg-1'>
            <label class=' fw-bold fs-6 mb-2'>Harga</label>
            <input type='number' name='price[]' id='price'
                class='form-control form-control-solid mb-3 mb-lg-0'  value='$d->unit_price' onkeyup='countTotalQty(this)' required />
        </div>
        <div class='fv-row mb-3 col-lg-2'>
            <label class=' fw-bold fs-6 mb-2'>Total</label>
            <input type='number' name='total_price[]' id='total_price'
                class='form-control form-control-solid mb-3 mb-lg-0 total_price' value='$d->price' readonly required />
        </div>
        <div class='fv-row mb-3 col-lg-2'>
            <label class=' fw-bold fs-6 mb-2'>Note</label>
            <input type='text' name='notes[]' id='notes'
                class='form-control form-control-solid mb-3 mb-lg-0 notes'  required />
        </div>

    </div>";
        }

        $term_of_payment =  "<option value='".$data[0]->term_of_payment."'>".$data[0]->term_of_payment."</option>";

        return response()->json([
            'sales_date' => $data[0]->date_selling,
            'address' => $data[0]->address,
            'att' => '-',
            'phone' => $data[0]->phone,
            'email' => $data[0]->email,
            'html' => $html,
            'tof' => $term_of_payment
        ]);
    }

    public function store(Request $request) {
        DB::connection('selling')->select("call sp_insert_selling_invoice(
          '$request->selling_id',
          '$request->invoice_number',
          '$request->invoice_date',
          '$request->due_date',
          '$request->att',
          '$request->description_invoice',
          '$request->sign',
          '$request->tax_invoice',
          '0'
        )");
        $invoice = InvoiceSelling::latest()->first();

        for ($i = 0; $i < count($request->selling_detail_id); $i++) {
            $item_id = $request->item_id[$i];
            $unit_price = $request->price[$i];
            $qty = $request->qty[$i];
            $qty_box = $request->qty_box[$i];
            $qty_per_box = $request->qty_per_box[$i];
            $price = $request->total_price[$i];
            $total_qty = $request->total_qty[$i];
            $total_box = $qty_box + ($total_qty / $qty_per_box);
            $discount = '0';
            $notes = $request->notes[$i];
            $sellingdetail_id = $request->selling_detail_id[$i];
            DB::connection('selling')->select("call sp_insert_selling_invoice_details(
                  '$invoice->id',
                  '$sellingdetail_id',
                  '$unit_price',
                  '$total_qty',
                  '$qty_box',
                  $qty,
                  '$total_box',
                  '$price',
                  '0',
                  '$notes'
                )");
        }

        return response()->json([
            'success' => 'Data Ditambahkan'
        ]);
    }
}
