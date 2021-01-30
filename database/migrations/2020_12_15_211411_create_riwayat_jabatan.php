<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatJabatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_jabatan', function (Blueprint $table) {
            $table->string('id', 10);
            $table->string('nik', 10);
            $table->string('nama')->nullable();
            $table->string('unitkerja', 10)->nullable();
            $table->string('jabatan', 4)->nullable();
            $table->string('poscode', 14)->nullable();
            $table->string('nm_jbt', 50)->nullable();
            $table->string('nm_pl', 100)->nullable();
            $table->string('nm_ru', 100)->nullable();
            $table->string('nm_si', 100)->nullable();
            $table->string('nm_bag', 100)->nullable();
            $table->string('nm_dep', 100)->nullable();
            $table->string('nm_kom', 100)->nullable();
            $table->string('nm_dir', 100)->nullable();
            $table->dateTime('ma_tmt')->nullable();
            $table->timestamps();

            // $table->foreign('nik')->references('nik_sap')->on('pegawai');
            // $table->foreign('poscode')->references('poscode')->on('posisi');
            // $table->foreign('unitkerja')->references('unitkerja')->on('unitkerja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_jabatan');
    }
}

