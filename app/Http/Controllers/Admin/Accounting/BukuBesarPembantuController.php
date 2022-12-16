<?php

namespace App\Http\Controllers\Admin\Accounting;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BukuBesarPembantuController extends Controller
{
    public function index(){
        return view('admin.accounting.buku_besar_pembantu.index');
    }
}
