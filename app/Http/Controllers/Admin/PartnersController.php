<?php

namespace App\Http\Controllers\Admin;

use App\Events\NotifEvent;
use App\Http\Controllers\Controller;
use App\Models\Partners;
use App\Models\PartnerType;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class PartnersController extends Controller
{
    public function index(){
        return view('admin.partners.index');
    }

    public function list(){
        return  Datatables::of(DB::select('Call sp_list_partners()'))->addIndexColumn()
        ->addColumn('action', function($model){
            $action = "";
            if(Gate::allows('edit', [1, '/admin/masterdata/partners'])){
                $action .= "<a onclick='editModal($model->id)' class='btn btn-sm btn-warning'><i class='bi bi-pencil-square'></i></a>";
            }
            if(Gate::allows('delete', [1, '/admin/masterdata/partners'])){
                $action .= " <a href='/admin/masterdata/partners/delete/$model->id' class='btn btn-sm btn-danger' id='deletepartners'><i class='bi bi-trash'></i></a>";
            }
            return $action;
        })
        ->make(true);
    }


    public function addmodal(){
        return view('admin.partners.addmodal', ['partner_type' => PartnerType::all()]);
    }

    public function store(Request $request){

        DB::select("call sp_insert_partners(
            '$request->code',
            '$request->name',
            $request->partner_type,
            '$request->phone',
            '$request->fax',
            '$request->email',
            '$request->address',
            '$request->ship_address',
            '$request->bank_name',
            '$request->account_number',
            $request->status
        )");

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Partners",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah Partners ". $request->name
        ]);

        NotifEvent::dispatch(auth()->user()->name .' menambahkan Partners '. $request->name);

        return response()->json(['success'=> 'Partner Ditambahkan']);
    }

    public function destroy(Request $request){
        $partnernya = Partners::where(['id' =>$request->id])->first();
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Partners",
            'aktivitas' => "Hapus",
            'keterangan' => "Hapus Partners ". $partnernya->name
        ]);


        DB::select("call sp_delete_partners(
            $request->id
        )");

        NotifEvent::dispatch(auth()->user()->name .' menghapus Partners '. $partnernya->name);

        return response()->json(['success'=> 'Partner Berhasil Dihapus']);
    }

    public function editmodal(Request $request){

        return view('admin.partners.editmodal', ['partners' => Partners::where(['id'=> $request->id])->first(), 'partner_type' => PartnerType::all()]);
    }

    public function update(Request $request){


        DB::select("call sp_update_partners(
            $request->id,
            '$request->code',
            '$request->name',
            $request->partner_type,
            '$request->phone',
            '$request->fax',
            '$request->email',
            '$request->address',
            '$request->ship_address',
            '$request->bank_name',
            '$request->account_number',
            $request->status
        )");
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Partners",
            'aktivitas' => "Update",
            'keterangan' => "Update Partners ". $request->name
        ]);

        NotifEvent::dispatch(auth()->user()->name .' merubah Partner menjadi '. $request->name);

        return response()->json(['success'=> 'Partner diupdate']);
    }

    public function typeofpartner(){
        return view('admin.partners.typepartners');
    }

    public function listtypeofpartners(){
        return  Datatables::of(DB::select('Call sp_list_partner_types()'))->addIndexColumn()
        ->addColumn('action', function($model){
            $action = "";
            if(Gate::allows('edit', [1, '/admin/masterdata/partners'])){
                $action .= "<a onclick='editModalType($model->id)' class='btn btn-sm btn-warning'><i class='bi bi-pencil-square'></i></a>";
            }
            if(Gate::allows('delete', [1, '/admin/masterdata/partners'])){
                $action .= " <a href='/admin/masterdata/partners/destroytypepartners/$model->id' class='btn btn-sm btn-danger' id='deletepartnerstype'><i class='bi bi-trash'></i></a>";
            }
            return $action;
        })
        ->make(true);
    }

    public function addtypepartnermodal(){
        return view('admin.partners.addtypepartnermodal');
    }

    public function storetypepartners(Request $request){
        DB::select("call sp_insert_partner_types('$request->name', $request->status)");

        return response()->json(['success' => 'Type Partner Added']);
    }

    public function edittypepartnermodal(Request $request){
        return view('admin.partners.edittypepartnermodal', ['tp' =>  PartnerType::where(['id' => $request->id])->first()]);
    }

    public function updatetypepartners(Request $request){
        DB::select("call sp_update_partner_types($request->id,'$request->name', $request->status)");

        return response()->json(['success', 'Type Partner has Edited']);
    }

    public function destroytypepartners(Request $request){
        DB::select("call sp_delete_partner_types($request->id)");

        return response()->json(['success', 'Type Parter Deleted']);
    }


}
