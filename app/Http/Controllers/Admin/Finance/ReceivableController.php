<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\Coa;
use App\Models\Ordering;
use App\Models\Partners;
use Illuminate\Http\Request;

class ReceivableController extends Controller
{
    public function index(){
        return view('admin.finance.receivable.index');
    }

    public function history(){
        return view('admin.finance.receivable.history');
    }

    public function create(){
        $ordering = Ordering::where(['name_menu' => 'pembayaran_piutang'])->first();

        if ($ordering['seq_max'] + 1 < 1000) {
            if ($ordering['seq_max'] + 1 < 100) {
                if ($ordering['seq_max'] + 1 < 10) {
                    $code = $ordering['begin_code']  . date('Y') . '000' . ($ordering['seq_max'] + 1);
                } else {
                    $code = $ordering['begin_code']  . date('Y') . '00' . ($ordering['seq_max'] + 1);
                }
            } else {
                $code = $ordering['begin_code']  . date('Y') . '0' . ($ordering['seq_max'] + 1);
            }
        } else {
            $code = $ordering['begin_code']  . date('Y') . '' . ($ordering['seq_max'] + 1);
        }

        $customer = Partners::select('partners.name', 'partners.id', 'partners.code')->join('partner_types', 'partners.partner_type', '=', 'partner_types.id')
        ->where('partner_types.name', '=', 'Customer')->get();
        $coa = Coa::all();
        return view('admin.finance.receivable.create', ['code' => $code, 'customer' => $customer, 'coa' => $coa]);
    }
}
