<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customers_id')->references('id')->on('customers')->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->date('date');
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
        Schema::dropIfExists('customers_payments');
    }
}
