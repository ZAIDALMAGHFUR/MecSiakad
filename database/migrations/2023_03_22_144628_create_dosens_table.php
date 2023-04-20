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
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->string('kode_dosen');
            $table->string('nama_dosen');
            $table->string('nidn');
            $table->string('email');
            $table->foreignId('users_id')->constrained();
            $table->string('no_hp');
            $table->string('alamat');
            $table->enum('status', ['aktif','tidak aktif','pensiun','keluar']);
            $table->string('tempat_lahir');
            $table->string('agama');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['laki-laki','perempuan']);
            $table->foreignId('program_studies_id')->constrained();
            $table->text('photo')->nullable();
            $table->string('pendidikan_terakhir');
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
        Schema::dropIfExists('dosen');
    }
};
