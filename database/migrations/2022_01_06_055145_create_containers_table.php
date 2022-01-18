<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->string('cont_no');
            $table->date('cont_date');
            $table->foreignId('cont_supplier')->references('id')->on('suppliers')->cascadeOnDelete();
            $table->string('cont_amount')->nullable();
            $table->string('cont_type_supply');
            $table->string('cont_out_expenses')->nullable();
            $table->string('cont_customs')->nullable();
            $table->string('cont_in_expenses')->nullable();
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
        Schema::dropIfExists('containers');
    }
}
