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
        Schema::create('bobot_nilais', function (Blueprint $table) {
            $table->id();
            $table->string('nama_rentang_nilai');
            $table->integer('rentang_nilai');
            $table->string('huruf_nilai');
            $table->integer('bobot_nilai');
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
        Schema::dropIfExists('bobot_nilais');
    }
};
