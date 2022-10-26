<?php

namespace App\Http\Controllers\Admin\Procurement;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItems;
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
        $itemnya = PurchaseOrderItems::where(['purchase_order_id'=> $request->id])->get();

        $html = '';
        foreach($itemnya as $item){
            $html .= "<div class='row'>
            <div class='fv-row mb-7 col-lg-3'>
                <label class=' form-label fw-bold'>Item</label>
                <select class='form-select  form-select-solid mb-3 mb-lg-0' id='item_id' name='item_id[]'  value='$item->item_id' required>
                        <option>$item->item_id</option>
                </select>
            </div>
            <div class='fv-row mb-7 col-lg-2'>
                <label class=' fw-bold fs-6 mb-2'>Order Qty</label>
                <input type='number' name='qty_order[]' id='qty_order' value='$item->qty' readonly class='form-control form-control-solid mb-3 mb-lg-0 '  required/>
            </div>
            <div class='fv-row mb-7 col-lg-2'>
                <label class=' fw-bold fs-6 mb-2'>Balance</label>
                <input type='number' name='balance[]' id='balance' value='$item->qty' readonly class='form-control form-control-solid mb-3 mb-lg-0 '  required/>
            </div>
            <div class='fv-row mb-7 col-lg-2'>
                <label class='required fw-bold fs-6 mb-2'>Receive</label>
                <input type='number' name='qty[]' id='qty' value='0' class='form-control form-control-solid mb-3 mb-lg-0 ' required/>
            </div>
            <div class='fv-row mb-7 col-lg-1'>
                <label class='required fw-bold fs-6 mb-2'>Bonus</label>
                <input type='number' name='qty_bonus[]' id='qty_bonus' value='0' class='form-control form-control-solid mb-3 mb-lg-0 ' required/>
            </div>
            <div class='fv-row mb-7 col-lg-2'>
                <label class='required fw-bold fs-6 mb-2'>Note</label>
                <input type='text' name='description[]' id='description' class='form-control form-control-solid mb-3 mb-lg-0 descriptionnya'  required/>
            </div>
        </div>";
        }
        return response()->json([
            'code' => $po->code,
            'order_date' => $po->order_date,
            'partner' => $po->partnernya->name,
            'address' => $po->partnernya->address,
            'phone' => $po->partnernya->phone,
            'fax' => $po->partnernya->fax,
            'html' => $html
        ]);
    }

    public function store(Request $request){
        dd($request);
    }

}
