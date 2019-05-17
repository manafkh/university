<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Enums\TermCourseStatus;

class CreateTermCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('course_id')->unsigned();
            $table->integer('term_id')->unsigned();
            $table->year('academic_year')->default(date('Y'));
            $table->tinyInteger('status')->default(TermCourseStatus::INIT);
            $table->timestamps();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('term_id')->references('id')->on('terms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('term_courses');
    }
}
