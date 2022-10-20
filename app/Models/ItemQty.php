<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemQty extends Model
{
    protected $table = 'item_qty';
    protected $guarded = ['id'];
    use HasFactory;

    public function item(){
        return $this->hasOne(Items::class, 'id', 'item_id');
    }
}
