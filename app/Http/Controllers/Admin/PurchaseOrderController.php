<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\CurrencyHistory;
use App\Models\ItemPrice;
use App\Models\ItemQty;
use App\Models\Items;
use App\Models\Partners;
use Illuminate\Http\Request;
use PDO;

class PurchaseOrderController extends Controller
{
    public function index(){
        return view('admin.purchaseorder.index');
    }

    public function addmodal(){
        $code = 'R'. date('Y') .'0001';

        return view('admin.purchaseorder.addmodal', ['code' => $code, 'partner'=>Partners::all(), 'currency' => Currency::all()]);
    }

    public function getitem(Request $request){
        $partner = Partners::where(['id' => $request->id])->first();

        $items = Items::where(['partner_id' => $request->id])->get();
        $html ='';
        if(count($items) > 0){
            $html ='<option>See Available Item</option>';
            foreach($items as $item){
                $html .= "<option value='$item->id'>$item->item_code - $item->item_name</option>";
            }
        }else{
            $html ='<option>No Items From This Partner</option>';
        }
        return response()->json(['html'=>$html, 'address' => $partner->address, 'phone'=>$partner->phone, 'fax'=>$partner->fax]);
    }

    public function getcurrency(Request $request){
        $currency = CurrencyHistory::where(['currency_id' => $request->id])->first();

        return response()->json(['rate' => $currency->rate]);

    }

    public function getbaseqty(Request $request){
        $itemprice = ItemPrice::where(['item_id' => $request->id, 'status' => 1])->first();
        $itemqty = ItemQty::where(['item_id' => $request->id, 'status' => 1])->first();
        $pricing  = " <div class='fv-row mb-7 col-lg-2'>
        <label class='required fw-bold fs-6 mb-2'>Price</label>
        <input type='number' name='price[]' class='form-control form-control-solid mb-3 mb-lg-0' value='$itemprice->base_price' required/>
    </div>";
        return response()->json(['base_qty' => $itemqty->base_qty, 'pricing' => $pricing ]);
    }

    public function addnewitemrow(Request $request){
        $html = " <div class='row'> <div class='fv-row mb-7 col-lg-5'>
        <label class='required form-label fw-bold'>Item</label>
        <select class='form-select  form-select-solid mb-3 mb-lg-0' id='item_id' name='item_id[]' onchange='getBaseQty(this)' required>";

        $items = Items::where(['partner_id' => $request->id])->get();
        if(count($items) > 0){
            $html .='<option>See Available Item</option>';
            foreach($items as $item){
                $html .= "<option value='$item->id'>$item->item_code - $item->item_name</option>";
            }
        }else{
            $html .='<option>No Items From This Partner</option>';
        }


            $html .=   "</select>
                        </div>

                        <div class='fv-row mb-7 col-lg-1'>
                        <label class='required fw-bold fs-6 mb-2'>Qty</label>
                        <input type='number' name='qty[]' class='form-control form-control-solid mb-3 mb-lg-0'  required/>
                        </div>
                        <div class='fv-row mb-7 col-lg-1'>
                            <label class='required fw-bold fs-6 mb-2'>Diskon</label>
                            <input type='number' name='discount[]' class='form-control form-control-solid mb-3 mb-lg-0'  required/>
                        </div>
                        <div class='fv-row mb-7 col-lg-1'>
                        <label class='required fw-bold fs-6 mb-2'>Total</label>
                        <input type='number' name='total[]' class='form-control form-control-solid mb-3 mb-lg-0'  required/>
                        </div>
                        <div class='fv-row mb-7 col-lg-1'>
                        <label class='fw-bold fs-6 mb-2'>Remove</label>
                            <button class='btn btn-sm btn-warning' type='button' onclick='removeItemRow(this)'>-</button>
                    </div></div>";

                        return response()->json(['html' => $html]);
    }

    public function store(Request $request){
        dd($request);
    }
}
