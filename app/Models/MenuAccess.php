<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAccess extends Model
{
    protected $table='menu_access';
    protected $guarded = ['id'];
    use HasFactory;
}
