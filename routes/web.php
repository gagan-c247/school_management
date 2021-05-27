<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

    // Auth::routes();
Route::get('/login/admin','Auth\LoginController@showAdminLogin');
Route::get('/login/student', 'Auth\LoginController@showStudentLoginForm');
Route::get('/login/teacher', 'Auth\LoginController@showTeacherLoginForm');
Route::get('/register/student', 'Auth\RegisterController@showStudentRegisterForm');
Route::get('/register/teacher', 'Auth\RegisterController@showTeacherRegisterForm');

Route::post('/login/admin','Auth\LoginController@adminLogin');
Route::post('/login/student', 'Auth\LoginController@studentLogin');
Route::post('/login/teacher', 'Auth\LoginController@teacherLogin');
Route::post('/register/student', 'Auth\RegisterController@createStudent');
Route::post('/register/teacher', 'Auth\RegisterController@createTeacher');

//=================================================
/***********START Routes For Teacher***************/
//=================================================
// ['domain'=>'teacher.','prefix'=>'teacher','middleware' => 'auth:teacher'],
Route::middleware('auth:teacher')->name('teacher.')->prefix('teacher')->group( function () {
    Auth::routes();
    Route::view('/', 'teacher.teacher');
    Route::resource('/profile','Teacher\ProfileController');
});
//=================================================
/**************END Routes For Teacher*************/
//=================================================
/*************************************************/
//=================================================
/**************START Routes For Student***********/
//=================================================
Route::group(['prefix'=>'student','middleware' => 'auth:student'], function () {
Auth::routes();

Route::view( '/','student.student'); 
Route::resource('/profile','Student\ProfileController');

});

//=================================================
/*************END Routes For Student***************/
//=================================================
/**************************************************/
//=================================================
/****************START Routes For ADMIN************/
//=================================================

Route::middleware('auth:web')->name('admin.')->group(function () {
    Auth::routes(); 
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/home/user','Backend\UserController');
    Route::resource('/home/student','Backend\StudentController');
    Route::get('/home/student/family/{id}','Backend\StudentController@showFamily')->name('family');
    Route::get('/home/student/guardian/{id}','Backend\StudentController@showGuardian')->name('guardian');
    Route::resource('/home/teacher','Backend\TeacherController');
    Route::resource('/home/course','Backend\CourseController');
    Route::resource('/home/role','Backend\RoleController');
    Route::resource('/home/permission','Backend\PermissionController');
    Route::post('/home/role/permissionSearch','Backend\RoleController@permissionSearch')->name('permissionSearch');

    Route::resource('/home/fileupload','Backend\FileUploadController');
    Route::get('/home/fileupload/delete/{id}','Backend\FileUploadController@delete')->name('delete');

    Route::resource('/home/posts','Backend\PostController');
});
//=================================================
/****************END Routes For Admin************/
//=================================================
