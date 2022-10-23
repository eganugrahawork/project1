<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coa extends Model
{
    protected $connection = 'masterdata';
    protected $table ='coa';
    protected $guarded=['id'];
    use HasFactory;
}
