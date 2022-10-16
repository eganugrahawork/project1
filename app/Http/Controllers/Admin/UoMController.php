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
    //     return view('admin.uom.index', ['uom'=> DB::select('Call sp_list_uom()')]);
    // }
    public function index(){

        return view('admin.uom.indexserverside');
    }

    public function list(){
        // $uom= DB::select('Call sp_list_uom()');
        return  Datatables::of(DB::select('Call sp_list_uom()'))
        ->addColumn('action', function($model){
            $action = "";
            if(Gate::allows('edit', [0, '/admin/users'])){
                $action .= "<a onclick='editModal($model->id)' class='btn btn-sm btn-warning'><i class='bi bi-pencil-square'></i></a>";
            }
            if(Gate::allows('delete', [0, '/admin/users'])){
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


        DB::select("Call sp_insert_uom(
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

        return redirect()->back()->with('success', 'Uom Ditambahkan');
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
        DB::select("Call sp_delete_uom(
            $request->id
        )");
        return redirect()->back()->with('success', 'Data Uom Dihapus !');
    }

    public function editmodal(Request $request){

        return view('admin.uom.editmodal', ['uom'=> Uom::where(['id'=>$request->id])->first()]);
    }

    public function update(Request $request){
        // Uom::where(['id' => $request->id])->update(['name' => $request->name,'symbol' => $request->symbol, 'description'=>$request->description]);

        DB::select("Call sp_update_uom(
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
        return redirect()->back()->with('success', 'Data Uom diUpdate !');
    }
}
