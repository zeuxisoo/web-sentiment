<?php
Route::get('/', 'HomeController@index');

// Confide routes
Route::get('auth/create', 'AuthController@create');
Route::post('auth', 'AuthController@store');
Route::get('auth/login', 'AuthController@login');
Route::post('auth/login', 'AuthController@doLogin');
Route::get('auth/confirm/{code}', 'AuthController@confirm');
Route::get('auth/forgot_password', 'AuthController@forgotPassword');
Route::post('auth/forgot_password', 'AuthController@doForgotPassword');
Route::get('auth/reset_password/{token}', 'AuthController@resetPassword');
Route::post('auth/reset_password', 'AuthController@doResetPassword');
Route::get('auth/logout', 'AuthController@logout');

// Topic routes
Route::get('topic/create', 'TopicController@create');
Route::post('topic/store', 'TopicController@store');
Route::get('topic/show/{id}', 'TopicController@show');
Route::post('topic/comment/{id}', 'TopicController@comment');
Route::get('topic/edit/{id}', 'TopicController@edit');
Route::post('topic/update/{id}', 'TopicController@update');
Route::get('topic/vote/{id}/{choice}', 'TopicController@vote');
