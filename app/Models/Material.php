<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function Uom(){
        return $this->hasOne(Uom::class, 'id_uom', 'unit_terkecil');
    }
    public function eksternal(){
        return $this->hasOne(Eksternal::class, 'id', 'dist_id');
    }
}
