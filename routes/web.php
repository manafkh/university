<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Events\QRScanned;
use App\Models\Lecture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/blog', function () {
    return view('blog');
});


Route::get('interface/',function (){
    return view('interface.index');
})->name('interface.index');

Route::get('interface/about',function (){
    return view('interface.about');
})->name('interface.about');

Route::get('interface/course','CourseController@ShowCourses')->name('interface.course');

Route::get('interface/event',function (){
    return view('interface.event');
})->name('interface.event');

Route::get('interface/teacher','ProfessorController@showProfessor')->name('interface.teacher');

Route::get('interface/teacher-single',function (){
    return view('interface.teacher-single');
})->name('interface.teacher-single');

Route::get('interface/blog',function (){
    return view('interface.blog');
})->name('interface.blog');

Route::get('interface/blog-single',function (){
    return view('interface.blog-single');
})->name('interface.blog-single');

Route::get('interface/contact',function (){
    return view('interface.contact');
})->name('interface.contact');









Route::get('Profile/{id}','HomeController@edit')->name('Profile');
Route::patch('Profile/{id}/update','HomeController@update')->name('Profile.update');
Route::get('enrollments/giveSuccess','CourseEnrollmentController@giveSuccess')->name('enrollments.giveSuccess');

Auth::routes();


Route::get('/home', 'HomeController@index');

//Route::get('enrollments/enroll', 'EnrollmentController@enroll');

Route::group(['Middleware'=>'auth'], function () {

    Route::get('students/select', 'StudentController@select')->name('students.select');
    Route::get('enrollments/give', 'EnrollmentController@give')->name('enrollments.give');
    Route::get('enrollments.enroll', 'EnrollmentController@enroll')->name('enrollments.enroll');
    Route::get('course_enrollments/select_course', 'CourseEnrollmentController@select_course')->name('course_enrollments.select_course');
    Route::get('course_enrollments/exam/{id}', 'CourseEnrollmentController@exam')->name('course_enrollments.exam');
    Route::get('course_enrollments/export/{id}', 'CourseEnrollmentController@export')->name('course_enrollments.export');
    Route::get('course_enrollments/exportMid/{id}', 'CourseEnrollmentController@exportMid')->name('course_enrollments.exportMid');
    Route::get('course_enrollments/exportTh/{id}', 'CourseEnrollmentController@exportTh')->name('course_enrollments.exportTh');
    Route::post('course_enrollments/import/{id}', 'CourseEnrollmentController@import')->name('course_enrollments.import');
    Route::post('course_enrollments/importTh', 'CourseEnrollmentController@importTh')->name('course_enrollments.importTh');
    Route::post('course_enrollments/importMid', 'CourseEnrollmentController@importMid')->name('course_enrollments.importMid');
    Route::resource('students', 'StudentController');
    Route::group(['middleware'=>'checkEmploy'], function (){





    });

    Route::resource('professors', 'ProfessorController');

    Route::resource('schedules', 'ScheduleController');
    Route::resource('enrollments', 'EnrollmentController');



    Route::resource('courses', 'CourseController');


    Route::resource('sections', 'SectionController');



//Route::get('courses', 'CourseController@git');

    Route::get('attendances/registared', function (){

        return view('attendances.registared');
    });


    Route::get('/confirm', function () {
        return view('confirm');
    });

    Route::group(['middleware'=>'checkProfessor'], function () {





});
    Route::resource('lectures', 'LectureController');
    Route::get('lectures/selectLecturesCourse/{id}', 'LectureController@selectLecturesCourse')->name('lectures.selectLecturesCourse');
    Route::resource('attendances', 'AttendanceController');

    Route::get('attendances/showAttendance/{id}', 'AttendanceController@attendances')->name('attendances.showAttendance');

    Route::resource('courseEnrollments', 'CourseEnrollmentController');
    Route::group(['middleware'=>'checkAdmin'], function (){

    });


});
Route::resource('years', 'YearController');
Route::resource('scheduleTasks', 'ScheduleTaskController');
Route::resource('terms', 'TermController');

Route::resource('roles', 'RoleController');

Route::get('/confirm/{id}', 'EnrollmentController@GetConfirm');
Route::post('/confirm/{id}', 'EnrollmentController@PostConfirm')->name('confirm');
Route::get('/confirm/{id}', 'ProfessorController@GetConfirm');
Route::post('/confirm/{id}', 'ProfessorController@PostConfirm')->name('confirm');

Route::resource('employs', 'EmployController');

Route::get('weekly/FirstYear/{id}','SectionController@weekly')->name('weekly.FirstYear');
Route::get('weekly/year','SectionController@year')->name('weekly.year');