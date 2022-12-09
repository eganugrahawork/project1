<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Partners;
use Illuminate\Http\Request;

class ReportInventoryController extends Controller
{
    public function index(){
        $partner = Partners::all();
        return view('admin.inventory.report.index', ['partner' => $partner]);
    }
}
