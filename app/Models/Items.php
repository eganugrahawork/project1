<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';
    protected $guarded = ['id'];
    use HasFactory;

    public function Uom(){
        return $this->hasOne(Uom::class, 'id', 'uom_id');
    }
    public function Principal(){
        return $this->hasOne(Principal::class, 'id', 'partner_id');
    }
}
