<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReturnSellingController extends Controller
{
    public function index() {
        return view('admin.selling.return.index');
    }
}
