<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| クリニック Routes
|--------------------------------------------------------------------------
|
| Here is where you can register SPA routes for your frontend. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "spa" middleware group.
|
*/

Route::group(['middleware' => 'guest:api'], function () {
  Route::post('login', 'Auth\LoginController@login');
  Route::post('register', 'Auth\RegisterController@register');
});

Route::group(['middleware' => ['auth.doctor']], function() {
  Route::get('logout', 'Auth\LoginController@logout');

  Route::get('load/enum', 'MasterDataController@loadEnumData');
  Route::get('load/master', 'MasterDataController@loadMasterData');

  Route::post('id_checker', 'DoctorController@idChecker');

  Route::get('profile', 'ProfileController@get');
  Route::put('profile', 'ProfileController@update');
  Route::get('profile/{id}', 'ProfileController@getProfile');
  Route::post('profile/photoupload', 'ProfileController@uploadPhoto');
  Route::post('update/email', 'ProfileController@updateEmail');
  Route::post('update/password', 'ProfileController@updatePassword');

  // 質問
  Route::post('questions/search', 'QuestionController@search');
  Route::get('questions/{question_id}', 'QuestionController@getDetail');
  Route::get('questions/{question_id}/answers', 'QuestionController@getAnswers');
  Route::post('questions/uploadAnswerPhoto', 'QuestionController@uploadAnswerPhoto');
  Route::post('questions/{question_id}/answers', 'QuestionController@addAnswer');
  Route::put('questions/{question_id}/answers/{answer_id}', 'QuestionController@updateAnswer');
  Route::delete('questions/{question_id}/answers/{answer_id}', 'QuestionController@deleteAnswer');

  // Case
  Route::post('cases/uploadPhoto', 'DoctorCaseController@uploadPhoto');
  Route::post('/cases/before/photoupload', 'DoctorCaseController@uploadBeforePhoto');
  Route::post('/cases/after/photoupload', 'DoctorCaseController@uploadAfterPhoto');
  Route::post('cases', 'DoctorCaseController@store');
  Route::delete('cases/{id}', 'DoctorCaseController@delete');
  Route::get('cases', 'DoctorCaseController@get');
  Route::get('cases/doctor/{id}', 'DoctorCaseController@getDoctorCases');
  Route::get('cases/{id}', 'DoctorCaseController@getDetail');
  Route::put('cases/{id}', 'DoctorCaseController@update');

  Route::get('clinics', 'ClinicController@get');
});
