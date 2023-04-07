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
        Schema::create('fotos', function (Blueprint $table) {
            $table->id();
            $table->string('foto_kampus')->nullable();
            $table->string('foto_kampus2')->nullable();
            $table->string('foto_kampus3')->nullable();
            $table->string('foto_kampus4')->nullable();
            $table->string('foto_kampus5')->nullable();
            $table->string('foto_kampus6')->nullable();
            $table->string('foto_kampus7')->nullable();
            $table->string('foto_kampus8')->nullable();
            $table->string('foto_kampus9')->nullable();
            $table->string('foto_kampus10')->nullable();
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
        Schema::dropIfExists('fotos');
    }
};
