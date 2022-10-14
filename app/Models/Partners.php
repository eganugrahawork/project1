<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partners extends Model
{
    protected $table = 'partners';
    protected $guarded =  ['id'];
    use HasFactory;
}
