<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $guarded = [];

    protected $table = "items";

    public function GetItemInStore()
    {
        return $this->belongsTo('App\Store', 'items_Id');
    }
}
