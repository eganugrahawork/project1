<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccessMenu extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function UserMenu(){
        return $this->hasOne(UserMenu::class, 'id', 'id_menu');
    }
}
