<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
               Schema::create('pegawais', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('kode_pegawai');
            $table->string('nama_pegawai');
            $table->string('phone');
            $table->string('address');
            $table->string('email')->unique();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
}
