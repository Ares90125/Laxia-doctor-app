<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'AuthController@logout');
    Route::get('/user', 'AuthController@me');
});

// テスト用
Route::get('/test/mailboxes/{id}/reservation', 'Test\MailboxController@getReservation');
Route::get('/test/mailboxes/{id}/messages', 'Test\MailboxController@getMessages');
Route::post('/test/mailboxes/{id}/messages', 'Test\MailboxController@addMessage');
Route::post('/test/mailboxes/{id}/fileupload', 'Test\MailboxController@uploadMessageFile');
Route::post('/test/mailboxes/{id}/updateFirebaseKey', 'Test\MailboxController@updateFirebaseKey');
Route::get('/test/mailboxes/{id}/getFirebaseKey', 'Test\MailboxController@getFirebaseKey');