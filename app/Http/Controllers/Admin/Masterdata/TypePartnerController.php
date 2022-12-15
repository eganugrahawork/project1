<?php

namespace App\Http\Controllers\Admin\Masterdata;

use App\Events\NotifEvent;
use App\Http\Controllers\Controller;
use App\Models\PartnerType;
use App\Models\UserActivity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class TypePartnerController extends Controller
{
    public function index(){
        return view('admin.masterdata.partners.typepartner.index');
    }

    public function list(){
        return  Datatables::of(DB::connection('masterdata')->select('Call sp_list_partner_types()'))->addIndexColumn()
        ->addColumn('action', function($model){
            $action = "";
            if(Gate::allows('edit', ['/admin/masterdata/typeofpartner'])){
                $action .= "<a onclick='edit($model->id)' class='btn btn-sm btn-icon btn-warning btn-hover-rise me-1'><i class='bi bi-pencil-square'></i></a>";
            }
            if(Gate::allows('delete', ['/admin/masterdata/typeofpartner'])){
                $action .= " <a href='/admin/masterdata/typepartners/destroy/$model->id' class='btn btn-sm btn-icon btn-danger btn-hover-rise me-1' id='deletepartnerstype'><i class='bi bi-trash'></i></a>";
            }
            return $action;
        })
        ->make(true);
    }

    public function create(){
        return view('admin.masterdata.partners.typepartner.create');
    }

    public function store(Request $request){
        DB::connection('masterdata')->select("call sp_insert_partner_types('$request->name', $request->status)");

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Type Partners",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah Type Partners ". $request->name
        ]);

        NotifEvent::dispatch(auth()->user()->name .' menambahkan Type Partner '. $request->name);
        return response()->json(['success' => 'Type Partner Ditambahkan']);
    }

    public function edit(Request $request){
        return view('admin.masterdata.partners.typepartner.edit', ['tp' =>  PartnerType::where(['id' => $request->id])->first()]);
    }

    public function update(Request $request){
        DB::connection('masterdata')->select("call sp_update_partner_types($request->id,'$request->name', $request->status)");
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Type Partners",
            'aktivitas' => "Update",
            'keterangan' => "Update Type Partners ". $request->name
        ]);

        NotifEvent::dispatch(auth()->user()->name .' Update Type Partner '. $request->name);
        return response()->json(['success', 'Tipe Partner diPerbarui']);
    }

    public function destroy(Request $request){
        DB::connection('masterdata')->select("call sp_delete_partner_types($request->id)");
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Type Partners",
            'aktivitas' => "Hapus",
            'keterangan' => "Hapus Type Partners dengan id ". $request->id
        ]);

        NotifEvent::dispatch(auth()->user()->name .' Hapus Type Partner Menjadi '. $request->id);

        return response()->json(['success', 'Tipe Partner Dihapus']);
    }
}
