<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Region;
use Illuminate\Http\Request;

class CustomerController extends Controller
{


    public function index(){
        return view('admin.customer.index', ['customer'=> Customer::all()]);
    }

    public function addmodal(){
        return view('admin.customer.addmodal', ['region' => Region::all()]);
    }

    public function store(Request $request){
        // dd($request);
        Customer::create([
            'cust_code' => $request->cust_code,
            'cust_name' => $request->cust_name,
            'region' => $request->region,
            'no_npwp' => $request->no_npwp,
            'npwp_address' => $request->npwp_address,
            'cust_address' => $request->cust_address,
            'district' => $request->district,
            'city' => $request->city,
            'group' => $request->group,
            'phone' => $request->phone,
            'email' => $request->email,
            'contact_person' => $request->contact_person,
            'credit_limit' => $request->credit_limit,
            'credit_status' => 1,
            'credit_left' => null
        ]);
        return redirect()->back()->with('success', 'Data Customer di Tambahkan !');
    }

    public function editmodal(Request $request){
        return view('admin.customer.editmodal', ['region' => Region::all(),'cust'=>Customer::where(['id'=>$request->id])->first()]);
    }

    public function update(Request $request){
        Customer::where(['id'=>$request->id])->update([
            'cust_code' => $request->cust_code,
            'cust_name' => $request->cust_name,
            'region' => $request->region,
            'no_npwp' => $request->no_npwp,
            'npwp_address' => $request->npwp_address,
            'cust_address' => $request->cust_address,
            'district' => $request->district,
            'city' => $request->city,
            'group' => $request->group,
            'phone' => $request->phone,
            'email' => $request->email,
            'contact_person' => $request->contact_person,
            'credit_limit' => $request->credit_limit,
            'credit_status' => 1,
            'credit_left' => null,
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Data Customer di Update !');
    }

    public function destroy(Request $request){
        Customer::where(['id'=>$request->id])->delete();
        return redirect()->back()->with('success', 'Data Customer di Hapus !');
    }
}
