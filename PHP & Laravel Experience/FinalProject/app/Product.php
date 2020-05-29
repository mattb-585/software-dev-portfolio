<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['image', 'name'];

    public function prices() {
        return $this->hasMany('App\Price');
    }
}
