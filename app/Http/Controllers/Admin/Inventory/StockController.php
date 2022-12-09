<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class StockController extends Controller
{
    public function index(){
        return view('admin.inventory.stock.index');
    }

    public function filter(Request $request){
       $datesFilter = explode(' - ', $request->date_range);
        // dd($datesFilter);

        return response()->json(['data'=> $datesFilter]);
    }

    public function list(){
        return  Datatables::of(DB::connection('inventory')->select('Call sp_stock()'))->addIndexColumn()
        ->addColumn('action', function ($model) {
            $action = "<a onclick='info($model->id)' class='btn btn-icon btn-sm btn-info me-1 btn-hover-rise'><i class='bi bi-info-square'></i></a>";
            if (Gate::allows('edit', ['/admin/inventory/stock'])) {
                $action .= "<a onclick='edit($model->id)' class='btn btn-icon btn-sm btn-warning me-1 btn-hover-rise'><i class='bi bi-pencil-square'></i></a>";
            }
            if (Gate::allows('delete', ['/admin/inventory/stock'])) {
                $action .= " <a href='/admin/inventory/stock/delete/$model->id' class='btn btn-icon btn-sm btn-danger me-1 btn-hover-rise' id='deletestock'><i class='bi bi-trash'></i></a>";
            }
            return $action;
        })->addColumn('belumada', function(){
            return '-';
        })->make(true);
    }
}
