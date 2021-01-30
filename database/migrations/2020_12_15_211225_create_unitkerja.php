<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitkerja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unitkerja', function (Blueprint $table) {
            $table->string('unitkerja', 10);
            $table->string('nm_unitkerja', 100)->nullable();
            $table->string('parentorgcode', 10)->nullable();
            $table->string('orglevelname', 50)->nullable();
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
        Schema::dropIfExists('unitkerja');
    }
}
