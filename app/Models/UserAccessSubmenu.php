<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccessSubmenu extends Model
{
    protected $guarded =['id'];
    use HasFactory;

    public function usersubmenu(){
        return $this->hasOne(UserSubmenu::class, 'id', 'id_submenu');
    }
}
