<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;

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
        return view('admin.finance.receivable.create');
    }
}
