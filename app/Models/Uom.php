<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uom extends Model
{
    protected $table = 'uom';
    protected $guarded = ['id'];
    use HasFactory;
}
