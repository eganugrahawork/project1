<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $connection = 'masterdata';
    protected $table = 'items';
    protected $guarded = ['id'];
    use HasFactory;

    public function Uom(){
        return $this->hasOne(Uom::class, 'id', 'uom_id');
    }
    public function Partner(){
        return $this->hasOne(Partners::class, 'id', 'partner_id');
    }

    // public function PriceHistory(){
    //     return $this->hasOne(PriceHistory::class, 'items_id', 'id');
    // }
}
