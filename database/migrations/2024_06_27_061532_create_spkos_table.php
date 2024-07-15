<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spkos', function (Blueprint $table) {
            $table->id();
            $table->text('remarks');
            $table->integer('employee');
            $table->date('trans_date');
            $table->string('process', length: 10);
            $table->string('sw', length: 25);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spkos');
    }
};
