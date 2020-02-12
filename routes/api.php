<?php

// use Illuminate\Http\Request;
Route::post('test-uploader', 'TestController@testUploader');

Route::post('login', 'API\PassportController@login');
Route::post('register', 'API\PassportController@register');

Route::group(['middleware' => 'auth:api'], function(){
	Route::post('get-details', 'API\PassportController@getDetails');
	//Route::post('get-cardtype', 'API\PassportController@getCardtype');
	//Route::post('get-group', 'API\PassportController@getCardtype');
	Route::post('get-data', 'API\PassportController@getData');
	Route::post('search-user', 'API\PassportController@searchUser');
	Route::post('update-user', 'API\PassportController@UpdateUser');
	Route::post('logout', 'API\PassportController@logout');
	Route::post('get-fingerprint-user', 'API\PassportController@getFingerprintUser');
    Route::post('store-fingerprint-user', 'API\PassportController@storeFingerprintUser');
	Route::post('update-image-fingerprint', 'API\PassportController@updateImageFingerprint');
	Route::post('get-data-fingerprint', 'API\PassportController@listDataFingerprint');
	Route::post('get-identify', 'API\PassportController@getIdentify');
});

/*
 * Upload from file .csv in MySql server
*/
Route::post('upload-data', 'API\UploaderController@UploadData');
Route::post('upload-finger', 'API\UploaderController@UploadFingerprint');
