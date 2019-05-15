<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiBimbinganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_bimbingan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nim');
            $table->tinyInteger('jenis_bimbingan'); // 1|2 ; skripsi|pkl
            $table->string('uraian_materi');
            $table->integer('prosentase')->nullable()->default(null);
            $table->timestamp('approved_at')->nullable()->default(null);
            $table->unsignedInteger('kode_pembimbing');
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
        Schema::dropIfExists('transaksi_bimbingan');
    }
}
