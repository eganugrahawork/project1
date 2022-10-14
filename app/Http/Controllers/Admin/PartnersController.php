<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partners;
use App\Models\PartnerType;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartnersController extends Controller
{
    public function index(){
        return view('admin.partners.index', ['partners' => DB::select('Call sp_list_partners()')]);
    }

    public function addmodal(){
        return view('admin.partners.addmodal', ['partner_type' => PartnerType::all()]);
    }

    public function store(Request $request){


        // Partners::create([
        //     'code' => $request->code,
        // 	'name' => $request->name,
        // 	'partner_type' => $request->partner_type,
        // 	'phone' => $request->phone,
        // 	'fax' => $request->fax,
        // 	'email' =>$request->email,
        // 	'address' => $request->address,
        // 	'ship_address' => $request->ship_address,
        // 	'bank_name' => $request->bank_name,
        // 	'account_number' => $request->account_number,
        //     'status' => 1
        // ]);

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
            '$request->status',
        )");

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Partners",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah Partners ". $request->name
        ]);
        return back()->with('success', 'Partners berhasil ditambahkan!');
    }

    public function destroy(Request $request){
        $partnernya = Partners::where(['id' =>$request->id])->first();
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "Partners",
            'aktivitas' => "Hapus",
            'keterangan' => "Hapus Partners ". $partnernya->name
        ]);
        // Partners::where(['id'=>$request->id])->delete();
        DB::select("call sp_delete_partners(
            $request->id
        )");
        return back()->with('success', 'Partners berhasil dihapus!');
    }

    public function editmodal(Request $request){

        return view('admin.partners.editmodal', ['partners' => Partners::where(['id'=> $request->id])->first(), 'partner_type' => PartnerType::all()]);
    }

    public function update(Request $request){
        // Partners::where(['id' => $request->id])->update([
        //     'code' => $request->code,
		// 	'name' => $request->name,
		// 	'phone' => $request->phone,
		// 	'fax' => $request->fax,
        //     'partner_type' => $request->partner_type,
		// 	'email' =>$request->email,
		// 	'address' => $request->address,
		// 	'ship_address' => $request->ship_address,
		// 	'bank_name' => $request->bank_name,
		// 	'account_number' => $request->account_number,
        //     'status' => $request->status
        // ]);

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
        return back()->with('success', 'Partners berhasil diUpdate!');
    }
}
