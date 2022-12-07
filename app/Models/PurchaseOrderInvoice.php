<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderInvoice extends Model
{
    protected $connection = 'procurement';
    protected $table = 'purchase_order_invoices';
    use HasFactory;
}
