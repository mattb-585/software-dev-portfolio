<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ['price', 'product_id'];

    public function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
