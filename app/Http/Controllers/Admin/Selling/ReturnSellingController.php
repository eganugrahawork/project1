<?php

namespace App\Http\Controllers\Admin\Selling;

use App\Http\Controllers\Controller;
use App\Models\ReturnSelling;
use App\Models\ReturnSellingDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnSellingController extends Controller {
    public function index() {
        return view('admin.selling.return.index');
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
            'status'=> 1,
            'approved_by' => auth()->user()->username
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
