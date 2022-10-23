<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrudPermission extends Model
{
    protected $connection = 'masterdata';
    protected $table = 'crud_permission';
    protected $guarded =['id'];
    use HasFactory;
}
