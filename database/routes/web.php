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
require base_path('routes/links/super_admin.php');
require base_path('routes/links/admin.php');



Route::get('/', "AuthController@index")->name('home');
Route::get('sign-in', "AuthController@signIn")->name('signIn');
Route::post('sign-in', "AuthController@signInProcess")->name('signInProcess');
Route::get('forget-password', "AuthController@forgetPassword")->name('forgetPassword');
Route::post('forget-password-email-send', "AuthController@forgetPasswordEmailSendProcess")->name('forgetPasswordEmailSendProcess');
Route::get('reset-password-code', "AuthController@forgetPasswordCode")->name('forgetPasswordCode');
Route::post('reset-password-code', "AuthController@forgetPasswordCodeProcess")->name('forgetPasswordCodeProcess');

Route::group(['middleware' => 'auth'], function () {
    Route::get('password-change', 'AuthController@passwordChange')->name('passwordChange');
    Route::post('password-change-process', 'AuthController@passwordChangeProcess')->name('passwordChangeProcess');
    Route::get('sign-out', 'AuthController@signOut')->name('signOut');
});

