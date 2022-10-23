<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAccess extends Model
{
    protected $connection = 'masterdata';
    protected $table='menu_access';
    protected $guarded = ['id'];
    use HasFactory;

    public function menu(){
        return $this->hasOne(Menu::class, 'id', 'menu_id');
    }
}
