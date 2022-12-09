<?php

namespace App\Http\Controllers\Admin\Procurement;

use App\Events\NotifEvent;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class ReportProcurementController extends Controller
{
    public function index() {
        $partner = DB::connection('masterdata')->select('call sp_list_partners()');
        return view('admin.procurement.report.index',['partner' => $partner]);
    }

    public function list(Request $request) {
        $date = explode(' - ',$request->date_range);
        $start_date = $date[0];
        $end_date = $date[1];
        if($request->partner_id === '0'){
            return  Datatables::of(DB::connection('procurement')->select("Call sp_report_po('$start_date', '$end_date')"))->addIndexColumn()->addColumn('date_po', function ($model) {
                return Carbon::parse($model->date_po)->format('d-M-Y');
            })->addColumn('due_date', function ($model) {
                return Carbon::parse($model->due_date)->format('d-M-Y');
            })
            ->make(true);
        }else{
            return  Datatables::of(DB::connection('procurement')->select("Call sp_report_po_partners('$start_date', '$end_date','$request->partner_id')"))->addIndexColumn()
            ->addColumn('date_po', function ($model) {
                return Carbon::parse($model->date_po)->format('d-M-Y');
            })->addColumn('due_date', function ($model) {
                return Carbon::parse($model->due_date)->format('d-M-Y');
            })
            ->make(true);
        }
    }
}
