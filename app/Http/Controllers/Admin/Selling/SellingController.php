<?php

namespace App\Http\Controllers\Admin\Selling;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SellingController extends Controller
{
    public function index(){
        $year_count = date('Y') - 2019;
        $years = ['All'];

        for ($i = $year_count; $i >= 0; $i--) {

          $y = 2019 + $i;

          array_push($years, $y);
        }
        $month =  array('All', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        return view('admin.selling.selling.index', ['month' => $month, 'years' => $years]);
    }
}
