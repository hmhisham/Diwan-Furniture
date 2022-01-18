<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Containers extends Model
{
    protected $guarded = [];

    protected $table = "containers";

    public function GetItemsFromStore()
    {
        return $this->hasMany('App\Store');
    }

    public function GetSupplier()
    {
        return $this->belongsTo('App\Suppliers', 'cont_supplier');
    }
}
