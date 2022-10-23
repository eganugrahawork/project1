<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceHistory extends Model
{
    protected $connection = 'masterdata';
    protected $table = 'price_history';
    protected $guarded = ['id'];
    use HasFactory;
}
