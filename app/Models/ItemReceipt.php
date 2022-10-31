<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemReceipt extends Model
{
    protected $connection = 'procurement';
    protected $table = 'item_receipt';
    protected $guarded=['id'];
    use HasFactory;
}
