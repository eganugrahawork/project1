<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\Coa;
use App\Models\Partners;
use Illuminate\Http\Request;

class SpendingController extends Controller
{
    public function index(){
        return view('admin.finance.spending.index');
    }
    public function create(){
        $coa = Coa::all();
        $partner = Partners::all();
        return view('admin.finance.spending.create', ['coa' => $coa, 'partner' =>$partner]);
    }
}
