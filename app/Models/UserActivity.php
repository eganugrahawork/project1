<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function users(){
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
