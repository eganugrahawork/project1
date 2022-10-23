<?php

namespace App\Http\Controllers\Admin;

use App\Events\NotifEvent;
use App\Http\Controllers\Controller;

use App\Models\Uom;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class UoMController extends Controller
{
    // public function index(){
    //     return view('admin.uom.index', ['uom'=> DB::connection('masterdata')->select('Call sp_list_uom()')]);
    // }
    public function index(){

        return view('admin.uom.index');
    }

    public function list(){
        // $uom= DB::connection('masterdata')->select('Call sp_list_uom()');
        return  Datatables::of(DB::connection('masterdata')->select('Call sp_list_uom()'))->addIndexColumn()
        ->addColumn('action', function($model){
            $action = "";
            if(Gate::allows('edit', ['/admin/masterdata/uom'])){
                $action .= "<a onclick='editModal($model->id)' class='btn btn-sm btn-warning'><i class='bi bi-pencil-square'></i></a>";
            }
            if(Gate::allows('delete', ['/admin/masterdata/uom'])){
                $action .= " <a href='/admin/masterdata/uom/delete/$model->id' class='btn btn-sm btn-danger' id='deleteuom'><i class='bi bi-trash'></i></a>";
            }
            return $action;
        })
        ->make(true);
    }

    public function addmodal(){
        return view('admin.uom.addmodal');
    }

    public function store(Request $request){
        // Uom::create(['name' => $request->name,'symbol' => $request->symbol, 'description'=>$request->description]);


        DB::connection('masterdata')->select("Call sp_insert_uom(
            '$request->name',
            '$request->symbol',
            '$request->description',
            $request->status
        )");
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "UOM",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah UOM ". $request->name
         ]);

    NotifEvent::dispatch(auth()->user()->name .' menambahkan Uom '. $request->name);

        return response()->json(['success'=> 'Uom Ditambahkan']);
    }

    public function destroy(Request $request){
        // dd($request->id);
       $uom = Uom::where(['id' => $request->id])->first();


       UserActivity::create([
        'id_user' => auth()->user()->id,
        'menu' => "UOM",
        'aktivitas' => "Hapus",
        'keterangan' => "Hapus UOM ". $uom->name
        ]);
        NotifEvent::dispatch(auth()->user()->name .' menghapus Uom '. $uom->name);
        DB::connection('masterdata')->select("Call sp_delete_uom(
            $request->id
        )");
        return response()->json(['success' => 'Uom berhasil dihapus']);
    }

    public function editmodal(Request $request){

        return view('admin.uom.editmodal', ['uom'=> Uom::where(['id'=>$request->id])->first()]);
    }

    public function update(Request $request){
        // Uom::where(['id' => $request->id])->update(['name' => $request->name,'symbol' => $request->symbol, 'description'=>$request->description]);

        DB::connection('masterdata')->select("Call sp_update_uom(
            $request->id,
           '$request->name',
           '$request->symbol',
           '$request->description',
           $request->status
       )");

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "UOM",
            'aktivitas' => "Ubah",
            'keterangan' => "Ubah UOM ". $request->name
         ]);

         NotifEvent::dispatch(auth()->user()->name .' mengedit Uom '. $request->name);
         return response()->json(['success'=> "Uom $request->name DiUpdate"]);
    }
}
