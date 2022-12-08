<?php

namespace App\Http\Controllers\Admin\Masterdata;

use App\Events\NotifEvent;
use App\Http\Controllers\Controller;
use App\Models\Coa;
use App\Models\TypeItems;
use App\Models\UserActivity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class TypeItemController extends Controller
{
    public function index() {

        return view('admin.masterdata.items.typeitem.index', ['itemtype' => DB::connection('masterdata')->select('call sp_list_item_types')]);
    }

    public function list() {
        return  Datatables::of(DB::connection('masterdata')->select('call sp_list_item_types'))->addIndexColumn()
            ->addColumn('action', function ($model) {
                $action = "";
                if (Gate::allows('edit', ['/admin/masterdata/typeitems'])) {
                    $action .= "<a onclick='edit($model->id)' class='btn btn-sm btn-icon btn-warning btn-hover-rise me-1'><i class='bi bi-pencil-square'></i></a>";
                }
                if (Gate::allows('delete', ['/admin/masterdata/typeitems'])) {
                    $action .= " <a href='/admin/masterdata/typeitems/delete/$model->id' class='btn btn-sm btn-icon btn-danger btn-hover-rise me-1' id='deleteTypeItem'><i class='bi bi-trash'></i></a>";
                }
                return $action;
            })->make(true);
    }

    public function create() {
        return view('admin.masterdata.items.typeitem.create', ['coa' => Coa::all()]);
    }

    public function edit(Request $request) {

        return view('admin.masterdata.items.typeitem.edit', ['typeitems' => TypeItems::where(['id' => $request->id])->first(), 'coa' => Coa::all()]);
    }

    public function store(Request $request) {

        DB::connection('masterdata')->select("call sp_insert_item_types(
            '$request->coa_id',
            '$request->name_type',
            '$request->description',
            $request->status
        )");

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Type Items",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah Type items " . $request->name_type
        ]);
        NotifEvent::dispatch(auth()->user()->name . ' Tambah Type Items  ' . $request->name_type);

        return response()->json(['success' =>  'Type Items added']);
    }

    public function update(Request $request) {
        DB::connection('masterdata')->select("call sp_update_item_types(
            $request->id,
            '$request->coa_id',
            '$request->name_type',
            '$request->description',
            $request->status
        )");

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Type Items",
            'aktivitas' => "Update",
            'keterangan' => "Update Type items " . $request->name_type
        ]);
        NotifEvent::dispatch(auth()->user()->name . ' Update Type Items  ' . $request->name_type);
        return response()->json(['success' =>  'Type Items Updated']);
    }

    public function destroy(Request $request) {
        DB::connection('masterdata')->select("call sp_delete_item_types(
            $request->id
        )");
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Type Items",
            'aktivitas' => "Hapus",
            'keterangan' => "Hapus Type items dengan id " . $request->id
        ]);
        NotifEvent::dispatch(auth()->user()->name . ' Hapus Type Items dengan id  ' . $request->id);
        return response()->json(['success' =>  'Type Items Deleted']);
    }

}
