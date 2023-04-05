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
        Schema::create('pemimpin', function (Blueprint $table) {
            $table->id();
            $table->string('nama ketua yayan');
            $table->string('foto ketua yayan');
            $table->string('nama ketua kampus');
            $table->string('foto ketua kampus');
            $table->string('nama wakil ketua 1');
            $table->string('foto wakil ketua 1');
            $table->string('nama wakil ketua 2');
            $table->string('foto wakil ketua 2');
            $table->string('nama wakil ketua 3');
            $table->string('foto wakil ketua 3');
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
        Schema::dropIfExists('pemimpin');
    }
};
