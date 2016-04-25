<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group( [ 'middleware' => [ 'web' ] ], function () {
	//
	Route::get( '/', [ 'uses' => 'HomeController@index', 'as'   => 'home'	]);

	Route::get( 'signup', [ 'uses' => 'AuthController@getSignUp', 'as' => 'auth.signup' ] );
	Route::post( 'signup', [ 'uses' => 'AuthController@postSignUp', 'as' => 'auth.signup' ] );

	Route::get( 'signin', [ 'uses' => 'AuthController@getSignIn', 'as' => 'auth.signin' ] );
	Route::post( 'signin', [ 'uses' => 'AuthController@postSignIn', 'as' => 'auth.signin' ] );

	Route::get( 'signout', [ 'uses' => 'AuthController@getSignOut', 'as' => 'auth.signout' ] );

	Route::get( 'user/{username}', [ 'uses' => 'ProfileController@getProfile', 'as' => 'profile.index' ] );

	Route::get( 'profile/edit', [ 'uses' => 'ProfileController@getEdit', 'as' => 'profile.edit' ] );
	Route::post( 'profile/edit', [ 'uses' => 'ProfileController@postEdit', 'as' => 'profile.edit' ] );

	Route::get( 'search', [ 'uses' => 'SearchController@getResults', 'as' => 'search.results' ] );

	Route::get( 'friends', [ 'uses' => 'FriendController@getIndex', 'as' => 'friend.index' ] );
	Route::get( 'friends/add/{username}', [ 'uses' => 'FriendController@getAdd', 'as' => 'friends.add' ] );
	Route::get( 'friends/accept/{username}', [ 'uses' => 'FriendController@getAccept', 'as' => 'friends.accept' ] );
	Route::post('status', [ 'uses' => 'StatusController@postStatus', 'as' => 'status.post' ]);
	Route::post('status/{statusId}/reply', [ 'uses' => 'StatusController@postReply', 'as' => 'status.reply' ]);
	Route::get('/status/{statusId}/like', [ 'uses'	=> 'StatusController@getLike', 'as'	=> 'status.like' ]);
} );
