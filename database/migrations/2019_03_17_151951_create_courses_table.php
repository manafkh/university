<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoursesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('term_id')->unsigned();
            $table->integer('year_id')->unsigned();
            $table->string('title')->unique();
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('term_id')->references('id')->on('terms');
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
        Schema::drop('courses');
    }
}
