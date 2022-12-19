<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnSellingDetail extends Model
{
    use HasFactory;
    protected $connection = 'selling';
    protected $table = 'selling_return_details';
    protected $guarded = ['id'];
}
