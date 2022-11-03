<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordering extends Model
{
    protected $connection = 'masterdata';
    protected $table = 'ordering';
    protected $guarded = ['id'];
    use HasFactory;
}
