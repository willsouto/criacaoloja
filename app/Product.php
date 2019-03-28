<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'name', 'stock', 'anchor_price','final_price','image'
    ];




    public function categories()
    {
      return  $this->belongsToMany('App\Category');
    }

}
