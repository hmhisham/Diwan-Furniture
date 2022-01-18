<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $guarded = [];

    protected $table = "items";

    /* public function section()
    {
        return $this->belongsTo('App\store');
    } */
}
