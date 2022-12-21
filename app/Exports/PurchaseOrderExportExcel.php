<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class PurchaseOrderExportExcel implements FromView
{
    public function view(): View
    {
        $list = DB::connection('procurement')->select('Call sp_list_po()');
        return view('admin.procurement.purchaseorder.exportexcel', ['list' => $list]);
    }
}
