<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengguna extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id('id_pengguna');
            $table->foreignId('id_peran');
            $table->string('nama', 100);
            $table->string('username', 100)->unique();
            $table->string('password');
            $table->string('email', 100)->unique()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_peran')->references('id_peran')->on('peran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengguna');
    }
}
