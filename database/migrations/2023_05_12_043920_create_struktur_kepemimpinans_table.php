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
        Schema::create('struktur_kepemimpinans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('pas_foto');
            $table->string('description', 1000)->nullable();
            $table->foreignId('jabatan_id')->references('id')->on('str_jabatans')->constrained();
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
        Schema::dropIfExists('struktur_kepemimpinans');
    }
};
