<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SpendingController extends Controller
{
    public function index(){
        return view('admin.finance.spending.index');
    }
}
