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

header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, PATCH, DELETE, OPTIONS');

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api', 'middleare' => ['auth:api'], 'namespace' => 'Apim', 'as' => 'api.'], function () {
    Route::get('parameters/{type}', 'TurlerController@nlist');
    Route::get('parameters/{type}/{id}', 'TurlerController@nget');
    Route::post('parameters/{type}', 'TurlerController@npost');
    Route::patch('parameters/{type}/{id}', 'TurlerController@npatch');
    Route::delete('parameters/{type}/{id}', 'TurlerController@ndel');

    Route::get('myself', 'KullaniciController@myself');
    Route::get('users', 'KullaniciController@json');
    Route::apiResource('kullanicilar', 'UsersController');
    Route::apiResource('submission', 'SubmissionController');
    Route::apiResource('author', 'AuthorController');
    Route::apiResource('profile', 'ProfileController');
    Route::post('/contact', 'ContactController@submit');

    Route::get('/gfile/{id}/download', 'GDriveFileController@download');
    Route::post('/gupload', 'GDriveFileController@create');
    Route::post('/guploadbitti', 'GDriveFileController@uploadbitti');
    Route::get('/gfile/{id}/thumblink', 'GDriveFileController@thumblink');
});

Route::group(['prefix' => 'api', 'namespace' => 'Apim', 'as' => 'api.'], function () {
    Route::post('register', 'KullaniciController@register');
});
