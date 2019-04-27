<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScheduleTasksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start_academicYear');
            $table->date('end_academicYear');
            $table->date('start_enroll');
            $table->date('end_enroll');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schedule_tasks');
    }
}
