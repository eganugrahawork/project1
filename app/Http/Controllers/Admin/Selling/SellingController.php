<?php

namespace App\Http\Controllers\Admin\Selling;

use App\Http\Controllers\Controller;
use App\Models\ItemQty;
use App\Models\Items;
use App\Models\Ordering;
use App\Models\Partners;
use Illuminate\Http\Request;

class SellingController extends Controller {
  public function index() {
    $year_count = date('Y') - 2019;
    $years = ['All'];

    for ($i = $year_count; $i >= 0; $i--) {

      $y = 2019 + $i;

      array_push($years, $y);
    }
    $month =  array('All', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    return view('admin.selling.selling.index', ['month' => $month, 'years' => $years]);
  }

  public function create() {
    $ordering = Ordering::where('name_menu', 'selling')->first();
    if ($ordering->seq_max + 1 < 1000) {
      if ($ordering->seq_max + 1 < 100) {
        if ($ordering->seq_max + 1 < 10) {
          $code = $ordering->begin_code . date('Y') . '000' . ($ordering->seq_max + 1) . $ordering->end_code;
        } else {
          $code = $ordering->begin_code . date('Y') . '00' . ($ordering->seq_max + 1) . $ordering->end_code;
        }
      } else {
        $code = $ordering->begin_code . date('Y') . '0' . ($ordering->seq_max + 1) . $ordering->end_code;
      }
    } else {
      $code = $ordering->begin_code . date('Y') . '' . ($ordering->seq_max + 1) . $ordering->end_code;
    }

    $customer = Partners::select('partners.name', 'partners.id', 'partners.code')->join('partner_types', 'partners.partner_type', '=', 'partner_types.id')
      ->where('partner_types.name', '=', 'Customer')->get();
    $item = Items::all();
    return view('admin.selling.selling.create', ['code' => $code, 'customer' => $customer, 'item' => $item]);
  }

  public function getdatacustomer(Request $request) {
    $customer = Partners::where('id', $request->id)->first();

    return response()->json([
      'address' => $customer->address,
      'att' => $customer->att,
      'phone' => $customer->phone,
      'email' => $customer->email,
      'credit_limit' => 0,
      'credit_balance' => 0
    ]);
  }

  public function addnewitemrow() {
    $item = Items::all();

    $html = "<div class='row'>
    <div class='fv-row mb-3 col-lg-3'>
        <label class=' form-label fs-6 fw-bold'>Item</label>
        <select class='form-select  form-select-solid mb-3 mb-lg-0 select-2' onchange='getDetailItem(this)' id='item_id' name='item_id[]'
            required>
            <option>Choose Item</option>";

    foreach ($item as $itm) {
      $html .= "<option value='$itm->id'>$itm->item_code-$itm->item_name</option>";
    }
    $html .=  " </select>
    </div>
    <div class='fv-row mb-3 col-lg-1'>
        <label class=' fw-bold fs-6 mb-2'>Q Box</label>
        <input type='number' name='qty_box[]' id='qty_box' onkeyup='countTotalQty(this)'
            class='form-control form-control-solid mb-3 mb-lg-0 '  value='0' required />
            <p class='fs-9 fw-bolder' id='detail_box'></p>
            <input type='hidden' name='qty_per_box[]' id='qty_per_box'>
            <input type='hidden' name='stock[]' id='stock'>
    </div>
    <div class='fv-row mb-3 col-lg-1'>
        <label class=' fw-bold fs-6 mb-2'>Qty</label>
        <input type='number' name='qty[]' id='qty'
            class='form-control form-control-solid mb-3 mb-lg-0'  value='0' onkeyup='countTotalQty(this)'  required />
    </div>
    <div class='fv-row mb-3 col-lg-2'>
        <label class='required fw-bold fs-6 mb-2'>Total Qty</label>
        <input type='number' name='total_qty[]' id='total_qty' readonly
            class='form-control form-control-solid mb-3 mb-lg-0 '  value='0' required />
    </div>
    <div class='fv-row mb-3 col-lg-2'>
        <label class=' fw-bold fs-6 mb-2'>Price</label>
        <input type='number' name='price[]' id='price'
            class='form-control form-control-solid mb-3 mb-lg-0'  value='0' onkeyup='countTotalQty(this)' required />
    </div>
    <div class='fv-row mb-3 col-lg-2'>
        <label class=' fw-bold fs-6 mb-2'>Total</label>
        <input type='number' name='total_price[]' id='total_price'
            class='form-control form-control-solid mb-3 mb-lg-0' value='0' readonly required />
    </div>
    <div class='fv-row mb-3 col-lg-1  '>
        <button class='btn btn-danger btn-sm btn-icon mt-4' type='button'
            onclick='removeItemRow(this)'>-</button>
    </div>
</div>";


    return response()->json(['html' => $html]);
  }

  public function getdetailitem(Request $request) {
    $item = ItemQty::where('item_id', $request->id)->first();

    $desc = '1 Box : ' . number_format($item->unit_box, 0, ',', '.') . ' Pcs Stock : ' . number_format($item->base_qty, 0, ',', '.') . ' Box';

    return response()->json([
      'desc' => $desc, 'qty_per_box' => $item->unit_box,
      'stock' => $item->base_qty
    ]);
  }
}
