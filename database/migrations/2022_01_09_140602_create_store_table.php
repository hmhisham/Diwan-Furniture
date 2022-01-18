<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store', function (Blueprint $table) {
            $table->id();
            $table->foreignId('items_id')->references('id')->on('items')->cascadeOnDelete();
            $table->foreignId('containers_id')->references('id')->on('containers')->cascadeOnDelete();
            $table->integer('item_qty');
            $table->integer('item_remaining');
            $table->integer('item_price');
            $table->integer('item_cost');
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
        Schema::dropIfExists('store');
    }
}
