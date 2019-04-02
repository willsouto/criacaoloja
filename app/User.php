<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $fillable = [
        'name', 'email',
    ];




    public function order(){
        return $this->hasMany('App\Order', 'user_id');
    }
}
