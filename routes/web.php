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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware' => ['auth:web']],function(){
    Route::resource('lessons','LessonController');
    Route::get('lesson/active/{id}','LessonController@active')->name('active.lesson');
    Route::get('lesson/inactive/{id}','LessonController@inactive')->name('inactive.lesson');
    Route::resource('sessions','SessionController');
    Route::get('session/active/{id}','SessionController@active')->name('active.session');
    Route::get('session/inactive/{id}','SessionController@inactive')->name('inactive.session');
    Route::get('download/file/{id}','SessionController@downloadFile');
    Route::get('download/video/{id}','SessionController@downloadVideo');
    Route::resource('exam_infos','ExaminfoController');
//    Route::get('exam_info/active/{id}','ExaminfoController@active')->name('active.exam_info');
//    Route::get('exam_info/inactive/{id}','ExaminfoController@inactive')->name('inactive.exam_info');
    Route::resource('questions','QuestionController');
    Route::get('questions/show_questions/{id}','QuestionController@showQuestion')->name('questions.showQuestion');
    Route::get('questions/question_create/{id}','QuestionController@createQuestion')->name('questions.createQuestion');
    Route::resource('response_forums','ResponseForumController',['except' => 'create']);
    Route::get('response_forums/create/{id}','ResponseForumController@create')->name('response_forums.create');
    Route::get('download/forum_file/{id}','ResponseForumController@downloadFile');
    Route::resource('workbooks','WorkBookController');
    Route::resource('roles','RoleController');

});
Route::group(['namespace'=>'Front','middleware' => ['auth:web']],function (){
    Route::resource('/','FrontController');
    Route::get('details/{id}','FrontController@details')->name('details');
    Route::get('details/download/file/{id}','FrontController@downloadFile');
    Route::get('details/download/video/{id}','FrontController@downloadVideo');
    Route::get('details/show_answer/{lesson_id}/{id}','AnswerController@showAnswer')->name('showAnswer');
    Route::resource('forum','ForumController',['except' => 'create']);
    Route::get('forums/create/{id}','ForumController@create')->name('forums.create');
    Route::get('forum/details/{id}','ForumController@details')->name('forum.details');
    Route::get('/details/download/response_forum_file/{id}','ForumController@downloadFile');

    Route::resource('answer','AnswerController');
    Route::get('result/{lesson_id}/{id}','AnswerController@result')->name('result');
    Route::get('view/{lesson_id}/{id}','AnswerController@view')->name('view');

});
Route::group(['middleware' => ['auth:web']],function () {
    Route::resource('profile','ProfileController');
});
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register','Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');


// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('/home', 'HomeController@index')->name('home');
