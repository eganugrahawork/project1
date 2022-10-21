<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Items;
use App\Models\Partners;
use Illuminate\Http\Request;

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
        $items = Items::where(['partner_id' => $request->id])->get();
        $html ='';
        if(count($items) > 0){

            foreach($items as $item){
                $html .= "<option value='$item->id'>$item->item_code - $item->item_name</option>";
            }
        }else{
            $html ='<option>Tidak Ada Item</option>';
        }
        return response()->json(['html'=>$html]);
    }
    public function addnewitemrow(Request $request){

    }
}
