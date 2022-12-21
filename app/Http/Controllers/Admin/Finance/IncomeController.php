<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\Coa;
use App\Models\Partners;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index(){
        return view('admin.finance.income.index');
    }

    public function create(){
        $coa = Coa::all();
        $partner = Partners::all();
        return view('admin.finance.income.create',['coa' => $coa, 'partner' => $partner]);
    }
}
