<?php

namespace App\Http\Controllers\Admin\Selling;

use App\Http\Controllers\Controller;
use App\Models\ReturnSelling;
use App\Models\ReturnSellingDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class ReturnSellingController extends Controller {
    public function index() {
        return view('admin.selling.return.index');
    }

    public function list(Request $request){
        return Datatables::of(DB::connection('selling')->select('SELECT a.id AS id_return, b.no_selling, b.date_selling, c.name, a.approved_by AS pengaju, a.retur_date, a.status  FROM selling_returns AS a JOIN selling AS b ON a.selling_id = b.id
        JOIN loccana_masterdata.partners AS c ON b.partner_id = c.id'))->addIndexColumn()
            ->addColumn('action', function ($model) {
                // $action = "";
                $action = "<a onclick='info($model->id_return)' class='btn btn-icon btn-sm btn-info btn-hover-rise me-1'><i class='bi bi-info-square'></i></a>";

                if ($model->status == 0) {
                    if (Gate::allows('edit', ['/admin/selling/return'])) {
                        $action .= "<a onclick='edit($model->id_return)' class='btn btn-icon btn-sm btn-warning btn-hover-rise me-1'><i class='bi bi-pencil-square'></i></a>";
                    }
                    if (Gate::allows('delete', ['/admin/selling/return'])) {
                        $action .= " <a href='/admin/selling/return/delete/$model->id_return' class='btn btn-icon btn-sm btn-danger btn-hover-rise me-1' id='deleteReturn'><i class='bi bi-trash'></i></a>";
                    }
                } else {
                    $action .= "<a onclick='exportPDF($model->id_return)' class='btn btn-icon btn-sm btn-outline btn-outline-dashed btn-outline-dark btn-active-light-dark btn-hover-rise me-1'><i class='bi bi-file-earmark-pdf'></i></a>";
                }
                return $action;
            })->addColumn('date_selling', function($model){
                return Carbon::parse($model->date_selling)->format('Y-M-d');
            })->addColumn('retur_date', function($model){
                return Carbon::parse($model->retur_date)->format('Y-M-d');
            })->addColumn('due_date', function($model){
                return '-';
            })->addColumn('status', function ($model) {
                $status = "";

                if ($model->status == 0) {

                    if (Gate::allows('approve', ['/admin/selling/return'])) {
                        $status .= "<a onclick='approve($model->id_return)' class='btn btn-sm btn-warning btn-hover-rise me-1'><i class='bi bi-patch-exclamation'></i></i> Konfirmasi</a>";
                    } else {
                        $status .= "<a class='btn btn-sm btn-secondary btn-hover-rise me-1 '><i class='bi bi-question-octagon'></i>Pending</a>";
                    }
                } elseif ($model->status == 2) {
                    $status .= "<a class='btn btn-sm btn-danger btn-hover-rise me-1'><i class='bi bi-x-octagon'></i></i> Ditolak</a>";
                } else {
                    $status .= "<a class='btn btn-sm btn-primary btn-hover-rise me-1'><i class='bi bi-patch-check'></i> Disetujui</a>";
                }
                return $status;
            })->rawColumns(['date_selling', 'retur_date','due_date','status','action'])->make(true);
    }

    public function create() {

        $selling = DB::connection('selling')->select('call sp_list_selling()');

        return view('admin.selling.return.create', ['selling' => $selling]);
    }

    public function store(Request $request){
       $returnId = ReturnSelling::create([
            'selling_invoice_id'=>$request->invoice_id,
            'selling_id'=>$request->sales_id,
            'retur_date'=>$request->return_date,
            'notes'=>$request->return_description,
            'status'=> 0,
            'approved_by' => 0
        ])->id;

        for($i = 0; $i < count($request->item_id); $i++){
            ReturnSellingDetail::create([
                'selling_return_id' => $returnId,
                'selling_detail_id' => $request->selling_detail_id[$i],
                'qty_return' => $request->total_return_qty[$i]
            ]);
        }


        return response()->json(['success' => 'Data Retur Ditambahkan']);
    }

    public function edit(Request $request) {

        $data = DB::connection('selling')->select("SELECT a.id AS id_return, b.`no_selling`,  b.`date_selling` AS sales_date, c.`name`, c.`address`,c.`phone`, c.`email`, a.`retur_date`, a.`notes`,
        b.`description` AS keterangan_beli, b.`term_of_payment`, f.`item_code`, f.`item_name`, d.`qty_return` AS qty_return, g.`unit_box`, e.`qty` AS qty_order, e.`id` AS selling_detail_id, f.`id` AS item_id, e.`unit_price`, d.`id` AS selling_return_detail_id
       FROM selling_returns AS a JOIN selling AS b ON a.selling_id = b.id
               JOIN loccana_masterdata.partners AS c ON b.partner_id = c.id
                       JOIN selling_return_details AS d ON a.id = d.`selling_return_id`
                       JOIN selling_details AS e ON d.`selling_detail_id` = e.`id`
                       JOIN loccana_masterdata.`items` AS f ON e.`item_id` = f.`id`
                       JOIN loccana_masterdata.`item_qty` AS g ON f.`id` = g.`item_id`
                       WHERE a.id = $request->id");

        return view('admin.selling.return.edit', ['data' => $data]);
    }

    public function update(Request $request){
        ReturnSelling::where(['id' => $request->return_id])->update([
            'retur_date'=>$request->return_date,
            'notes'=>$request->return_description,
            'status'=> 0,
            'approved_by' => 0
        ]);

        for($i = 0; $i < count($request->item_id); $i++){
            ReturnSellingDetail::where(['id' => $request->selling_return_detail_id[$i]])->update([
                'qty_return' => $request->total_return_qty[$i]
            ]);
        }

        return response()->json(['success' => 'Data Diperbarui']);
    }

    public function info(Request $request) {

        $data = DB::connection('selling')->select("SELECT a.id AS id_return, b.`no_selling`,  b.`date_selling` AS sales_date, c.`name`, c.`address`,c.`phone`, c.`email`, a.`retur_date`, a.`notes`,
        b.`description` AS keterangan_beli, b.`term_of_payment`, f.`item_code`, f.`item_name`, d.`qty_return` AS qty_return, g.`unit_box`, e.`qty` AS qty_order, e.`id` AS selling_detail_id, f.`id` AS item_id, e.`unit_price`, d.`id` AS selling_return_detail_id
       FROM selling_returns AS a JOIN selling AS b ON a.selling_id = b.id
               JOIN loccana_masterdata.partners AS c ON b.partner_id = c.id
                       JOIN selling_return_details AS d ON a.id = d.`selling_return_id`
                       JOIN selling_details AS e ON d.`selling_detail_id` = e.`id`
                       JOIN loccana_masterdata.`items` AS f ON e.`item_id` = f.`id`
                       JOIN loccana_masterdata.`item_qty` AS g ON f.`id` = g.`item_id`
                       WHERE a.id = $request->id");

        return view('admin.selling.return.info', ['data' => $data]);
    }
    public function approveview(Request $request) {

        $data = DB::connection('selling')->select("SELECT a.id AS id_return, b.`no_selling`,  b.`date_selling` AS sales_date, c.`name`, c.`address`,c.`phone`, c.`email`, a.`retur_date`, a.`notes`,
        b.`description` AS keterangan_beli, b.`term_of_payment`, f.`item_code`, f.`item_name`, d.`qty_return` AS qty_return, g.`unit_box`, e.`qty` AS qty_order, e.`id` AS selling_detail_id, f.`id` AS item_id, e.`unit_price`, d.`id` AS selling_return_detail_id
       FROM selling_returns AS a JOIN selling AS b ON a.selling_id = b.id
               JOIN loccana_masterdata.partners AS c ON b.partner_id = c.id
                       JOIN selling_return_details AS d ON a.id = d.`selling_return_id`
                       JOIN selling_details AS e ON d.`selling_detail_id` = e.`id`
                       JOIN loccana_masterdata.`items` AS f ON e.`item_id` = f.`id`
                       JOIN loccana_masterdata.`item_qty` AS g ON f.`id` = g.`item_id`
                       WHERE a.id = $request->id");

        return view('admin.selling.return.approveview', ['data' => $data]);
    }

    public function approve(Request $request){
        dd($request);
    }

    public function destroy(Request $request){
        $query = "DELETE a,b FROM selling_returns AS a JOIN selling_return_details AS b ON a.id = b.selling_return_id";

        DB::connection('selling')->delete($query);

        return response()->json(['success' => 'Data Berhasil Dihapus']);
    }

    public function getdata(Request $request) {
        $data = DB::connection('selling')->select("call sp_search_id(
            $request->id
        )");
        $sales_date = Carbon::parse($data[0]->date_selling)->format('d-M-Y');
        $item = '';
        foreach ($data as $d) {
            $item .= "<div class='row'>
        <div class='fv-row mb-3 col-lg-3'>
            <label class='form-label fs-8 fw-bold'>Item</label>
            <input type='hidden' name='selling_detail_id[]' value='$d->selling_detail_id' />
            <input type='hidden' name='item_id[]' value='$d->item_id' />
            <input type='text'  class='form-control form-control-solid mb-3 mb-lg-0' value='$d->item_name' readonly/>
        </div>
        <div class='fv-row mb-3 col-lg-1'>
            <label class='required fw-bold fs-8 mb-2'>R Box</label>
            <input type='number' name='return_box[]' id='return_box'
                class='form-control form-control-solid mb-3 mb-lg-0' value='0' onkeyup='countTotalQty(this)' required />
            <p class='fs-9 fw-bolder' id='detail_box'>@$d->qty_per_box/box</p>
            <input type='hidden' id='qty_per_box' value='$d->qty_per_box' />
        </div>
        <div class='fv-row mb-3 col-lg-1'>
            <label class='required fw-bold fs-8 mb-2'>R Satuan</label>
            <input type='number' name='return_qty[]' id='return_qty'
                class='form-control form-control-solid mb-3 mb-lg-0' value='0' onkeyup='countTotalQty(this)'
                required />
        </div>
        <div class='fv-row mb-3 col-lg-1'>
            <label class=' fw-bold fs-8 mb-2'>Qty Return</label>
            <input type='number' name='total_return_qty[]' id='total_return_qty' readonly
                class='form-control form-control-solid mb-3 mb-lg-0' value='0' required />
        </div>
        <div class='fv-row mb-3 col-lg-1'>
            <label class=' fw-bold fs-8 mb-2'>Qty Order</label>
            <input type='number' name='qty_order[]' value='$d->qty' id='qty_order'
                class='form-control form-control-solid mb-3 mb-lg-0'
                readonly required />
        </div>
        <div class='fv-row mb-3 col-lg-2'>
            <label class=' fw-bold fs-8 mb-2'>Harga</label>
            <input type='number' name='price[]' value='$d->unit_price' id='price'
                class='form-control form-control-solid mb-3 mb-lg-0' readonly required />
        </div>
        <div class='fv-row mb-3 col-lg-2'>
            <label class=' fw-bold fs-8 mb-2'>Total</label>
            <input type='number' name='total_price_return[]' id='total_price_return'
                class='form-control form-control-solid mb-3 mb-lg-0' value='0' readonly required />

        </div>
    </div>";
        }
        return response()->json(
            [
                'sales_date' => $sales_date,
                'address' => $data[0]->address,
                'att' => '-',
                'phone' => $data[0]->phone,
                'email' => $data[0]->email,
                'fax' => $data[0]->fax,
                'invoice_id' => $data[0]->invoice_id,
                'ship_address' => $data[0]->ship_address,
                'term_of_payment' => $data[0]->term_of_payment,
                'description' => $data[0]->description,
                'credit_limit' => '-',
                'credit_balance' => '-',
                'item' => $item
            ]
        );
    }
}
