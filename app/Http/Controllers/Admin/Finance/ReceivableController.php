<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ReceivableController extends Controller
{
    public function index(){
        return view('admin.finance.receivable.index');
    }
}
