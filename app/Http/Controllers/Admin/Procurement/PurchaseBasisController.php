<?php

namespace App\Http\Controllers\Admin\Procurement;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PurchaseBasisController extends Controller
{
    public function index(){
        return view('admin.procurement.purchasebasis.index');
    }
}
