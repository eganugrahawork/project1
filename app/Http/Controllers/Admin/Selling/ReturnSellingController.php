<?php

namespace App\Http\Controllers\Admin\Selling;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ReturnSellingController extends Controller
{
    public function index() {
        return view('admin.selling.return.index');
    }
}
