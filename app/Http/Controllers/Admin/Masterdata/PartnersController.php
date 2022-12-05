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
            $action = "<a onclick='info($model->id)' class='btn btn-sm btn-icon btn-info btn-hover-rise me-1'><i class='bi bi-info-square'></i></a>";
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

    public function info(Request $request){

        return view('admin.masterdata.partners.partnerlist.info', ['partner' => Partners::where(['id'=> $request->id])->first()]);
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

}
