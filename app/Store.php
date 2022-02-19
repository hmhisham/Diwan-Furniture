<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $guarded = [];
    
    protected $table = "store";

    public function GetItemsDit()
    {
        return $this->belongsTo('App\Items', 'items_id');
    }

    public function GetLastItemsDit()
    {
        return $this->belongsTo('App\Items', 'items_id')->orderBy('id', 'DESC');
    }

    public function GetContainer()
    {
        return $this->belongsTo('App\Containers', 'containers_id');
    }
}
