<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleInvoicesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_invoices_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_invoices_id')->references('id')->on('sale_invoices')->cascadeOnDelete();
            $table->foreignId('items_id')->references('id')->on('items')->cascadeOnDelete();
            $table->foreignId('store_id')->references('id')->on('store')->cascadeOnDelete();
            $table->integer('sale_quantity');
            $table->decimal('sale_price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_invoices_details');
    }
}
