<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');




Route::resource('students', 'StudentAPIController');

Route::resource('enrollments', 'EnrollmentAPIController');

Route::resource('professors', 'ProfessorAPIController');

Route::resource('courses', 'CourseAPIController');





Route::resource('sections', 'SectionAPIController');

Route::resource('lectures', 'LectureAPIController');

Route::resource('attendances', 'AttendanceAPIController');


Route::post('attendances/test/{enrollmentId}/{lectureId}/{scanId}', 'AttendanceAPIController@test');


Route::resource('course_enrollments', 'CourseEnrollmentAPIController');

Route::resource('employs', 'EmployAPIController');

Route::get('course_enrollments/getGradeCourse/{studentId}','CourseEnrollmentAPIController@getGradeCourse');
