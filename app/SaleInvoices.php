<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleInvoices extends Model
{
    protected $guarded = [];

    protected $table = "sale_invoices";

    public function GetCustomer()
    {
        return $this->belongsTo('App\Customers', 'invoice_customer');
    }
}
