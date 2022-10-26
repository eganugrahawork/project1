<?php

namespace App\Http\Controllers\Admin\Procurement;

use App\Events\NotifEvent;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\CurrencyHistory;
use App\Models\ItemPrice;
use App\Models\ItemQty;
use App\Models\Items;
use App\Models\Partners;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItems;
use App\Models\UserActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;
use PDO;

class PurchaseOrderController extends Controller
{
    public function index(){

        return view('admin.procurement.purchaseorder.index');
    }

    public function list(){
        // dd(DB::connection('procurement')->select('Call sp_list_po()'));
        return Datatables::of(DB::connection('procurement')->select('Call sp_list_po()'))->addIndexColumn()
        ->addColumn('action', function($model){
            $action = "";
            $action = "<a onclick='infoModal($model->id_ponya)' class='btn btn-sm btn-info'><i class='bi bi-info-square'></i></a>";

            if($model->po_status == 0 || $model->po_status !=1){
                if(Gate::allows('edit', ['/admin/procurement/purchase-order'])){
                    $action .= "<a onclick='editModal($model->id_ponya)' class='btn btn-sm btn-warning'><i class='bi bi-pencil-square'></i></a>";
                }
                if(Gate::allows('delete', ['/admin/procurement/purchase-order'])){
                    $action .= " <a href='/admin/procurement/purchase-order/delete/$model->id_ponya' class='btn btn-sm btn-danger' id='deletepo'><i class='bi bi-trash'></i></a>";
                }
            }
            return $action;
        })->addColumn('statues', function($model){
            $statues = "";

            if($model->po_status == 0 || $model->po_status !=1){
                $statues .= "<a onclick='approveModal($model->id_ponya)' class='btn btn-sm btn-danger'><i class='bi bi-patch-exclamation'></i></i> Confirm Here</a>";
            }else{
                $statues .= "<a class='btn btn-sm btn-primary'><i class='bi bi-patch-check'></i> Confirmed</a>";
            }
            return $statues;
        })->rawColumns(['action', 'statues'])->make(true);
    }

    public function addmodal(){

        $po = PurchaseOrder::latest()->first();
        if($po){
          $unik =  $po->id +1;
        }else{
            $unik = 1;
        }
        $code = 'R'. date('md') .'220'. $unik;

        return view('admin.procurement.purchaseorder.addmodal', ['code' => $code, 'partner'=>Partners::all(), 'currency' => Currency::all()]);
    }

    public function editmodal(Request $request){

        $ponya = DB::connection('procurement')->select("select * from purchase_orders where id = $request->id");
        $s_item = DB::connection('procurement')->select("select * from purchase_order_items where purchase_order_id = $request->id");
        return view('admin.procurement.purchaseorder.editmodal', ['partner'=>Partners::all(), 'currency' => Currency::all(),'ponya' => $ponya, 's_item' => $s_item, 'items'=>Items::all()]);
    }

    public function infomodal(Request $request){
        $info = DB::connection('procurement')->select("call sp_search_id($request->id)");
        // dd($info);
        $items = DB::connection('procurement')->select("select * from purchase_order_items where purchase_order_id = $request->id ");
        return view('admin.procurement.purchaseorder.infomodal', ['info'=> $info, 'items' => $items]);
    }

    public function aprovedmodal(Request $request){
        $info = DB::connection('procurement')->select("call sp_search_id($request->id)");
        $items = DB::connection('procurement')->select("select * from purchase_order_items where purchase_order_id = $request->id ");


        return view('admin.procurement.purchaseorder.aprovedmodal', ['info'=> $info, 'items' => $items, 'id_po' => $request->id]);
    }

