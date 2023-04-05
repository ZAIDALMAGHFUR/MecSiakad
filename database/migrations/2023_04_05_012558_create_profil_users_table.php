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
        Schema::create('profil_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained();
            $table->string('nama');
            $table->string('email');
            $table->string('foto')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('gender');
            $table->string('no_hp');
            $table->string('alamat');
            $table->string('whatsapp');
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
        Schema::dropIfExists('profil_users');
    }
};
