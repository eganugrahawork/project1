<?php

namespace App\Http\Controllers\Admin\Procurement;

use App\Events\NotifEvent;
use App\Http\Controllers\Controller;
use App\Models\Retur;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class ReturnProcurementController extends Controller
{
    public function index() {
        return view('admin.procurement.retur.index');
    }

    public function list() {

        return  Datatables::of(DB::connection('procurement')->select('Call sp_list_return()'))->addIndexColumn()
            ->addColumn('action', function ($model) {
                $action = "<a onclick='info($model->id)' class='btn btn-icon btn-sm btn-info me-1 btn-hover-rise'><i class='bi bi-info-square'></i></a>";
                if($model->status !== '0'){

                    if (Gate::allows('edit', ['/admin/procurement/retur'])) {
                        $action .= "<a onclick='edit($model->id)' class='btn btn-icon btn-sm btn-warning me-1 btn-hover-rise'><i class='bi bi-pencil-square'></i></a>";
                    }
                    if (Gate::allows('delete', ['/admin/procurement/retur'])) {
                        $action .= " <a href='/admin/procurement/retur/delete/$model->id_retur' class='btn btn-icon btn-sm btn-danger me-1 btn-hover-rise' id='deleteRetur'><i class='bi bi-trash'></i></a>";
                    }
                }
                return $action;
            })->addColumn('retur_date', function ($model) {
                return Carbon::parse($model->retur_date)->format('d-M-Y');
            })->addColumn('status', function ($model) {

                if ($model->status === 0) {
                    if (Gate::allows('approve', ['/admin/procurement/retur'])) {
                        $status = "<a onclick='approve($model->id)' class='btn btn-sm btn-warning me-1 btn-hover-rise'>Approve Here</i></a>";
                    }else{
                        $status = "<a href='#' class='btn btn-sm btn-warning me-1 btn-hover-rise'>Waiting For Approve</i></a>";
                    }
                } elseif ($model->status === 2) {
                    $status = "<a href='#' class='btn btn-sm btn-danger me-1 btn-hover-rise'>Reject</i></a>";
                }else{
                    $status = "<a href='#' class='btn btn-sm btn-primary me-1 btn-hover-rise'>Approved</i></a>";
                }
                return $status;
            })->rawColumns(['action', 'retur_date', 'status'])->make(true);
    }

    public function create() {
        return view('admin.procurement.retur.create', ['list' => DB::connection('procurement')->select('call sp_list_invoice()')]);
    }

    public function store(Request $request) {
        DB::connection('procurement')->select("call sp_insert_return(
            $request->id_invoice,
            $request->po_id,
            '$request->retur_date',
            '$request->description_retur'
        )");

        $retur = Retur::latest()->first();
        for ($i = 0; $i < count($request->qty_retur); $i++) {
            $qty_retur = $request->qty_retur[$i];
            $item_id = $request->item_id[$i];
            DB::connection('procurement')->select("call sp_insert_return_detail(
                $retur->id,
                $item_id,
                $qty_retur
            )");
        }
        UserActivity::create([
          'id_user' => auth()->user()->id,
          'menu' => "Return PO",
          'aktivitas' => "Tambah",
          'keterangan' => "Tambah Return PO " . $request->id_return
      ]);
        return response()->json(['success' => 'Retur Ditambahkan']);
    }

    public function info(Request $request) {
        $data = DB::connection('procurement')->select("call sp_search_id_return(
            $request->id
        )");
        return view('admin.procurement.retur.info', ['data' => $data]);
    }
    public function approveview(Request $request) {
        $data = DB::connection('procurement')->select("call sp_search_id_return(
            $request->id
        )");
        return view('admin.procurement.retur.approveview', ['data' => $data]);
    }

    public function approve(Request $request){
        $approvedby = auth()->user()->username;
        DB::connection('procurement')->select("call sp_approve_return(
            $request->id,
            1,
            '$approvedby'
        )");
        UserActivity::create([
          'id_user' => auth()->user()->id,
          'menu' => "Return PO",
          'aktivitas' => "Setujui",
          'keterangan' => "Setujui Return PO " . $request->id_return
      ]);
        return response()->json(['success' => 'Data Disetujui']);
    }

    public function edit(Request $request) {
        $data = DB::connection('procurement')->select("call sp_search_id_return(
            $request->id
        )");
        return view('admin.procurement.retur.edit', ['data' => $data]);
    }

    public function update(Request $request) {
        for ($i = 0; $i < count($request->id_item_return); $i++) {
            $qty_return = $request->qty_retur[$i];
            DB::connection('procurement')->select("call sp_update_return(
                $request->id_return,
                '$request->retur_date',
                '$request->description_retur',
                $qty_return
                )");
        }

        UserActivity::create([
          'id_user' => auth()->user()->id,
          'menu' => "Return PO",
          'aktivitas' => "Update",
          'keterangan' => "Update Return PO " . $request->id_return
      ]);
        return response()->json(['success' => 'Retur Diperbarui']);
    }

    public function destroy(Request $request){
        DB::connection('procurement')->select("call sp_delete_return(
            $request->id
        )");

        UserActivity::create([
          'id_user' => auth()->user()->id,
          'menu' => "Return PO",
          'aktivitas' => "Hapus",
          'keterangan' => "Hapus Return PO " . $request->id
      ]);
        return response()->json(['success' => 'Data Dihapus']);
    }

    public function getdata(Request $request) {
        $data = DB::connection('procurement')->select('Call sp_search_id_invoice(' . $request->id . ')');
        $html = '';
        foreach ($data as $item) {
            $html .= "<div class='row'>
            <div class='fv-row mb-3 col-lg-2'>
                <label class=' form-label fw-bold'>Item</label>
                <select class='form-select  form-select-white mb-3 mb-lg-0' id='item_id' name='item_id[]'   required>
                        <option value='$item->item_id'>$item->item_name</option>
                </select>
            </div>
            <div class='fv-row mb-3 col-lg-2'>
                <label class='required fw-bold fs-6 mb-2'>Retur</label>
                <input type='number' name='qty_retur[]' id='qty_retur'  value='0'  class='form-control form-control-solid mb-3 mb-lg-0 ' required/>
            </div>
            <div class='fv-row mb-3 col-lg-2'>
                <label class=' fw-bold fs-6 mb-2'>Qty Diterima</label>
                <input type='number' name='qty_receipt[]' id='qty_receipt' value='$item->qty_receipt' readonly class='form-control form-control-white mb-3 mb-lg-0 '  required/>
            </div>

            <div class='fv-row mb-3 col-lg-2'>
                <label class='required fw-bold fs-6 mb-2'>Harga Unit</label>
                <input type='number' name='unit_price[]' id='unit_price' value='$item->unit_price' readonly  class='form-control form-control-solid mb-3 mb-lg-0 ' required/>
            </div>

            <div class='fv-row mb-3 col-lg-1'>
                <label class='required fw-bold fs-6 mb-2'>Diskon</label>
                <input type='number' name='discount[]' id='discount'  value='$item->discount' readonly class='form-control form-control-solid mb-3 mb-lg-0 ' required/>
            </div>
            <div class='fv-row mb-3 col-lg-2'>
                <label class='required fw-bold fs-6 mb-2'>Total</label>
                <input type='text' name='total[]' id='total' readonly  class='form-control form-control-solid mb-3 mb-lg-0 descriptionnya'  value='$item->price'/>
            </div>
        </div>";
        }
        return response()->json([

            'order_date' => $data[0]->order_date,
            'partner' => $data[0]->name,
            'address' => $data[0]->address,
            'phone' => $data[0]->phone,
            'fax' => $data[0]->fax,
            'shipment' => $data[0]->shipment,
            'vat' => $data[0]->ppn,
            'term_of_payment' => $data[0]->term_of_payment,
            'description' => $data[0]->description,
            'po_id' => $data[0]->po_id,
            'html' => $html
        ]);
    }
}
