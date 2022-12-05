<?php

namespace App\Http\Controllers\Admin\Masterdata;

use App\Events\NotifEvent;
use App\Http\Controllers\Controller;
use App\Models\Items;
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
        return view('admin.masterdata.partners.partnerlist.index');
    }

    public function list(){
        return  Datatables::of(DB::connection('masterdata')->select('Call sp_list_partners()'))->addIndexColumn()
        ->addColumn('action', function($model){
            $action = "<a onclick='infoModal($model->id)' class='btn btn-sm btn-icon btn-info btn-hover-rise me-1'><i class='bi bi-info-square'></i></a>";
            if(Gate::allows('edit', ['/admin/masterdata/partners'])){
                $action .= "<a onclick='edit($model->id)' class='btn btn-sm btn-icon btn-warning btn-hover-rise me-1'><i class='bi bi-pencil-square'></i></a>";
            }
            if(Gate::allows('delete', ['/admin/masterdata/partners'])){
                $action .= " <a href='/admin/masterdata/partners/delete/$model->id' class='btn btn-sm btn-icon btn-danger btn-hover-rise me-1' id='deletepartners'><i class='bi bi-trash'></i></a>";
            }
            return $action;
        })
        ->make(true);
    }


    public function create(){
        return view('admin.masterdata.partners.partnerlist.create', ['partner_type' => PartnerType::all()]);
    }

    public function store(Request $request){

        DB::connection('masterdata')->select("call sp_insert_partners(
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


        DB::connection('masterdata')->select("call sp_delete_partners(
            $request->id
        )");

        NotifEvent::dispatch(auth()->user()->name .' menghapus Partners '. $partnernya->name);

        return response()->json(['success'=> 'Partner Berhasil Dihapus']);
    }

    public function infomodal(Request $request){

        return view('admin.masterdata.partners.partnerlist.infomodal', ['partner' => Partners::where(['id'=> $request->id])->first()]);
    }

    public function getinfoitem(Request $request){

        return  Datatables::of(DB::connection('masterdata')->select("SELECT a.`item_code`, a.`item_name`, a.`item_description`, b.name AS unit, c.`base_qty` AS stock, d.`buy_price` AS buy_price FROM items a JOIN uom b ON a.uom_id = b.`id`
        JOIN item_qty c ON a.`id` = c.`item_id` JOIN item_price d ON a.`id` = d.`item_id` WHERE a.partner_id = $request->id"))->addIndexColumn()
        ->make(true);
    }

    public function edit(Request $request){

        return view('admin.masterdata.partners.partnerlist.edit', ['partners' => Partners::where(['id'=> $request->id])->first(), 'partner_type' => PartnerType::all()]);
    }

    public function update(Request $request){


        DB::connection('masterdata')->select("call sp_update_partners(
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
        return view('admin.masterdata.partners.typepartner.index');
    }

    public function listtypeofpartners(){
        return  Datatables::of(DB::connection('masterdata')->select('Call sp_list_partner_types()'))->addIndexColumn()
        ->addColumn('action', function($model){
            $action = "";
            if(Gate::allows('edit', ['/admin/masterdata/typeofpartner'])){
                $action .= "<a onclick='editModalType($model->id)' class='btn btn-sm btn-icon btn-warning btn-hover-rise me-1'><i class='bi bi-pencil-square'></i></a>";
            }
            if(Gate::allows('delete', ['/admin/masterdata/typeofpartner'])){
                $action .= " <a href='/admin/masterdata/partners/destroytypepartners/$model->id' class='btn btn-sm btn-icon btn-danger btn-hover-rise me-1' id='deletepartnerstype'><i class='bi bi-trash'></i></a>";
            }
            return $action;
        })
        ->make(true);
    }

    public function addtypepartnermodal(){
        return view('admin.masterdata.partners.typepartner.addtypepartnermodal');
    }

    public function storetypepartners(Request $request){
        DB::connection('masterdata')->select("call sp_insert_partner_types('$request->name', $request->status)");

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Type Partners",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah Type Partners ". $request->name
        ]);

        NotifEvent::dispatch(auth()->user()->name .' menambahkan Type Partner '. $request->name);
        return response()->json(['success' => 'Type Partner Added']);
    }

    public function edittypepartnermodal(Request $request){
        return view('admin.masterdata.partners.typepartner.edittypepartnermodal', ['tp' =>  PartnerType::where(['id' => $request->id])->first()]);
    }

    public function updatetypepartners(Request $request){
        DB::connection('masterdata')->select("call sp_update_partner_types($request->id,'$request->name', $request->status)");
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Type Partners",
            'aktivitas' => "Update",
            'keterangan' => "Update Type Partners ". $request->name
        ]);

        NotifEvent::dispatch(auth()->user()->name .' Update Type Partner '. $request->name);
        return response()->json(['success', 'Type Partner has Edited']);
    }

    public function destroytypepartners(Request $request){
        DB::connection('masterdata')->select("call sp_delete_partner_types($request->id)");
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Type Partners",
            'aktivitas' => "Hapus",
            'keterangan' => "Hapus Type Partners dengan id ". $request->id
        ]);

        NotifEvent::dispatch(auth()->user()->name .' Hapus Type Partner Menjadi '. $request->id);

        return response()->json(['success', 'Type Parter Deleted']);
    }


}
