<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_category');
            $table->string('item_company');
            $table->string('item_model');            
            $table->string('item_name');
            $table->string('item_code')->nullable();
            $table->string('item_color')->nullable();
            $table->decimal('item_sale_price', 10, 2)->nullable();
            $table->integer('less_qty')->nullable();
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
        Schema::dropIfExists('items');
    }
}
