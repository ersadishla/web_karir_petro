<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosisi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posisi', function (Blueprint $table) {
            $table->string('poscode', 14);
            $table->string('postitle', 100)->nullable();
            $table->string('dep', 12);
            $table->string('directsuperior', 12)->nullable();
            $table->string('directtitle', 100)->nullable();
            $table->string('jobid', 4)->nullable();
            $table->string('jobtitle', 50)->nullable();
            $table->string('orgcode', 8)->nullable();
            $table->string('regu', 100)->nullable();
            $table->string('seksi', 100)->nullable();
            $table->string('bagian', 100)->nullable();
            $table->string('departemen', 100)->nullable();
            $table->string('kompartemen', 100)->nullable();
            $table->string('direktorat', 100)->nullable();
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
        Schema::dropIfExists('posisi');
    }
}

