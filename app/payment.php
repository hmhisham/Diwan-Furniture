<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $guarded = [];

    protected $table = "payments";

    public function Getsupplier()
    {
        return $this->belongsTo('App\suppliers', 'id_suppliers');
    }
}
