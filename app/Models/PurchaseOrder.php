<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $connection = 'procurement';
    protected $table = 'purchase_orders';
    protected $guarded = ['id'];
    use HasFactory;

    public function partnernya(){
        return $this->hasOne(Partners::class, 'id', 'partner_id');
    }

}
