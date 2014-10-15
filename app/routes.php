<?php
Route::get('/', 'HomeController@index');

// Confide routes
Route::get('user/create', 'UserController@create');
Route::post('user', 'UserController@store');
Route::get('user/login', 'UserController@login');
Route::post('user/login', 'UserController@doLogin');
Route::get('user/confirm/{code}', 'UserController@confirm');
Route::get('user/forgot_password', 'UserController@forgotPassword');
Route::post('user/forgot_password', 'UserController@doForgotPassword');
Route::get('user/reset_password/{token}', 'UserController@resetPassword');
Route::post('user/reset_password', 'UserController@doResetPassword');
Route::get('user/logout', 'UserController@logout');

// Topic routes
Route::get('topic/create', 'TopicController@create');
Route::post('topic/store', 'TopicController@store');
Route::get('topic/show/{id}', 'TopicController@show');
Route::post('topic/comment/{id}', 'TopicController@comment');
Route::get('topic/edit/{id}', 'TopicController@edit');
Route::post('topic/update/{id}', 'TopicController@update');
Route::get('topic/vote/{id}/{choice}', 'TopicController@vote');
