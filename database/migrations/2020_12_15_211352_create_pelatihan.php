<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelatihan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelatihan', function (Blueprint $table) {
            $table->string('company_id', 10)->nullable();
            $table->string('emp_no', 10);
            $table->string('emp_history_no', 8);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('training_event_id', 20)->nullable();
            $table->string('course_id', 10)->nullable();
            $table->string('course_title', 200)->nullable();
            $table->string('training_place', 100)->nullable();
            $table->string('training_location', 50)->nullable();
            $table->string('training_institution_name', 100)->nullable();
            $table->string('jenis', 5)->nullable();
            $table->string('jenis_diklat', 50)->nullable();
            $table->string('kompetensi_inti', 50)->nullable();
            $table->timestamps();

            // $table->foreign('emp_no')->references('nik_sap')->on('pegawai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelatihan');
    }
}

