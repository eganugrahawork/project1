<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomAccessBlock extends Model
{
    protected $connection = 'masterdata';
    protected $guarded = ['id'];
    use HasFactory;
}
