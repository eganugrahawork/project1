<?php

namespace App\Http\Controllers\Admin\Selling;

use App\Http\Controllers\Controller;
use App\Models\Partners;
use Illuminate\Http\Request;

class ReportSellingController extends Controller
{
    public function index(){
        $partner = Partners::all();
        return view('admin.selling.report.index', ['partner' => $partner]);
    }
}
