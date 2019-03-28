<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['cat_id','name'];

    public function products(){
       return $this->belongsToMany('App\Product');
    }
}
