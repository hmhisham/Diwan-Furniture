<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleInvoicesDetails extends Model
{
    protected $guarded = [];

    protected $table = "sale_invoices_details";

    public function GetItemsInfo()
    {
        return $this->belongsTo('App\Items', 'items_id');
    }
}
