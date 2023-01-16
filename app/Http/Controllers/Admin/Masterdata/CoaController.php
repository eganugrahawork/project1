<?php

namespace App\Http\Controllers\Admin\Masterdata;

use App\Events\NotifEvent;
use App\Http\Controllers\Controller;
use App\Models\Coa;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;


class CoaController extends Controller
{
    public function index(){
        return view('admin.masterdata.coa.index');
    }
    public function list(Request $request){
        $limit = $request->input('length');
        $offset = $request->input('start');
        // dd($limit);
        // $order_by = $request->input('order.0.column');
        // $sort_by = $request->input('order.0.dir');
        $search = $request->input('search.value');
        if ($search !== '') {
            $search = $request->input('search.value');
        } else {
            $search = null;
        }
        $data['data'] = DB::connection('masterdata')->select('Call sp_list_coa(?, ?,?, @total_filtered, @total )', [$limit, $offset, $search]);
        // dd($data);

        $recordsFiltered = DB::connection('masterdata')->select('select @total_filtered as total_filtered');
        $recordsTotal = DB::connection('masterdata')->select('select @total as total');
        // dd($recordsFiltered, '-', $recordsTotal);

        $data['recordsFiltered'] = $recordsFiltered[0]->total_filtered;
        $data['recordsTotal'] = $recordsTotal[0]->total;
        
        return DataTables::of($data['data'])
        ->with('recordsTotal', $data['recordsTotal'])
        ->with('recordsFiltered', $data['recordsFiltered'])
        ->setOffset($offset)
        ->make(true);

    }

    public function create(){

        return view('admin.masterdata.coa.create', ['coa' =>DB::connection('masterdata')->select('Call sp_list_coa()') ]);
    }


    public function store(Request $request){

        DB::connection('masterdata')->select("call sp_insert_coa(
            $request->id_parent,
            '$request->coa',
            '$request->description',
            $request->status
        )");

        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "COA",
            'aktivitas' => "Tambah",
            'keterangan' => "Tambah COA ". $request->coa
        ]);

        NotifEvent::dispatch(auth()->user()->name .' menambahkan COA '. $request->coa);
        return response()->json(['success'=> 'Coa Ditambahkan']);
    }

    public function edit(Request $request){

        return view('admin.masterdata.coa.edit', ['coa' => Coa::where(['id' => $request->id])->first(), 'parentcoa' => Coa::all()]);
    }

    public function update(Request $request){

        DB::connection('masterdata')->select("call sp_update_coa(
            $request->id,
            '$request->coa',
            '$request->description',
            $request->status
        )");
        UserActivity::create([
            'id_user' => auth()->user()->id,
            'menu' => "COA",
            'aktivitas' => "Update",
            'keterangan' => "Update COA ". $request->coa
        ]);

        NotifEvent::dispatch(auth()->user()->name .' edit Coa '. $request->coa);
        return response()->json(['success'=> 'Coa diubah menjadi '. $request->coa]);
    }

    public function destroy(Request $request){
       $coa = Coa::where(['id' => $request->id])->first();
       UserActivity::create([
           'id_user' => auth()->user()->id,
           'menu' => "COA",
           'aktivitas' => "Hapus",
           'keterangan' => "Hapus COA ". $coa->coa
        ]);

        DB::connection('masterdata')->select("call sp_delete_coa(
            $request->id
        )");

        NotifEvent::dispatch(auth()->user()->name .' menghapus Coa '. $coa->coa);
        return response()->json(['success'=> 'Coa Dihapus']);

    }
}
