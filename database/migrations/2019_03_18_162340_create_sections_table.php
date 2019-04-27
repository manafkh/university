<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSectionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned();
            $table->integer('professor_id')->unsigned();
            $table->integer('schedule_id')->unsigned();
            $table->string('Room');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('schedule_id')->references('id')->on('schedules');
            $table->foreign('professor_id')->references('id')->on('professors');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sections');
    }
}
