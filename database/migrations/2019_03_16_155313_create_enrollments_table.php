<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnrollmentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('year_id')->unsigned();
            $table->year('enroll_year')->default(date('Y'));
            $table->integer('ExamNumber')->default(0);

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('year_id')->references('id')->on('years');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('enrollments');
    }
}
