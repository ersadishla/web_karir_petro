<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->string('nik', 10);
            $table->string('nik_sap', 10);
            $table->string('nama', 100)->nullable();
            $table->string('eselon', 100)->nullable();
            $table->string('p_grade', 3)->nullable();
            $table->string('job_grade', 3)->nullable();
            $table->string('grade_sap', 3)->nullable();
            $table->string('statuspegawai', 20)->nullable();
            $table->string('nm_jabatan', 100)->nullable();
            $table->string('jabatan', 50)->nullable();
            $table->string('kode_unitkerja', 8)->nullable();
            $table->string('kode_dir', 8)->nullable();
            $table->string('kode_komp', 8)->nullable();
            $table->string('kode_dept', 8)->nullable();
            $table->string('kode_bagian', 8)->nullable();
            $table->string('kode_seksi', 8)->nullable();
            $table->string('direktorat', 100)->nullable();
            $table->string('kompartemen', 100)->nullable();
            $table->string('departemen', 100)->nullable();
            $table->string('bagian', 100)->nullable();
            $table->string('seksi', 100)->nullable();
            $table->string('regu', 100)->nullable();
            $table->string('poscode', 14);
            $table->string('postitle', 100)->nullable();
            $table->string('alamat', 200)->nullable();
            $table->string('kelurahan', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('kabupaten', 100)->nullable();
            $table->string('propinsi', 100)->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->string('tmp_lahir', 100)->nullable();
            $table->dateTime('tgl_lahir')->nullable();
            $table->string('agama', 20)->nullable();
            $table->string('lp', 10)->nullable();
            $table->string('pendidikan', 100)->nullable();
            $table->string('jurusan', 100)->nullable();
            $table->string('institusi', 100)->nullable();
            $table->string('pend_akhir', 100)->nullable();
            $table->dateTime('tgl_masuk')->nullable();
            $table->timestamps();

            // $table->foreign('poscode')->references('poscode')->on('posisi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
}
