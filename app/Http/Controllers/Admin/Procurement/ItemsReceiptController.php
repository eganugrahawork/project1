<?php

namespace App\Http\Controllers\Admin\Procurement;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ItemsReceiptController extends Controller
{
    public function __construct()
    {

    }
    public function index(){
        return view('admin.procurement.itemsreceipt.index');
    }

    public function addmodal(){
        return view('admin.procurement.itemsreceipt.addmodal');
    }

}
