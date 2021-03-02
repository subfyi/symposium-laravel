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

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\Apim\ArticlesController;
use App\Http\Controllers\Apim\ArticleTypesController;
use App\Http\Controllers\Apim\AuthorController;
use App\Http\Controllers\Apim\BlogCategoryController;
use App\Http\Controllers\Apim\BlogPostController;
use App\Http\Controllers\Apim\CitationController;
use App\Http\Controllers\Apim\CommentController;
use App\Http\Controllers\Apim\ContactController;
use App\Http\Controllers\Apim\CountrieController;
use App\Http\Controllers\Apim\GDriveFileController;
use App\Http\Controllers\Apim\JournalController;
use App\Http\Controllers\Apim\KeywordController;
use App\Http\Controllers\Apim\KullaniciController;
use App\Http\Controllers\Apim\LanguageController;
use App\Http\Controllers\Apim\NewsletterController;
use App\Http\Controllers\Apim\ProfileController;
use App\Http\Controllers\Apim\PublisherController;
use App\Http\Controllers\Apim\RolesController;
use App\Http\Controllers\Apim\SubjectController;
use App\Http\Controllers\Apim\SubmissionController;
use App\Http\Controllers\Apim\TurlerController;
use App\Http\Controllers\Apim\TypeLanguageController;
use App\Http\Controllers\Apim\TypePresentationController;
use App\Http\Controllers\Apim\TypePublishController;
use App\Http\Controllers\Apim\TypeTopicController;
use App\Http\Controllers\Apim\UsersController;
use App\Http\Controllers\Apim\VolumeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api'], function () {
    Route::get('parameters/{type}', [TurlerController::class, 'nlist']);
    Route::get('parameters/{type}/{id}', [TurlerController::class, 'nget']);
    Route::post('parameters/{type}', [TurlerController::class, 'npost']);
    Route::patch('parameters/{type}/{id}', [TurlerController::class, 'npatch']);
    Route::delete('parameters/{type}/{id}', [TurlerController::class, 'ndel']);

    Route::apiResource('typelanguage', TypeLanguageController::class);
    Route::apiResource('typetopic', TypeTopicController::class);
    Route::apiResource('typepublish', TypePublishController::class);
    Route::apiResource('typepresentation', TypePresentationController::class);

    Route::apiResource('submission', SubmissionController::class);


    Route::post('/sf_attribute_update', [AdminPostController::class, 'ndel']);
    Route::post('/isf_attribute_update', [AdminPostController::class, 'ndel']);
    Route::post('/sfc_attribute_update', [AdminPostController::class, 'ndel']);

    Route::post('/f_delete', [AdminPostController::class, 'ndel']);
    Route::post('/file_delete', [AdminPostController::class, 'ndel']);
    Route::post('/dosya-sil', [AdminPostController::class, 'ndel']);

    Route::post('/upload', [AdminPostController::class, 'post_upload']);

    // Public Endpoints
    Route::post('register', [KullaniciController::class, 'register']);
    Route::post('forgot', [KullaniciController::class, 'forgot']);
    Route::post('reset', [KullaniciController::class, 'reset']);
    Route::get('reset', [KullaniciController::class, 'resetGet']);
    Route::post('newsletter/subscribe', [NewsletterController::class, 'subscribe']);
    Route::post('newsletter/unsubscribe', [NewsletterController::class, 'unsubscribe']);

    Route::apiResource('post', BlogPostController::class);
    Route::get('post/slug/{slug}', [BlogPostController::class, 'showBySlug']);
    Route::get('post/{post_id}/comments', [CommentController::class, 'blog']);
    Route::post('post/{post_id}/comments', [CommentController::class, 'post_blog_comment']);

    Route::apiResource('journal', JournalController::class);
    Route::post('journal/getname', [JournalController::class, 'getname']);
    Route::post('journal/getid', [JournalController::class, 'getid']);
    Route::post('journal/getinfo', [JournalController::class, 'getinfo']);
    Route::post('journal/getissues', [JournalController::class, 'getissues']);

    Route::apiResource('volume', VolumeController::class);
    Route::post('volume/getarticles', [VolumeController::class, 'getarticles']);

    Route::apiResource('article', ArticlesController::class);
    Route::apiResource('author', AuthorController::class);
    Route::apiResource('keyword', KeywordController::class);
    Route::apiResource('language', LanguageController::class);
    Route::apiResource('articletype', ArticleTypesController::class);
    Route::apiResource('citation', CitationController::class);
    Route::apiResource('countrie', CountrieController::class);
    Route::apiResource('publisher', PublisherController::class);
    Route::apiResource('subject', SubjectController::class);


    Route::apiResource('profile', ProfileController::class);
    Route::patch('profile', [ProfileController::class, 'store']);

    Route::apiResource('user/me', ProfileController::class);
    Route::patch('user/me', [ProfileController::class, 'store']);

    Route::apiResource('user', UsersController::class);

    Route::post('contact', [ContactController::class, 'submit']);

    Route::get('/gfile/{id}/download', [GDriveFileController::class, 'download']);
    Route::post('/gupload', [GDriveFileController::class, 'create']);
    Route::post('/guploadbitti', [GDriveFileController::class, 'uploadbitti']);
    Route::get('/gfile/{id}/thumblink', [GDriveFileController::class, 'thumblink']);

    // Semi-Public Endpoints
    Route::group(['middleware' => ['GuestGet']], function () {
        Route::apiResource('roles', RolesController::class);

        Route::post('register', [KullaniciController::class, 'register']);
        Route::post('forgot', [KullaniciController::class, 'forgot']);
        Route::post('reset', [KullaniciController::class, 'reset']);
        Route::get('reset', [KullaniciController::class, 'resetGet']);
    });

    // Private Endpoints
    Route::group(['middleware' => ['Admin']], function () {
        Route::get('myself', [KullaniciController::class, 'myself']);
        Route::get('users', [KullaniciController::class, 'json']);
        Route::apiResource('kullanicilar', UsersController::class);
    });
});
