<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\Coa;
use App\Models\Partners;
use Illuminate\Http\Request;

class IncomeController extends Controller {
    public function index() {
        return view('admin.finance.income.index');
    }

    public function create() {
        $coa = Coa::all();
        $partner = Partners::all();
        return view('admin.finance.income.create', ['coa' => $coa, 'partner' => $partner]);
    }

    public function addnewitemrow() {
        $partner = Partners::all();
        $html = '<tr>
        <td><select name="cash_credit" id="cash_credit" class="form-select form-select-transparent select-2">
            <option selected disabled>Pilih</option>
        </select></td>
        <td>
            <input type="number" name="amount" class="form-control form-control-transparent">
        </td>
        <td>
            <input name="description" class="form-control form-control-transparent" type="text"/>
        </td>
        <td>
            <select name="partner_id" id="partner_id" class="form-select form-select-transparent select-2">
                <option selected disable>Pilih Partner Disini</option>';

        foreach ($partner as $p) {
            $html .= "<option value='$p->id'>$p->name</option>";
        }

        $html .= '  </select>
        </td>
        <td><button class="btn btn-icon btn-sm btn-danger" onclick="removeRow(this)">-</button></td>
    </tr>';

        return response()->json(['html' => $html]);
    }
}
