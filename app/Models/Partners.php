<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partners extends Model
{
    protected $connection = 'masterdata';
    protected $table = 'partners';
    protected $guarded =  ['id'];
    use HasFactory;

    public function partnerType(){
        return $this->hasOne(PartnerType::class, 'id', 'partner_type');
    }
}
