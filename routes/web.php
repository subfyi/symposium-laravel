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

use Illuminate\Support\Facades\Route;

header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, PATCH, DELETE, OPTIONS');


Route::group(['prefix' => 'api', 'middleare' => ['auth:api'], 'namespace' => 'Apim', 'as' => 'api.'], function () {
    Route::get('parameters/{type}', 'TurlerController@nlist');
    Route::get('parameters/{type}/{id}', 'TurlerController@nget');
    Route::post('parameters/{type}', 'TurlerController@npost');
    Route::patch('parameters/{type}/{id}', 'TurlerController@npatch');
    Route::delete('parameters/{type}/{id}', 'TurlerController@ndel');


    Route::apiResource('typelanguage', 'TypeLanguageController');
    Route::apiResource('typetopic', 'TypeTopicController');
    Route::apiResource('typepublish', 'TypePublishController');
    Route::apiResource('typepresentation', 'TypePresentationController');


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
    Route::post('forgot', 'KullaniciController@forgot');
    Route::post('reset', 'KullaniciController@reset');
    Route::get('reset', 'KullaniciController@resetGet');
});

Route::post('/sf_attribute_update', 'AdminPostController@post_sf_attribute_update');
Route::post('/isf_attribute_update', 'AdminPostController@post_isf_attribute_update');
Route::post('/sfc_attribute_update', 'AdminPostController@post_sfc_attribute_update');

Route::post('/f_delete', 'AdminPostController@post_f_delete');
Route::post('/file_delete', 'AdminPostController@post_file_delete');
Route::post('/dosya-sil', 'AdminPostController@post_dosya_sil');

Route::post('/upload', 'AdminPostController@post_upload');
