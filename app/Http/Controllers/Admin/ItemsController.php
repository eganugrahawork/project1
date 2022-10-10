<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Items;
use App\Models\PriceHistory;
use App\Models\Principal;
use App\Models\TypeItems;
use App\Models\Uom;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index(){
        return view('admin.items.index', ['items' => Items::all()]);
    }

    public function addmodal(){
        return view('admin.items.addmodal', ['principal'=> Principal::all(), 'uom'=>Uom::all(), 'type' => TypeItems::all()]);
    }

    public function store(Request $request){
        Items::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'base_qty' => $request->base_qty,
            'uom_id' => $request->uom_id,
            'unit_box' => $request->unit_box,
            'type' => $request->type,
            'vat' => $request->vat,
            'partner_id' => $request->partner_id,
            'status' => 1
        ]);

        $newItem = Items::latest()->first();
        PriceHistory::create(['items_id'=> $newItem->id]);
        return redirect()->back()->with('success', 'Data Item Ditambahkan !');
    }

    public function editmodal(Request $request){
        $item = Items::where(['id'=>$request->id])->first();

        return view('admin.items.editmodal', ['item' => $item, 'uom' => Uom::all(), 'principal' => Principal::all(), 'type'=>TypeItems::all()]);
    }

    public function update(Request $request){
        Items::where(['id' =>$request->id])->update([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'base_qty' => $request->base_qty,
            'uom_id' => $request->uom_id,
            'unit_box' => $request->unit_box,
            'type' => $request->type,
            'vat' => $request->vat,
            'partner_id' => $request->partner_id,
            'status' => $request->status
        ]);
        return redirect()->back()->with('success', 'Data Item diUpdate !');
    }

    public function destroy(Request $request){

        PriceHistory::where(['items_id' => $request->id])->delete();
        Items::where(['id' => $request->id])->delete();
        return redirect()->back()->with('success', 'Data Item Dihapus !');
    }
}
