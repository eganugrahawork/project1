<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerType extends Model
{
    protected $table = 'partner_types';
    protected $guarded = ['id'];
    use HasFactory;
}
