<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = ['firstName', 'lastName', 'address', 'addressTwo', 'city', 'state', 'zip', 'phone', 'email', 'comments'];
}
