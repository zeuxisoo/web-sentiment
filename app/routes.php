<?php
Route::get('/',       ['as' => 'home.index',  'uses' => 'HomeController@index']);
Route::get('/hot',    ['as' => 'home.hot',    'uses' => 'HomeController@hot']);
Route::get('/latest', ['as' => 'home.latest', 'uses' => 'HomeController@latest']);

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
Route::get('topic/report/{id}',        ['as' => 'topic.report',  'uses' => 'TopicController@report']);
Route::get('topic/destroy/{id}',       ['as' => 'topic.destroy', 'uses' => 'TopicController@destroy']);

// User routes
Route::get('user/profile/{username}', ['as' => 'user.profile', 'uses' => 'UserController@profile']);
Route::match(['GET', 'POST'], 'user/settings/profile',  ['as' => 'user.settings.profile',  'uses' => 'UserController@settingsProfile']);
Route::match(['GET', 'POST'], 'user/settings/password', ['as' => 'user.settings.password', 'uses' => 'UserController@settingsPassword']);

// OAuth routes
Route::get('oauth/connect/facebook', ['as' => 'oauth.connect.facebook', 'uses' => 'OAuthController@connectWithFacebook']);

// Topic category routes
Route::get('topic/category',        ['as' => 'topic.category.index',           'uses' => 'TopicCategoryController@index']);
Route::get('topic/category/{code}', ['as' => 'topic.category.index_with_code', 'uses' => 'TopicCategoryController@index']);

// Topic tags routes
Route::get('topic/tags',        ['as' => 'topic.tags.index',           'uses' => 'TopicTagsController@index']);
Route::get('topic/tags/{slug}', ['as' => 'topic.tags.index_with_slug', 'uses' => 'TopicTagsController@index']);

// Search routes
Route::get('search',        ['as' => 'search.index',  'uses' => 'SearchController@index']);
Route::post('search',       ['as' => 'search.index',  'uses' => 'SearchController@index']);
Route::get('search/result', ['as' => 'search.result', 'uses' => 'SearchController@result']);

// Message routes
Route::get('message',                     ['as' => 'message.index',  'uses' => "MessageController@index"]);
Route::get('message/create',              ['as' => 'message.create', 'uses' => "MessageController@create"]);
Route::post('message/store',              ['as' => 'message.store',  'uses' => "MessageController@store"]);
Route::get('message/show/{message_id}',   ['as' => 'message.show',   'uses' => "MessageController@show"]);
Route::get('message/delete/{message_id}', ['as' => 'message.delete', 'uses' => "MessageController@delete"]);
Route::get('message/unread/{message_id}', ['as' => 'message.unread', 'uses' => "MessageController@unread"]);

// Bookmark routes
Route::get('bookmark/index',              ['as' => 'bookmark.index',   'uses' => "BookmarkController@index"]);
Route::get('bookmark/create/{topic_id}',  ['as' => 'bookmark.create',  'uses' => "BookmarkController@create"]);
Route::get('bookmark/destory/{topic_id}', ['as' => 'bookmark.destory', 'uses' => "BookmarkController@destory"]);

// API routes
Route::api(['version' => 'v1', 'prefix' => 'api'], function() {
    Route::post('auth/login', ['as' => 'api.auth.login',  'uses' => 'AuthAPIController@login']);
    Route::get('auth/logout', ['as' => 'api.auth.logout', 'uses' => 'AuthAPIController@logout']);
});
