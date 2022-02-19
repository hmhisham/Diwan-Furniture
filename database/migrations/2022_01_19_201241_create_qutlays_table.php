<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQutlaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qutlays', function (Blueprint $table) {
            $table->id();
            $table->integer('qutlays_amount');
            $table->string('qutlays_type');
            $table->date('qutlays_date');
            $table->string('qutlays_by');
            $table->string('qutlays_note')->nullable();
            $table->decimal('qutlays_exchange_rate',10,2);
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
        Schema::dropIfExists('qutlays');
    }
}
