<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index(){
        return view('admin.finance.income.index');
    }

    public function create(){
        return view('admin.finance.income.create');
    }
}
