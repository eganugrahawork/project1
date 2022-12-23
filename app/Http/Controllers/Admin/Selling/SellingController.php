<?php

namespace App\Http\Controllers\Admin\Selling;

use App\Http\Controllers\Controller;
use App\Models\InvoiceSelling;
use App\Models\ItemQty;
use App\Models\Items;
use App\Models\Mutation;
use App\Models\Ordering;
use App\Models\Partners;
use App\Models\Selling;
use App\Models\SellingDetail;
use App\Models\UserActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class SellingController extends Controller {
    public function index() {
        $year_count = date('Y') - 2019;
        $years = ['All'];

        for ($i = $year_count; $i >= 0; $i--) {

            $y = 2019 + $i;

            array_push($years, $y);
        }
        $month =  array('All', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        return view('admin.selling.selling.index', ['month' => $month, 'years' => $years]);
    }

    public function list(Request $request) {
        return Datatables::of(DB::connection('selling')->select('Call sp_list_selling()'))->addIndexColumn()
            ->addColumn('action', function ($model) {
                // $action = "";
                $action = "<a onclick='info($model->id_penjualan)' class='btn btn-icon btn-sm btn-info btn-hover-rise me-1'><i class='bi bi-info-square'></i></a>";

                if ($model->status == 0) {
                    if (Gate::allows('edit', ['/admin/selling/selling'])) {
                        $action .= "<a onclick='edit($model->id_penjualan)' class='btn btn-icon btn-sm btn-warning btn-hover-rise me-1'><i class='bi bi-pencil-square'></i></a>";
                    }
                    if (Gate::allows('delete', ['/admin/selling/selling'])) {
                        $action .= " <a href='/admin/selling/selling/delete/$model->id_penjualan' class='btn btn-icon btn-sm btn-danger btn-hover-rise me-1' id='deleteselling'><i class='bi bi-trash'></i></a>";
                    }
                } else {
                    $action .= "<a onclick='exportPDF($model->id_penjualan)' class='btn btn-icon btn-sm btn-outline btn-outline-dashed btn-outline-dark btn-active-light-dark btn-hover-rise me-1'><i class='bi bi-file-earmark-pdf'></i></a>";
                }
                return $action;
            })->addColumn('status', function ($model) {
                $status = "";

                if ($model->status == 0 || $model->status === null) {

                    if (Gate::allows('approve', ['/admin/selling/selling'])) {
                        $status .= "<a onclick='approve($model->id_penjualan)' class='btn btn-sm btn-warning btn-hover-rise me-1'><i class='bi bi-patch-exclamation'></i></i> Konfirmasi</a>";
                    } else {
                        $status .= "<a class='btn btn-sm btn-secondary btn-hover-rise me-1 '><i class='bi bi-question-octagon'></i>Pending</a>";
                    }
                } elseif ($model->status == 2) {
                    $status .= "<a class='btn btn-sm btn-danger btn-hover-rise me-1'><i class='bi bi-x-octagon'></i></i> Ditolak</a>";
                } else {
                    $status .= "<a class='btn btn-sm btn-primary btn-hover-rise me-1'><i class='bi bi-patch-check'></i> Disetujui</a>";
                }
                return $status;
            })->addColumn('tgl_jual', function ($model) {
                return Carbon::parse($model->date_selling)->format('d-M-Y');
            })->addColumn('delivery_date', function ($model) {
                return Carbon::parse($model->delivery_date)->format('d-M-Y');
            })->rawColumns(['action', 'status', 'tgl_jual', 'delivery_date'])->make(true);
    }

    public function create() {
        $ordering = Ordering::where('name_menu', 'selling')->first();
        if ($ordering->seq_max + 1 < 1000) {
            if ($ordering->seq_max + 1 < 100) {
                if ($ordering->seq_max + 1 < 10) {
                    $code = $ordering->begin_code . date('Y') . '000' . ($ordering->seq_max + 1) . $ordering->end_code;
                } else {
                    $code = $ordering->begin_code . date('Y') . '00' . ($ordering->seq_max + 1) . $ordering->end_code;
                }
            } else {
                $code = $ordering->begin_code . date('Y') . '0' . ($ordering->seq_max + 1) . $ordering->end_code;
            }
        } else {
            $code = $ordering->begin_code . date('Y') . '' . ($ordering->seq_max + 1) . $ordering->end_code;
        }

        $customer = Partners::select('partners.name', 'partners.id', 'partners.code')->join('partner_types', 'partners.partner_type', '=', 'partner_types.id')
            ->where('partner_types.name', '=', 'Customer')->get();
        $item = Items::all();

        return view('admin.selling.selling.create', ['code' => $code, 'customer' => $customer, 'item' => $item]);
    }

    public function store(Request $request) {
        $sales_id = auth()->user()->id;
        $sign = auth()->user()->username;
        if ($request->att !== null) {
            $att = $request->att;
        } else {
            $att = '-';
        }
        $due_date =  date('Y-m-d', strtotime($request->sales_date . ' + ' . $request->term_of_payment . ' days'));

        DB::connection('selling')->select("call sp_insert_selling(
      '$sales_id',
      '$request->sales_number',
      '$request->sales_date',
      '$request->delivery_date',
      '$request->partner_id',
      '$request->term_of_payment',
      '$request->total',
      '1',
      '1',
      '1',
      '1',
      '11',
      '0'
    )");

        $selling = Selling::latest()->first();



        //     DB::connection('selling')->select("call sp_insert_selling_invoice(
        //   '$selling->id',
        //   '$request->sales_number',
        //   '$request->sales_date',
        //   '$due_date',
        //   '$att',
        //   '$request->description',
        //   '$sign',
        //   'Blm tau darimana',
        //   '1'
        // )");

        // $invoice = InvoiceSelling::latest()->first();

        if (count($request->item_id) > 1) {
            for ($i = 0; $i < count($request->item_id); $i++) {
                $item_id = $request->item_id[$i];
                $unit_price = $request->price[$i];
                $qty = $request->qty[$i];
                $qty_box = $request->qty_box[$i];
                $qty_per_box = $request->qty_per_box[$i];
                $price = $request->total_price[$i];
                $total_qty = $request->total_qty[$i];
                $total_box = $qty_box + ($total_qty / $qty_per_box);
                $discount = '0';
                $notes = '0';



                DB::connection('selling')->select("call sp_insert_mutation(
          '$item_id',
          '$request->sales_date',
          '$price',
          '3',
          '$sales_id',
          '0',
          '0',
          '0',
          'penjualan'
        )");

                $mutation = Mutation::latest()->first();

                DB::connection('selling')->select("call sp_insert_selling_details(
          '$selling->id',
          '$item_id',
          '$unit_price',
          '$total_qty',
          '$qty_box',
          $qty,
          '$total_box',
          '$price',
          '0',
          'penjualan',
          '$mutation->id'
        )");

                $sellingdetail = SellingDetail::latest()->first();

                //         DB::connection('selling')->select("call sp_insert_selling_invoice_details(
                //   '$invoice->id',
                //   '$sellingdetail->id',
                //   '$unit_price',
                //   '$total_qty',
                //   '$qty_box',
                //   $qty,
                //   '$total_box',
                //   '$price',
                //   '0',
                //   'penjualan'
                // )");

        //         DB::connection('selling')->select("call sp_insert_selling_history(
        //   '$selling->id',
        //   '$sales_id',
        //   '$item_id',
        //   '$unit_price',
        //   '$total_qty',
        //   '$qty_box',
        //   $qty,
        //   '$total_box',
        //   '$price',
        //   'penjualan',
        //   '$mutation->id'
        // )");

                DB::connection('selling')->select("call sp_update_items_qty(
          '$sellingdetail->id'
        )");
            }
        } else {
            $item_id = $request->item_id[0];
            $unit_price = $request->price[0];
            $qty = $request->qty[0];
            $qty_box = $request->qty_box[0];
            $qty_per_box = $request->qty_per_box[0];
            $price = $request->total_price[0];
            $total_qty = $request->total_qty[0];
            $total_box = $qty_box + ($total_qty / $qty_per_box);
            $discount = '0';
            $notes = '0';



            DB::connection('selling')->select("call sp_insert_mutation(
          '$item_id',
          '$request->sales_date',
          '$price',
          '3',
          '$sales_id',
          '0',
          '0',
          '0',
          'penjualan'
        )");

            $mutation = Mutation::latest()->first();

            DB::connection('selling')->select("call sp_insert_selling_details(
          '$selling->id',
          '$item_id',
          '$unit_price',
          '$total_qty',
          '$qty_box',
          '$qty',
          '$total_box',
          '$price',
          '0',
          'penjualan',
          '$mutation->id'
        )");

            $sellingdetail = SellingDetail::latest()->first();

            //     DB::connection('selling')->select("call sp_insert_selling_invoice_details(
            //   '$invoice->id',
            //   '$sellingdetail->id',
            //   '$unit_price',
            //   '$total_qty',
            //   '$qty_box',
            //   $qty,
            //   '$total_box',
            //   '$price',
            //   '0',
            //   'penjualan'
            // )");

            DB::connection('selling')->select("call sp_insert_selling_history(
          '$selling->id',
          '$sales_id',
          '$item_id',
          '$unit_price',
          '$total_qty',
          '$qty_box',
          $qty,
          '$total_box',
          '$price',
          'penjualan',
          '$mutation->id'
        )");

        //     DB::connection('selling')->select("call sp_update_items_qty(
        //   '$sellingdetail->id'
        // )");
        }

        $ordering = Ordering::where('name_menu', 'selling')->first();
        $newOrdering = $ordering->seq_max + 1;
        Ordering::where(['name_menu' => 'selling'])->update(['seq_max' => $newOrdering]);
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Penjualan",
            'aktivitas' => "Tambah Penjualan",
            'keterangan' => "Tambah Penjualan " . $request->sales_number
        ]);
        return response()->json(['success', 'Penjualan Ditambahkan']);
    }


    public function edit(Request $request) {
        $data = DB::connection('selling')->select("call sp_search_id($request->id)");
        $customer = Partners::select('partners.name', 'partners.id', 'partners.code')->join('partner_types', 'partners.partner_type', '=', 'partner_types.id')
            ->where('partner_types.name', '=', 'Customer')->get();
        $item = Items::all();
        return view('admin.selling.selling.edit', ['data' => $data, 'customer' => $customer, 'item' => $item]);
    }

    public function update(Request $request){
        for($i =0; $i < count($request->item_id); $i++){
            $item_id = $request->item_id[$i];
            $unit_price = $request->price[$i];
            $total_qty = $request->total_qty[$i];
            $qty_box = $request->qty_box[$i];
            $qty = $request->qty[$i];
            $qty_per_box = $request->qty_per_box[0];
            $total_box = $qty_box + ($total_qty / $qty_per_box);
            $discount = '0';
            $notes = '0';
            $price = $request->total_price[$i];
            DB::connection('selling')->select("call sp_update_selling(
                $request->selling_id,
                '$request->sales_date',
                '$request->term_of_payment',
                '$request->delivery_date',
                '$request->total',
                '$unit_price',
                '$item_id',
                '$total_qty',
                '$qty_box',
                '$qty',
                '$total_box',
                '$price',
                '$discount',
                '$notes',
                '$request->sales_date',
                '$price'
            )");
        }
        return response()->json(['success', 'Penjualan Diperbarui']);
    }

    public function info(Request $request) {
        $data = DB::connection('selling')->select("call sp_search_id($request->id)");
        // dd($data);
        $item = Items::all();
        return view('admin.selling.selling.info', ['data' => $data, 'item' => $item]);
    }

    public function approveview(Request $request) {
        $data = DB::connection('selling')->select("call sp_search_id($request->id)");


        $item = Items::all();
        return view('admin.selling.selling.approveview', ['data' => $data, 'item' => $item]);
    }

    public function approve(Request $request) {
        $approveBy = auth()->user()->username;
        DB::connection('selling')->select("call sp_approve_selling(
            '$request->id',
            '$approveBy',
            1
        )");

        return response()->json(['success' => 'Berhasil disetujui']);
    }


    public function destroy(Request $request) {
        DB::connection('selling')->select("call sp_delete_selling($request->id)");


        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Penjualan",
            'aktivitas' => "Hapus Penjualan",
            'keterangan' => "Hapus Penjualan " . $request->id
        ]);
        return response()->json(['success', 'Data Dihapus']);
    }

    public function getdatacustomer(Request $request) {
        $customer = Partners::where('id', $request->id)->first();

        return response()->json([
            'address' => $customer->address,
            'att' => $customer->att,
            'phone' => $customer->phone,
            'email' => $customer->email,
            'credit_limit' => 0,
            'credit_balance' => 0
        ]);
    }

    public function addnewitemrow() {
        $item = Items::all();

        $html = "<div class='row'>
    <div class='fv-row mb-3 col-lg-3'>
        <label class=' form-label fs-6 fw-bold'>Item</label>
        <select class='form-select  form-select-solid mb-3 mb-lg-0 select-2' onchange='getDetailItem(this)' id='item_id' name='item_id[]'
            required>
            <option>Choose Item</option>";

        foreach ($item as $itm) {
            $html .= "<option value='$itm->id'>$itm->item_code-$itm->item_name</option>";
        }
        $html .=  " </select>
    </div>
    <div class='fv-row mb-3 col-lg-1'>
        <label class=' fw-bold fs-6 mb-2'>Q Box</label>
        <input type='number' name='qty_box[]' id='qty_box' onkeyup='countTotalQty(this)'
            class='form-control form-control-solid mb-3 mb-lg-0 '  value='0' required />
            <p class='fs-9 fw-bolder' id='detail_box'></p>
            <input type='hidden' name='qty_per_box[]' id='qty_per_box'>
            <input type='hidden' name='stock[]' id='stock'>
            <input type='hidden' name='vat_item[]' id='vat_item'>
    </div>
    <div class='fv-row mb-3 col-lg-1'>
        <label class=' fw-bold fs-6 mb-2'>Qty</label>
        <input type='number' name='qty[]' id='qty'
            class='form-control form-control-solid mb-3 mb-lg-0'  value='0' onkeyup='countTotalQty(this)'  required />
    </div>
    <div class='fv-row mb-3 col-lg-2'>
        <label class='required fw-bold fs-6 mb-2'>Total Qty</label>
        <input type='number' name='total_qty[]' id='total_qty' readonly
            class='form-control form-control-solid mb-3 mb-lg-0 '  value='0' required />
    </div>
    <div class='fv-row mb-3 col-lg-2'>
        <label class=' fw-bold fs-6 mb-2'>Harga</label>
        <input type='number' name='price[]' id='price'
            class='form-control form-control-solid mb-3 mb-lg-0'  value='0' onkeyup='countTotalQty(this)' required />
    </div>
    <div class='fv-row mb-3 col-lg-2'>
        <label class=' fw-bold fs-6 mb-2'>Total</label>
        <input type='number' name='total_price[]' id='total_price'
            class='form-control form-control-solid mb-3 mb-lg-0 total_price' value='0' readonly required />
    </div>
    <div class='fv-row mb-3 col-lg-1  '>
        <button class='btn btn-danger btn-sm btn-icon mt-4' type='button'
            onclick='removeItemRow(this)'>-</button>
    </div>
</div>";


        return response()->json(['html' => $html]);
    }

    public function getdetailitem(Request $request) {
        $item = ItemQty::where('item_id', $request->id)->first();
        $itemnya = Items::where(['id' => $request->id])->first();
        $desc = '1 Box : ' . number_format($item->unit_box, 0, ',', '.') . ' Pcs Stock : ' . number_format($item->base_qty, 0, ',', '.') . ' Box';

        return response()->json([
            'desc' => $desc, 'qty_per_box' => $item->unit_box,
            'stock' => $item->base_qty,
            'vat_item' => $itemnya->vat
        ]);
    }
}
