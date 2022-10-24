<?php

namespace App\Http\Controllers\Admin\Procurement;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\CurrencyHistory;
use App\Models\ItemPrice;
use App\Models\ItemQty;
use App\Models\Items;
use App\Models\Partners;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;
use PDO;

class PurchaseOrderController extends Controller
{
    public function index(){
        // dd(DB::connection('procurement')->select('select * from purchase_orders'));
        return view('admin.procurement.purchaseorder.index');
    }

    public function list(){

        return Datatables::of(DB::connection('procurement')->select('Call sp_list_po()'))->addIndexColumn()
        ->addColumn('action', function($model){
            $action = "";
            if(Gate::allows('edit', ['/admin/procurement/purchase-order'])){
                $action .= "<a onclick='editModal($model->id)' class='btn btn-sm btn-warning'><i class='bi bi-pencil-square'></i></a>";
            }
            if(Gate::allows('delete', ['/admin/procurement/purchase-order'])){
                $action .= " <a href='/admin/procurement/purchase-order/delete/$model->id' class='btn btn-sm btn-danger' id='deletepo'><i class='bi bi-trash'></i></a>";
            }
            return $action;
        })->make(true);
    }

    public function addmodal(){

        $code = 'R'. date('Y') .'0001';

        return view('admin.procurement.purchaseorder.addmodal', ['code' => $code, 'partner'=>Partners::all(), 'currency' => Currency::all()]);
    }
    public function editmodal(Request $request){
        dd($request->id);
        $code = 'R'. date('Y') .'0001';

        return view('admin.procurement.purchaseorder.editmodal', ['code' => $code, 'partner'=>Partners::all(), 'currency' => Currency::all()]);
    }

    public function destroy(Request $request){
        DB::connection('procurement')->select("call sp_delete_po_items($request->id)");
        return response()->json(['success'=> 'Data Deleted']);
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
        $pricing  = " <div class='fv-row mb-7 col-lg-2' id='price_parent'>
        <label class='required fw-bold fs-6 mb-2'>Price</label>
        <input type='number' name='price[]' id='price' onkeyup='hitungByPrice(this)' class='form-control form-control-solid mb-3 mb-lg-0' placeholder='$itemprice->base_price' required/>
        <p id='notifprice'>Tulis Kembali harga untuk konfirmasi</p>
        </div>";
        return response()->json(['base_qty' => $itemqty->base_qty, 'pricing' => $pricing ]);
    }

    public function addnewitemrow(Request $request){
        $html = " <div class='row'> <div class='fv-row mb-7 col-lg-3'>
        <label class='required form-label fw-bold'>Item</label>
        <select class='form-select form-select-solid mb-3 mb-lg-0 select-2' id='item_id' name='item_id[]' onchange='getBaseQty(this)' required>";

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
                        <input type='number' name='qty[]' id='qty' onkeyup='hitungByQty(this)'  class='form-control form-control-solid mb-3 mb-lg-0'  required/>
                        </div>
                        <div class='fv-row mb-7 col-lg-1'>
                            <label class='required fw-bold fs-6 mb-2'>Discount</label>
                            <input type='number' name='discount[]' id='discount'  onkeyup='hitungByDiscount(this)' class='form-control form-control-solid mb-3 mb-lg-0'  required/>
                        </div>
                        <div class='fv-row mb-7 col-lg-2'>
                        <label class='required fw-bold fs-6 mb-2'>Total</label>
                        <input type='number' name='total[]' id='total' readonly class='form-control form-control-solid mb-3 mb-lg-0 totalnya'  required/>
                        <input type='hidden' name='getdiscountperitem[]' id='getdiscountperitem' readonly class='form-control form-control-solid mb-3 mb-lg-0 getdiscountperitem'  required/>
                        </div>
                        <div class='fv-row mb-7 col-lg-1'>
                        <label class='fw-bold fs-6 mb-2'>Remove</label>
                            <button class='btn btn-sm btn-warning' type='button' onclick='removeItemRow(this)'>-</button>
                    </div></div>";

                        return response()->json(['html' => $html]);
    }

    public function store(Request $request){

        $skrg = Carbon::now();
        if(count($request->item_id) > 1){
            for($i =0; $i < count($request->item_id); $i++){
                $item_id = $request->item_id[$i];
                $qty = $request->qty[$i];
                $price = $request->price[$i];
                DB::connection('procurement')->select("call sp_insert_po_items(
                    '$request->code',
                    '$request->order_date',
                    '$request->term_of_payment',
                    '$request->description',
                    '$request->rate',
                    '$request->ppn',
                    '$request->partner_id',
                    1,
                    '$request->currency_id',
                    1,
                    '$item_id',
                    '$qty',
                    '$price',
                    '$skrg',
                    'Ega'
                    )");
                }
        }else{

            $item_id = $request->item_id[0];
            $qty = $request->qty[0];
            $price = $request->price[0];
            DB::connection('procurement')->select("call sp_insert_po_items(
                '$request->code',
                '$request->order_date',
                '$request->term_of_payment',
                '$request->description',
                '$request->rate',
                '$request->ppn',
                '$request->partner_id',
                1,
                '$request->currency_id',
                1,
                '$item_id',
                '$qty',
                '$price',
                '$skrg',
                'Ega'
                )");
            }


        return redirect('/admin/procurement/purchase-order')->with(['success'=> 'Purchase Order Added']);
    }

}
