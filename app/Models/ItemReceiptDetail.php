<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemReceiptDetail extends Model
{
    protected $connection = 'procurement';
    protected $table = 'items_receipt_details';
    use HasFactory;
}
