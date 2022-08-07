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

// Route::get('/welcome', function () {
//     return view('welcome');
// });
Route::get('/password/newset/{code}', 'User\Auth\RegisterController@verifyUser')->name('password.newset');
Route::get('/user/email/verify/{code}', 'User\Auth\RegisterController@verifyUser')->name('user.email.verify');
Route::get('/user/email/complete', 'User\Auth\RegisterController@complete')->name('user.register.complete_email');

Route::get('auth/{provider}', 'User\Auth\SocialController@redirect');
Route::get('auth/{provider}/callback', 'User\Auth\SocialController@callback');
