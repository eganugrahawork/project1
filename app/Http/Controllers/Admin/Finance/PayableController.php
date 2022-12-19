<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PayableController extends Controller {
    public function index() {
        return view('admin.finance.payable.index');
    }
    public function history() {
        return view('admin.finance.payable.history');
    }

    public function create() {
        return view('admin.finance.payable.create');
    }
}
