<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['productDescription', 'price', 'quantity', 'productTotal'];
}
