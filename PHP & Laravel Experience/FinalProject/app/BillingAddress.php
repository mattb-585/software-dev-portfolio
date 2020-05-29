<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    protected $fillable = ['firstName', 'lastName', 'address', 'addressTwo', 'city', 'state', 'zip', 'phone', 'email'];
}
