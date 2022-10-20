<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeItems extends Model
{
    protected $table = 'item_types';
    protected $guarded =['id'];
    use HasFactory;
}
