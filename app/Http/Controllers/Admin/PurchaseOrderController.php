<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index(){
        return view('admin.purchaseorder.index');
    }

    public function addmodal(){

    }
}
