<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnItems extends Model
{
    protected $guarded = [];

    protected $table = "return_items";

    public function GetItemsInfo()
    {
        return $this->belongsTo('App\Items', 'items_id');
    }
}
