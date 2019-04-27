<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttendancesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enrollment_id')->unsigned();
            $table->integer('lecture_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('enrollment_id')->references('id')->on('enrollments');
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
        Schema::drop('attendances');
    }
}
