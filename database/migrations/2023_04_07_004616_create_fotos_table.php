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
            $table->string('foto_kampus');
            $table->string('foto_kampus2');
            $table->string('foto_kampus3');
            $table->string('foto_kampus4');
            $table->string('foto_kampus5');
            $table->string('foto_kampus6');
            $table->string('foto_kampus7');
            $table->string('foto_kampus8');
            $table->string('foto_kampus9');
            $table->string('foto_kampus10');
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
