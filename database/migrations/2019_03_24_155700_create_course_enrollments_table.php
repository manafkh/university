<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCourseEnrollmentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_enrollment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enrollment_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->integer('term_id')->unsigned()->nullable();
            $table->integer('mid_grade')->nullable();
            $table->integer('th_Grade')->nullable();
            $table->integer('final_Grade')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('enrollment_id')->references('id')->on('enrollments');
            $table->foreign('course_id')->references('id')->on('courses');
//           $table->foreign('term_id')->references('id')->on('terms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('course_enrollment');
    }
}
