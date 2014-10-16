<?php
Route::get('/', ['as' => 'home.index', 'uses' => 'HomeController@index']);

// Confide routes
Route::get('auth/create', ['as' => 'auth.create', 'uses' => 'AuthController@create']);
Route::post('auth',       ['as' => 'auth.store',  'uses' => 'AuthController@store']);
Route::get('auth/login',  ['as' => 'auth.save',   'uses' => 'AuthController@login']);
Route::post('auth/login', ['as' => 'auth.login',  'uses' => 'AuthController@doLogin']);
Route::get('auth/confirm/{code}',         ['as' => 'auth.confirm',            'uses' => 'AuthController@confirm']);
Route::get('auth/forgot_password',        ['as' => 'auth.forgot_password',    'uses' => 'AuthController@forgotPassword']);
Route::post('auth/forgot_password',       ['as' => 'auth.do_forgot_password', 'uses' => 'AuthController@doForgotPassword']);
Route::get('auth/reset_password/{token}', ['as' => 'auth.reset_password',     'uses' => 'AuthController@resetPassword']);
Route::post('auth/reset_password',        ['as' => 'auth.do_reset_password',  'uses' => 'AuthController@doResetPassword']);
Route::get('auth/logout',                 ['as' => 'auth.logout',             'uses' => 'AuthController@logout']);

// Topic routes
Route::get('topic/create',             ['as' => 'topic.create',  'uses' => 'TopicController@create']);
Route::post('topic/store',             ['as' => 'topic.store',   'uses' => 'TopicController@store']);
Route::get('topic/show/{id}',          ['as' => 'topic.show',    'uses' => 'TopicController@show']);
Route::post('topic/comment/{id}',      ['as' => 'topic.comment', 'uses' => 'TopicController@comment']);
Route::get('topic/edit/{id}',          ['as' => 'topic.edit',    'uses' => 'TopicController@edit']);
Route::post('topic/update/{id}',       ['as' => 'topic.update',  'uses' => 'TopicController@update']);
Route::get('topic/vote/{id}/{answer}', ['as' => 'topic.vote',    'uses' => 'TopicController@vote']);

// User routes
Route::get('user/profile/{username}', ['as' => 'user.profile',  'uses' => 'UserController@profile']);
Route::get('user/settings',           ['as' => 'user.settings', 'uses' => 'UserController@settings']);
