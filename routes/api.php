<?php

use Illuminate\Http\Request;


Route::get('schools', "WebUntisController@GetSchools");
Route::get('teachers', "WebUntisController@GetTeachers");
Route::get('subjects', "WebUntisController@GetSubjects");
Route::get('departments', "WebUntisController@GetDepartments");
Route::get('students', "WebUntisController@GetStudents");
Route::get('groups', "WebUntisController@GetGroups");
Route::get('users', "WebUntisController@GetUsers");
Route::get('usergroups', "WebUntisController@GetUserGroups");

Route::post('login', 'Api\LoginController@store');
Route::post('create-user', 'Api\LoginController@createUser');

Route::get('lessons', "WebUntisController@GetLessons");
Route::get('lessons/weekly', "WebUntisController@GetLessonsWeekly");
Route::get('lessons/weekly/{week}/{year}', "WebUntisController@GetLessonsWeekly");

Route::get('lessons/monthly', "WebUntisController@GetLessonsMonthly");
Route::get('lessons/monthly/{month}/{year}', "WebUntisController@GetLessonsMonthly");

Route::get('lessons/periode/{start}/{end}', "WebUntisController@GetLessonsPeriode");

Route::get('message', 'Api\AbsenceMessageController@Index');
Route::get('message/{id}', 'Api\AbsenceMessageController@Show');
Route::post('message', 'Api\AbsenceMessageController@Store');

Route::get('attendance', 'Api\AttendanceController@Index');
Route::get('attendance/{id}', 'Api\AttendanceController@Show');
Route::get('attendance/user/{id}', 'Api\AttendanceController@ByUser');
Route::get('attendance/user/{id}/weekly', 'Api\AttendanceController@ByUserWeekly');
Route::get('attendance/user/{id}/weekly/{week}/{year}', 'Api\AttendanceController@ByUserWeekly');
Route::get('attendance/user/{id}/monthly', 'Api\AttendanceController@ByUserMonthly');
Route::get('attendance/user/{id}/monthly/{month}/{year}', 'Api\AttendanceController@ByUserMonthly');
Route::post('attendance', 'Api\AttendanceController@Store');
Route::put('attendance', 'Api\AttendanceController@Update');
Route::put('attendance-accept', 'Api\AttendanceController@AcceptAttendance');
Route::put('attendance-decline', 'Api\AttendanceController@DeclineAttendance');

Route::post('test', function() {
	\Log::info(request()->all());

	return response()->json(['status' => 'ok']);
});
