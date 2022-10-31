<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutation extends Model
{
    protected $connection = 'inventory';
    protected $table = 'mutations';

    use HasFactory;
}
