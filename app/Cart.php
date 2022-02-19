<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];

    protected $table = "cart";

    public function GetItem()
    {
        return $this->belongsTo('App\Items', 'items_id');
    }
}
