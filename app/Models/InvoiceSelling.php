<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceSelling extends Model
{
    use HasFactory;
    protected $connection = 'selling';
    protected $table = 'selling_invoice';
    protected $guarded =['id'];
}
