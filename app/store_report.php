<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class store_report extends Model
{
    protected $guarded = [];
    
    protected $table = "store";

    public function GetItemsDit()
    {
        return $this->belongsTo('App\Items', 'items_id');
    }
}
