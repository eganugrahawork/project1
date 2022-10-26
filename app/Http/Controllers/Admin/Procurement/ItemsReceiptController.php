<?php

namespace App\Http\Controllers\Admin\Procurement;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
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
        return view('admin.procurement.itemsreceipt.addmodal', ['purchase_orders' => PurchaseOrder::where(['status' => 1])->get()]);
    }

    public function getdatapo(Request $request){
       $po = PurchaseOrder::where(['id' => $request->id])->first();

        return response()->json([
            'code' => $po->code,
            'order_date' => $po->order_date,
            'partner' => $po->partnernya->name,
            'address' => $po->partnernya->address,
            'phone_number' => $po->partnernya->phone_number,
            'fax' => $po->partnernya->fax,
        ]);
    }

}