    public function approve(Request $request){
        $user_approving = auth()->user()->username;
        $info = DB::connection('procurement')->select("call sp_search_id($request->id)");

        DB::connection('procurement')->select("call sp_approve_po($request->id, '$user_approving')");
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Approved PO",
            'aktivitas' => "Approved PO",
            'keterangan' => "Approved PO ". $info[0]->code
        ]);
        NotifEvent::dispatch(auth()->user()->name .' Approved PO '. $info[0]->code);
        return response()->json(['success'=> 'Data Approved']);
    }

    public function destroy(Request $request){
        $info = DB::connection('procurement')->select("call sp_search_id($request->id)");
        DB::connection('procurement')->select("call sp_delete_po_items($request->id)");

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Delete PO",
            'aktivitas' => "Delete PO",
            'keterangan' => "Delete PO ". $info[0]->code
        ]);
        NotifEvent::dispatch(auth()->user()->name .' Delete PO '. $info[0]->code);
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

    public function getallitem(){
        $items =Items::all();

        $html = '<option>List All Items</option>';

        foreach($items as $item){
            $html .= "<option value='$item->id'>$item->item_code - $item->item_name</option>";
        }

        return response()->json(['html' => $html]);
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
        $html = " <div class='row'> <div class='fv-row mb-7 col-lg-4'>
        <label class='required form-label fw-bold'>Item </label>
                <div class='row'>
                    <div class='col-lg-10'>
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
                            <div class='col-lg-2'>
                                <button onclick='getallitem(this)' type='button' class='btn btn-sm btn-primary'>All</button>
                            </div>
                        </div>
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

        DB::connection('procurement')->select("call sp_insert_po(
            '$request->code',
            '$request->order_date',
            '$request->term_of_payment',
            '$request->description',
            $request->grandtotal,
            '$request->rate',
            '$request->ppn',
            '$request->partner_id',
            '$request->currency_id'
            )");

           $polast = PurchaseOrder::latest()->first();
            $creating = auth()->user()->username;
        if(count($request->item_id) > 1){
                for($i =0; $i < count($request->item_id); $i++){
                    $item_id = $request->item_id[$i];
                    $qty = $request->qty[$i];
                    $price = $request->price[$i];
                    $total_discount = $request->getdiscountperitem[$i];
                    $discount = $request->discount[$i];
                    $total = $request->total[$i];

                    DB::connection('procurement')->select("call sp_insert_po_items(
                        $polast->id,
                        $item_id,
                        '$qty',
                        '$price',
                        '$discount',
                        '$total_discount',
                        '$total',
                        '$creating'
                    )");
                }

        }else{
            $item_id = $request->item_id[0];
            $qty = $request->qty[0];
            $price = $request->price[0];
            $discount = $request->discount[0];
            $total_discount = $request->getdiscountperitem[0];
            $total = $request->total[0];

            DB::connection('procurement')->select("call sp_insert_po_items(
                $polast->id,
                $item_id,
                '$qty',
                '$price',
                '$discount',
                '$total_discount',
                '$total',
                '$creating'
            )");
        }

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Added PO",
            'aktivitas' => "Added PO",
            'keterangan' => "Added PO ". $request->code
        ]);
        NotifEvent::dispatch(auth()->user()->name .' Added PO '. $request->code);

        return redirect('/admin/procurement/purchase-order')->with(['success'=> 'Purchase Order Added']);
    }

    public function update(Request $request){

        if($request->idonpoitems){
            PurchaseOrderItems::where(['purchase_order_id' => $request->id_po])->whereNotIn('id', $request->idonpoitems)->delete();

            PurchaseOrder::where(['id' => $request->id_po])->update(['order_date' => $request->order_date, 'ppn' => $request->ppn, 'currency_id' => $request->currency_id, 'rate' => $request->rate, 'term_of_payment' => $request->term_of_payment, 'description' => $request->description, 'total_po' => $request->grandtotal]);
            for($i = 0; $i < count($request->idonpoitems); $i++){
                PurchaseOrderItems::where(['id' => $request->idonpoitems[$i]])->update([
                    'item_id' => $request->item_id[$i],
                    'unit_price' => $request->price[$i],
                    'qty' => $request->qty[$i],
                    'discount' => $request->discount[$i],
                    'total_discount' => $request->getdiscountperitem[$i],
                    'total_price' => $request->total[$i]
                ]);
            }

            if(count($request->item_id) > count($request->idonpoitems)){
                // dd($request->id_po);
                for($i = count($request->idonpoitems); $i < count($request->item_id); $i++){
                    PurchaseOrderItems::create([
                        'purchase_order_id' => $request->id_po,
                        'item_id' => $request->item_id[$i],
                        'unit_price' => $request->price[$i],
                        'qty' => $request->qty[$i],
                        'discount' => $request->discount[$i],
                        'total_discount' => $request->getdiscountperitem[$i],
                        'total_price' => $request->total[$i]
                    ]);
                }
            }
        }else{

            if($request->item_id){
                PurchaseOrder::where(['id' => $request->id_po])->update(['order_date' => $request->order_date, 'ppn' => $request->ppn, 'currency_id' => $request->currency_id, 'rate' => $request->rate, 'term_of_payment' => $request->term_of_payment, 'description' => $request->description, 'total_po' => $request->grandtotal]);
                PurchaseOrderItems::where(['purchase_order_id' => $request->id_po])->delete();

                for($i = 0; $i < count($request->item_id); $i++){

                    PurchaseOrderItems::create([
                        'purchase_order_id' => $request->id_po,
                        'item_id' => $request->item_id[$i],
                        'unit_price' => $request->price[$i],
                        'qty' => $request->qty[$i],
                        'discount' => $request->discount[$i],
                        'total_discount' => $request->getdiscountperitem[$i],
                        'total_price' => $request->total[$i]
                    ]);
                 }

            }else{
                return redirect('/admin/procurement/purchase-order')->with(['fail'=> 'Purchase Order Fail to Edit, The Items Cannot Null']);
            }

        }
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Edit PO",
            'aktivitas' => "Edit PO",
            'keterangan' => "Edit PO ". $request->code
        ]);
        NotifEvent::dispatch(auth()->user()->name .' Edit PO '. $request->code);

        return redirect('/admin/procurement/purchase-order')->with(['success'=> 'Purchase Order Edited']);
    }

}
