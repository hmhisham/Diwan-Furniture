<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_no');
            $table->date('invoice_date');
            $table->foreignId('invoice_customer')->references('id')->on('customers')->cascadeOnDelete();
            $table->string('invoice_phone_1')->nullable();
            $table->string('invoice_phone_2')->nullable();
            $table->text('invoice_address')->nullable();
            $table->decimal('invoice_amount', 10, 2);
            $table->decimal('invoice_discount', 10, 2);
            $table->decimal('invoice_amount_paid', 10, 2);
            $table->decimal('invoice_remaining_amount', 10, 2);
            $table->string('invoice_exchange_rate');
            $table->foreignId('create_by')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('sale_invoices');
    }
}
