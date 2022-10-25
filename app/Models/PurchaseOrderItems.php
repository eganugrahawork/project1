<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItems extends Model
{
    protected $connection = 'procurement';
    protected $table = 'purchase_order_items';
    protected $guarded = ['id'];
    use HasFactory;
}
