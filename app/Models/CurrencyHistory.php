<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyHistory extends Model
{
    protected $connection = 'masterdata';
    protected $table = 'currency_history';
    protected $guarded = ['id'];
    use HasFactory;




}
