<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellingDetail extends Model
{
    use HasFactory;
    protected $connection = 'selling';
    protected $table = 'selling_details';
    protected $guarded = ['id'];
}
