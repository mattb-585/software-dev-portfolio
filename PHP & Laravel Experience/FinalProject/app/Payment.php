<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['shippingCost', 'cardType', 'cardNumber', 'expirationMonth', 'expirationYear', 'subtotal', 'total'];
}
