<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\Coa;
use App\Models\Ordering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayableController extends Controller {
    public function index() {
        return view('admin.finance.payable.index');
    }

    public function history() {
        return view('admin.finance.payable.history');
    }

    public function create() {
        $ordering = Ordering::where(['name_menu' => 'pembayaran_hutang'])->first();

        if ($ordering['seq_max'] + 1 < 1000) {
            if ($ordering['seq_max'] + 1 < 100) {
                if ($ordering['seq_max'] + 1 < 10) {
                    $code = $ordering['begin_code'] . date('Y') . '000' . ($ordering['seq_max'] + 1);
                } else {
                    $code = $ordering['begin_code']  . date('Y') . '00' . ($ordering['seq_max'] + 1);
                }
            } else {
                $code = $ordering['begin_code']  . date('Y') . '0' . ($ordering['seq_max'] + 1);
            }
        } else {
            $code = $ordering['begin_code']  . date('Y') . '' . ($ordering['seq_max'] + 1);
        }
        $partner = DB::connection('masterdata')->select('call sp_list_partners()');
        $coa = Coa::all();

        return view('admin.finance.payable.create', ['partner' => $partner, 'code' => $code, 'coa' => $coa]);
    }

    public function getdata(Request $request) {
        // $html = '<tr><td><select name="invoice_id" id="invoice_id" class="form-select form-select-solid select-2">';


    }
}
