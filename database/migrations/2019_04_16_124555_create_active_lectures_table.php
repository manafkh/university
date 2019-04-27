<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActiveLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('active_lectures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lecture_id')->unsigned();
            $table->integer('next_scan_id');

            $table->foreign('lecture_id')->references('id')->on('lectures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('active_lectures');
    }
}
