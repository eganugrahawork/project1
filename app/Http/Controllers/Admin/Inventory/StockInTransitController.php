<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StockInTransitController extends Controller {
  public function index() {
    return view('admin.inventory.stockintransit.index');
  }

  public function filter(Request $request) {
    $date = explode(' - ', $request->date_range);


    return response()->json(['data' => $date[0]]);
  }

  public function create() {
    return view('admin.inventory.stockintransit.create');
  }

  public function addnewitemrow() {
    $html = "<div class='row'>
                <div class='fv-row mb-3 col-lg-4'>
                    <label class=' form-label fs-6 fw-bold'>Item</label>
                    <select class='form-select  form-select-solid mb-3 mb-lg-0' id='item_id'
                        name='item_id[]' required>
                        <option>Choose Item</option>
                    </select>
                </div>
                    <div class='fv-row mb-3 col-lg-2'>
                    <label class=' fw-bold fs-6 mb-2'>Qty Box</label>
                    <input type='number' name='qty_box[]' id='qty_box'
                        class='form-control form-control-solid mb-3 mb-lg-0 ' required />
                </div>
                <div class='fv-row mb-3 col-lg-2'>
                    <label class='required fw-bold fs-6 mb-2'>Total Qty Box</label>
                    <input type='number' name='total_qty_box[]' id='total_qty_box' readonly
                        class='form-control form-control-solid mb-3 mb-lg-0 ' required />
                </div>
                <div class='fv-row mb-3 col-lg-1  '>
                    <button class='btn btn-danger btn-sm btn-icon mt-4' type='button' onclick='removeItemRow(this)'>-</button>
                </div></div>";

    return response()->json(['html' => $html]);
  }
}
