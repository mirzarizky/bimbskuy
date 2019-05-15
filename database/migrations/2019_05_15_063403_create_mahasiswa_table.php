<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nim');
            $table->string('nama');
            $table->string('alamat_ortu');
            $table->string('alamat_kos');
            $table->string('hp_ortu');
            $table->string('hp_mahasiswa');
            $table->string('email');
            $table->string('foto');
            $table->string('krs');
            $table->tinyInteger('tipe_bimbingan');      // 1|2; skrisi|pkl
            $table->string('judul');
            $table->string('nilai')->nullable()->default(null);                    // A|B|C|D|E nullable|default:null
            $table->string('berita_acara')->nullable()->default(null);                    // A|B|C|D|E nullable|default:null
            $table->integer('kode_pembimbing');
            $table->integer('kode_pembimbing_2')->nullable()->default(null);
            $table->integer('kode_pembimbing_3')->nullable()->default(null);
            $table->integer('kode_wali');
            $table->unsignedInteger('departemen_id');
            $table->unsignedInteger('user_id')->nullable()->default(null);
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
        Schema::dropIfExists('mahasiswa');
    }
}
