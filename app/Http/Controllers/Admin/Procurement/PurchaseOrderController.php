<?php

namespace App\Http\Controllers\Admin\Procurement;

use App\Events\NotifEvent;
use App\Exports\PurchaseOrderExportExcel;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\CurrencyHistory;
use App\Models\ItemPrice;
use App\Models\ItemQty;
use App\Models\Items;
use App\Models\Ordering;
use App\Models\Partners;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItems;
use App\Models\UserActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use PDO;

class PurchaseOrderController extends Controller {
    public function index() {
        $year_count = date('Y') - 2019;
        $years = ['All'];

        for ($i = $year_count; $i >= 0; $i--) {

            $y = 2019 + $i;

            array_push($years, $y);
        }
        $month =  array('All', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        return view('admin.procurement.purchaseorder.index', ['month' => $month, 'years' => $years]);
    }

    public function list() {
        return Datatables::of(DB::connection('procurement')->select('Call sp_list_po()'))->addIndexColumn()
            ->addColumn('action', function ($model) {
                // $action = "";
                $action = "<a onclick='info($model->id_ponya)' class='btn btn-icon btn-sm btn-info btn-hover-rise me-1'><i class='bi bi-info-square'></i></a>";

                if ($model->po_status == 0) {
                    if (Gate::allows('edit', ['/admin/procurement/purchase-order'])) {
                        $action .= "<a onclick='edit($model->id_ponya)' class='btn btn-icon btn-sm btn-warning btn-hover-rise me-1'><i class='bi bi-pencil-square'></i></a>";
                    }
                    if (Gate::allows('delete', ['/admin/procurement/purchase-order'])) {
                        $action .= " <a href='/admin/procurement/purchase-order/delete/$model->id_ponya' class='btn btn-icon btn-sm btn-danger btn-hover-rise me-1' id='deletepo'><i class='bi bi-trash'></i></a>";
                    }
                } else {
                    $action .= "<a onclick='exportPDF($model->id_ponya)' class='btn btn-icon btn-sm btn-outline btn-outline-dashed btn-outline-dark btn-active-light-dark btn-hover-rise me-1'><i class='bi bi-file-earmark-pdf'></i></a>";
                }
                return $action;
            })->addColumn('statues', function ($model) {
                $statues = "";

                if ($model->po_status == 0) {

                    if (Gate::allows('approve', ['/admin/procurement/purchase-order'])) {
                        $statues .= "<a onclick='approve($model->id_ponya)' class='btn btn-sm btn-warning btn-hover-rise me-1'><i class='bi bi-patch-exclamation'></i></i> Konfirmasi</a>";
                    } else {
                        $statues .= "<a class='btn btn-sm btn-secondary btn-hover-rise me-1 '><i class='bi bi-question-octagon'></i>Pending</a>";
                    }
                } elseif ($model->po_status == 2) {
                    $statues .= "<a class='btn btn-sm btn-danger btn-hover-rise me-1'><i class='bi bi-x-octagon'></i></i> Ditolak</a>";
                } else {
                    $statues .= "<a class='btn btn-sm btn-primary btn-hover-rise me-1'><i class='bi bi-patch-check'></i> Disetujui</a>";
                }
                return $statues;
            })->addColumn('tgl_order', function ($model) {
                return Carbon::parse($model->order_date)->format('d-M-Y');
            })->rawColumns(['action', 'statues', 'tgl_order'])->make(true);
    }

    public function create() {

        $ordering = Ordering::where(['name_menu' => 'purchase_order'])->first();
        if ($ordering['seq_max'] + 1 < 1000) {
            if ($ordering['seq_max'] + 1 < 100) {
                if ($ordering['seq_max'] + 1 < 10) {
                    $code = $ordering['begin_code'] . date('Y') . '000' . ($ordering['seq_max'] + 1) . $ordering['end_code'];
                } else {
                    $code = $ordering['begin_code'] . date('Y') . '00' . ($ordering['seq_max'] + 1) . $ordering['end_code'];
                }
            } else {
                $code = $ordering['begin_code'] . date('Y') . '0' . ($ordering['seq_max'] + 1) . $ordering['end_code'];
            }
        } else {
            $code = $ordering['begin_code'] . date('Y') . '' . ($ordering['seq_max'] + 1) . $ordering['end_code'];
        }

        return view('admin.procurement.purchaseorder.create', ['code' => $code, 'partner' => Partners::all(), 'currency' => Currency::all()]);
    }

    public function edit(Request $request) {

        $ponya = DB::connection('procurement')->select("call sp_search_id($request->id)");
        return view('admin.procurement.purchaseorder.edit', ['partner' => Partners::all(), 'currency' => Currency::all(), 'ponya' => $ponya, 'items' => Items::all()]);
    }

    public function info(Request $request) {
        $info = DB::connection('procurement')->select("call sp_search_id($request->id)");

        return view('admin.procurement.purchaseorder.info', ['info' => $info]);
    }

    public function approveview(Request $request) {
        $info = DB::connection('procurement')->select("call sp_search_id($request->id)");

        return view('admin.procurement.purchaseorder.approveview', ['info' => $info, 'id_po' => $request->id]);
    }

    public function approve(Request $request) {
        $user_approving = auth()->user()->username;
        $info = DB::connection('procurement')->select("call sp_search_id($request->id)");

        DB::connection('procurement')->select("call sp_approve_po($request->id, '$user_approving', 1)");
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "PO",
            'aktivitas' => "Setujui",
            'keterangan' => "Setujui PO " . $info[0]->number_po
        ]);
        NotifEvent::dispatch(auth()->user()->name . ' Menyetujui PO ' . $info[0]->number_po);
        return response()->json(['success' => 'Data Menyetujui']);
    }

    public function reject(Request $request) {
        $user_approving = auth()->user()->username;
        $info = DB::connection('procurement')->select("call sp_search_id($request->id)");

        DB::connection('procurement')->select("call sp_approve_po($request->id, '$user_approving', 2)");
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "PO",
            'aktivitas' => "Tolak",
            'keterangan' => "Tolak PO " . $info[0]->number_po
        ]);
        NotifEvent::dispatch(auth()->user()->name . ' Menolak PO ' . $info[0]->number_po);
        return response()->json(['success' => 'Data Menolak']);
    }

    public function destroy(Request $request) {
        $info = DB::connection('procurement')->select("call sp_search_id($request->id)");
        DB::connection('procurement')->select("call sp_delete_po_items($request->id)");

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "PO",
            'aktivitas' => "Hapus",
            'keterangan' => "Hapus PO " . $info[0]->number_po
        ]);
        NotifEvent::dispatch(auth()->user()->name . ' Hapus PO ' . $info[0]->number_po);
        return response()->json(['success' => 'Data DiHapus']);
    }

    public function getitem(Request $request) {
        $partner = Partners::where(['id' => $request->id])->first();
        $items = Items::where(['partner_id' => $request->id])->get();
        $html = '';
        if (count($items) > 0) {
            $html = '<option>See Available Item</option>';
            foreach ($items as $item) {
                $html .= "<option value='$item->id'>$item->item_code - $item->item_name</option>";
            }
        } else {
            $html = '<option>No Items From This Partner</option>';
        }
        return response()->json(['html' => $html, 'address' => $partner->address, 'phone' => $partner->phone, 'fax' => $partner->fax]);
    }

    public function getallitem() {
        $items = Items::all();

        $html = '<option>List Item</option>';

        foreach ($items as $item) {
            $html .= "<option value='$item->id'>$item->item_code - $item->item_name</option>";
        }

        return response()->json(['html' => $html]);
    }

    public function getcurrency(Request $request) {
        $currency = CurrencyHistory::where(['currency_id' => $request->id])->first();

        return response()->json(['rate' => $currency->rate]);
    }

    public function getbaseqty(Request $request) {
        $itemprice = ItemPrice::where(['item_id' => $request->id])->first();
        $itemqty = ItemQty::where(['item_id' => $request->id])->first();
        $pricing  = " <div class='fv-row mb-3 col-lg-2' id='price_parent'>
        <label class='required fw-bold fs-6 mb-2'>Harga</label>
        <input type='number' name='price[]' id='price' onkeyup='hitungByPrice(this)' class='form-control form-control-solid mb-3 mb-lg-0' placeholder='$itemprice->base_price' required/>
        <p id='notifprice'>Tulis Kembali harga untuk konfirmasi</p>
        </div>";
        return response()->json(['base_qty' => $itemqty->base_qty, 'pricing' => $pricing]);
    }

    public function addnewitemrow(Request $request) {
        $html = " <div class='row'> <div class='fv-row mb-3 col-lg-4'>
        <label class='required form-label fw-bold fs-6 mb-2'>Item </label>
                <div class='row'>
                    <div class='col-lg-10'>
        <select class='form-select form-select-solid mb-3 mb-lg-0 select-2' id='item_id' name='item_id[]' onchange='getBaseQty(this)' required>";

        $items = Items::where(['partner_id' => $request->id])->get();
        if (count($items) > 0) {
            $html .= '<option>Lihat Item</option>';
            foreach ($items as $item) {
                $html .= "<option value='$item->id'>$item->item_code - $item->item_name</option>";
            }
        } else {
            $html .= '<option>Tidak ada item dari Partner ini</option>';
        }


        $html .=   "</select>
                    </div>
                            <div class='col-lg-2'>
                                <button onclick='getallitem(this)' type='button' class='btn btn-sm btn-primary'>All</button>
                            </div>
                        </div>
                        </div>

                        <div class='fv-row mb-3 col-lg-1'>
                        <label class='required fw-bold fs-6 mb-2'>Qty</label>
                        <input type='number' name='qty[]' id='qty' onkeyup='hitungByQty(this)' value='0' class='form-control form-control-solid mb-3 mb-lg-0'  required/>
                        </div>
                        <div class='fv-row mb-3 col-lg-1' id='discount_parent'>
                            <label class='required fw-bold fs-6 mb-2'>Diskon</label>
                            <input type='number' name='discount[]' id='discount'  onkeyup='hitungByDiscount(this)' value='0' class='form-control form-control-solid mb-3 mb-lg-0'  required/>
                        </div>
                        <div class='fv-row mb-3 col-lg-2'>
                        <label class='required fw-bold fs-6 mb-2'>Total</label>
                        <input type='number' name='total[]' id='total' readonly class='form-control form-control-solid mb-3 mb-lg-0 totalnya'  required/>
                        <input type='hidden' name='getdiscountperitem[]' id='getdiscountperitem' readonly class='form-control form-control-solid mb-3 mb-lg-0 getdiscountperitem'  required/>
                        </div>
                        <div class='fv-row mb-3 col-lg-1'>
                        <label class='fw-bold fs-6 mb-2'>Hapus</label>
                            <button class='btn btn-sm btn-warning' type='button' onclick='removeItemRow(this)'>-</button>
                    </div></div>";

        return response()->json(['html' => $html]);
    }

    public function store(Request $request) {
        // dd($request);
        DB::connection('procurement')->select("call sp_insert_po(
            '$request->code',
            '$request->order_date',
            '$request->term_of_payment',
            '$request->description',
            $request->grandtotal,
            '$request->rate',
            '$request->ppn',
            '$request->partner_id',
            '$request->currency_id'
            )");

        $polast = PurchaseOrder::latest()->first();
        $creating = auth()->user()->username;
        if (count($request->item_id) > 1) {
            for ($i = 0; $i < count($request->item_id); $i++) {
                $item_id = $request->item_id[$i];
                $qty = $request->qty[$i];
                $price = $request->price[$i];
                $total_discount = $request->getdiscountperitem[$i];
                $discount = $request->discount[$i];
                $total = $request->total[$i];

                DB::connection('procurement')->select("call sp_insert_po_items(
                        $polast->id,
                        $item_id,
                        '$qty',
                        '$price',
                        '$discount',
                        '$total_discount',
                        '$total',
                        '$creating'
                    )");
            }
        } else {
            $item_id = $request->item_id[0];
            $qty = $request->qty[0];
            $price = $request->price[0];
            $discount = $request->discount[0];
            $total_discount = $request->getdiscountperitem[0];
            $total = $request->total[0];

            DB::connection('procurement')->select("call sp_insert_po_items(
                $polast->id,
                $item_id,
                '$qty',
                '$price',
                '$discount',
                '$total_discount',
                '$total',
                '$creating'
            )");
        }

        $seq_max_before = Ordering::where(['name_menu' => 'purchase_order'])->first();
        $seq_max_after = $seq_max_before['seq_max'] + 1;
        Ordering::where(['name_menu' => 'purchase_order'])->update(['seq_max' => $seq_max_after]);

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "PO",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah PO " . $request->code
        ]);
        NotifEvent::dispatch(auth()->user()->name . ' Tambah PO ' . $request->code);

        return response()->json(['success', 'Purchase Order Ditambahkan']);
    }

    // public function update(Request $request) {

    //     if ($request->idonpoitems) {
    //         PurchaseOrderItems::where(['purchase_order_id' => $request->id_po])->whereNotIn('id', $request->idonpoitems)->delete();

    //         PurchaseOrder::where(['id' => $request->id_po])->update(['order_date' => $request->order_date, 'ppn' => $request->ppn, 'currency_id' => $request->currency_id, 'rate' => $request->rate, 'term_of_payment' => $request->term_of_payment, 'description' => $request->description, 'total_po' => $request->grandtotal]);
    //         for ($i = 0; $i < count($request->idonpoitems); $i++) {
    //             PurchaseOrderItems::where(['id' => $request->idonpoitems[$i]])->update([
    //                 'item_id' => $request->item_id[$i],
    //                 'unit_price' => $request->price[$i],
    //                 'qty' => $request->qty[$i],
    //                 'discount' => $request->discount[$i],
    //                 'total_discount' => $request->getdiscountperitem[$i],
    //                 'total_price' => $request->total[$i]
    //             ]);
    //         }

    //         if (count($request->item_id) > count($request->idonpoitems)) {
    //             // dd($request->id_po);
    //             for ($i = count($request->idonpoitems); $i < count($request->item_id); $i++) {
    //                 PurchaseOrderItems::create([
    //                     'purchase_order_id' => $request->id_po,
    //                     'item_id' => $request->item_id[$i],
    //                     'unit_price' => $request->price[$i],
    //                     'qty' => $request->qty[$i],
    //                     'discount' => $request->discount[$i],
    //                     'total_discount' => $request->getdiscountperitem[$i],
    //                     'total_price' => $request->total[$i]
    //                 ]);
    //             }
    //         }
    //     } else {

    //         if ($request->item_id) {
    //             PurchaseOrder::where(['id' => $request->id_po])->update(['order_date' => $request->order_date, 'ppn' => $request->ppn, 'currency_id' => $request->currency_id, 'rate' => $request->rate, 'term_of_payment' => $request->term_of_payment, 'description' => $request->description, 'total_po' => $request->grandtotal]);
    //             PurchaseOrderItems::where(['purchase_order_id' => $request->id_po])->delete();

    //             for ($i = 0; $i < count($request->item_id); $i++) {

    //                 PurchaseOrderItems::create([
    //                     'purchase_order_id' => $request->id_po,
    //                     'item_id' => $request->item_id[$i],
    //                     'unit_price' => $request->price[$i],
    //                     'qty' => $request->qty[$i],
    //                     'discount' => $request->discount[$i],
    //                     'total_discount' => $request->getdiscountperitem[$i],
    //                     'total_price' => $request->total[$i]
    //                 ]);
    //             }
    //         } else {
    //             return response()->json(['fail' => 'Purchase Order Fail to Edit, The Items Cannot Null']);
    //         }
    //     }
    //     UserActivity::create([
    //         'id_user' => auth()->user()->id,
    //         'menu' => "PO",
    //         'aktivitas' => "Update",
    //         'keterangan' => "Update PO " . $request->code
    //     ]);
    //     NotifEvent::dispatch(auth()->user()->name . ' Update PO ' . $request->code);

    //     return response()->json(['success' =>'Purchase Order Updateed']);
    // }

    public function update(Request $request) {
        // dd($request);
        $approved_by = auth()->user()->username;
        for ($i = 0; $i < count($request->item_id); $i++) {
            $item_id = $request->item_id[$i];
            $qty = $request->qty[$i];
            $price = $request->price[$i];
            $discount = $request->discount[$i];
            $total = $request->total[$i];
            $idonpoitems = $request->idonpoitems[$i];


            DB::connection('procurement')->select("call sp_update_po_item(
                $idonpoitems,
            '$request->order_date',
            '$request->term_of_payment',
            '$request->description',
            $request->grandtotal,
            $request->rate,
           $request->ppn,
           $item_id ,
           $qty,
            $price,
            $discount,
            $total,
            '$approved_by'
        )");
        }
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "PO",
            'aktivitas' => "Update",
            'keterangan' => "Update PO " . $request->code
        ]);
        NotifEvent::dispatch(auth()->user()->name . ' Update PO ' . $request->code);

        return response()->json(['success' => 'Purchase Order Diperbarui']);
    }

    public function exportpdf(Request $request) {

        $po = DB::connection('procurement')->select("call sp_search_id($request->id)");
        // dd($po);
        $datenow = Carbon::now()->format('d-m-Y');


        $taxable = 0;
        $totaldiscount = 0;
        $subtotal = 0;
        $totalppn = 0;
        $grandtotal = 0;
        foreach ($po as $item) {
            $taxable += $item->total_price;
            $totaldiscount += $item->total_discount;
        }

        $subtotal = $taxable + $totaldiscount;
        $totalppn = $po[0]->ppn * $taxable / 100;
        $grandtotal = $taxable + $totalppn;

        $pdf = Pdf::loadView('admin.procurement.purchaseorder.exportpdf', ['po' => $po, 'now' => $datenow, 'subtotal' => $subtotal, 'taxable' => $taxable, 'totalppn' => $totalppn, 'totaldiscount' => $totaldiscount, 'grandtotal' => $grandtotal]);
        // INI DOUBLE GATAU KENAPA NOTIFNYA SAMA INSERTNYA
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "PO",
            'aktivitas' => "Export",
            'keterangan' => "Export Detail PO " . $po[0]->number_po
        ]);
        NotifEvent::dispatch(auth()->user()->name . ' Export PO ' . $po[0]->number_po);
        // SAMAPI SINI

        return $pdf->download("PO-" . $po[0]->number_po . ".pdf");
    }

    public function exportexcel(){
        return Excel::download(new PurchaseOrderExportExcel, 'purchase-order.xlsx');
    }
}
