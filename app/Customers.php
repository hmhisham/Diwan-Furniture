<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $guarded = [];

    protected $table = "customers";

    public function GetCustomerPayments()
    {
        return $this->hasMany('App\CustomersPayments');
    }
}
