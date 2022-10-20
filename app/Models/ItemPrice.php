<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPrice extends Model
{
    protected $table='item_price';
    protected $guarded = ['id'];
    use HasFactory;

    public function item(){
        return $this->hasOne(Items::class, 'id', 'item_id');
    }



}
