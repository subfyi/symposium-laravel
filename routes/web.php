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

Auth::routes();
Route::get('/girisyap', 'HomeGetController@get_login');
Route::get('/cikisyap', 'HomeGetController@get_logout');

Route::get('/index', 'HomeGetController@get_index_yonlendir');
Route::get('/home', 'HomeGetController@get_index_yonlendir');
Route::get('/anasayfa', 'HomeGetController@get_index_yonlendir');

Route::get('/', 'HomeGetController@get_index');
Route::get('/honorary-committee', 'HomeGetController@get_honorary_committee');
Route::get('/organization-committee', 'HomeGetController@get_organization_committee');
Route::get('/science-commission', 'HomeGetController@get_science_commission');
Route::get('/adviser-commission', 'HomeGetController@get_adviser_commission');
Route::get('/invitation', 'HomeGetController@get_invitation');
Route::get('/threads', 'HomeGetController@get_threads');
Route::get('/important-dates', 'HomeGetController@get_important_dates');
Route::get('/conference-fee', 'HomeGetController@get_conference_fee');
Route::get('/sponsors', 'HomeGetController@get_sponsors');
Route::get('/contact', 'HomeGetController@get_contact');

Route::get('/documents/', 'HomeGetController@get_documents');
Route::get('/documents/2019', 'HomeGetController@get_documents_2019');
Route::get('/documents/2018', 'HomeGetController@get_documents_2018');
Route::get('/documents/2017', 'HomeGetController@get_documents_2017');
Route::get('/documents/2016', 'HomeGetController@get_documents_2016');


Route::get('/symposium-announced', 'HomeGetController@get_iseser_annon');

Route::get('/about-us', 'HomeGetController@get_about_us');

Route::get('/blog/', 'HomeGetController@get_blog');
Route::get('/blog/{slug}', 'HomeGetController@get_blog_icerik')->where('slug', '^[a-zA-Z0-9-_\/]+$');
Route::get('/blog/author/{slug}', 'HomeGetController@get_blog_yazar');
Route::post('/blog/{slug}', 'HomePostController@post_blog_yorum')->where('slug', '^[a-zA-Z0-9-_\/]+$');

Route::get('/403', 'HomeGetController@get_403');
Route::get('/404', 'HomeGetController@get_403');

Route::post('/sf_attribute_update', 'AdminPostController@post_sf_attribute_update');
Route::post('/isf_attribute_update', 'AdminPostController@post_isf_attribute_update');
Route::post('/sfc_attribute_update', 'AdminPostController@post_sfc_attribute_update');

Route::post('/f_delete', 'AdminPostController@post_f_delete');
Route::post('/file_delete', 'AdminPostController@post_file_delete');
Route::post('/dosya-sil', 'AdminPostController@post_dosya_sil');

Route::prefix('cms')->middleware('Izleyici')->group(function () {
    Route::get('/', 'AdminGetController@get_profile');
    Route::post('/', 'AdminPostController@post_profile');

});

Route::post('/upload', 'AdminPostController@post_upload');
Route::prefix('user')->middleware('Izleyici')->group(function () {
    Route::get('/', 'AdminGetController@get_profile');
    Route::post('/', 'AdminPostController@post_profile');

    Route::get('/preparing', 'AdminGetController@get_preparing');

    Route::get('/papers', 'AdminGetController@get_paper_all');
    Route::post('/papers', 'AdminPostController@post_gorev_sil');

    Route::get('/paper-add', 'AdminGetController@get_paper_add');
    Route::post('/paper-add', 'AdminPostController@post_paper_add');

    Route::get('/papers-all', 'AdminGetController@get_papers_all');
    Route::post('/papers-all', 'AdminPostController@post_gorev_sil');

    Route::get('/get_user_mail', 'AdminGetController@get_user_mail');
    Route::get('/get_tags', 'AdminGetController@get_tags');

    Route::get('/papers-add', 'AdminGetController@get_papers_add');
    Route::post('/papers-add', 'AdminPostController@post_papers_add');

    Route::group(['prefix' => 'announcement'], function () {
        Route::get('/', 'AdminGetController@get_announce', function () {
        })->middleware('Izleyici');
        Route::post('/', 'AdminPostController@post_announce', function () {
        })->middleware('Izleyici');

        Route::get('/announce-add', 'AdminGetController@get_announce_add', function () {
        })->middleware('Admin');
        Route::post('/announce-add', 'AdminPostController@post_announce_add', function () {
        })->middleware('Admin');

        Route::get('/announce-edit/{slug}', 'AdminGetController@get_announce_edit', function () {
        })->middleware('Admin');
        Route::post('/announce-edit/{slug}', 'AdminPostController@post_announce_edit', function () {
        })->middleware('Admin');
    });

    Route::group(['prefix' => 'review'], function () {
        Route::get('/', 'AdminGetController@get_review', function () {
        })->middleware('Izleyici');
        Route::post('/', 'AdminPostController@post_review', function () {
        })->middleware('Izleyici');

        Route::get('/review-add/{slug}', 'AdminGetController@get_review_add', function () {
        })->middleware('Izleyici');
        Route::post('/review-add/{slug}', 'AdminPostController@post_review_add', function () {
        })->middleware('Izleyici');

        Route::get('/review-edit/{slug}', 'AdminGetController@get_review_edit', function () {
        })->middleware('Izleyici');
        Route::post('/review-edit/{slug}', 'AdminPostController@post_review_edit', function () {
        })->middleware('Izleyici');
    });

    Route::group(['prefix' => 'faq'], function () {
        Route::get('/', 'AdminGetController@get_faq', function () {
        })->middleware('Izleyici');
        Route::post('/', 'AdminPostController@post_sss', function () {
        })->middleware('Izleyici');

        Route::get('/faq-add', 'AdminGetController@get_faq_add', function () {
        })->middleware('Admin');
        Route::post('/faq-add', 'AdminPostController@post_faq_add', function () {
        })->middleware('Admin');

        Route::get('/faq-edit/{slug}', 'AdminGetController@get_faq_edit', function () {
        })->middleware('Admin');
        Route::post('/faq-edit/{slug}', 'AdminPostController@post_faq_edit', function () {
        })->middleware('Admin');
    });

    Route::group(['prefix' => 'feedback'], function () {
        Route::get('/', 'AdminGetController@get_feedback', function () {
        })->middleware('Admin');

        Route::get('/feedback-add', 'AdminGetController@get_feedback_add', function () {
        })->middleware('Izleyici');
        Route::post('/feedback-add', 'AdminPostController@post_feedback_add', function () {
        })->middleware('Izleyici');

        Route::get('/feedback-edit/{slug}', 'AdminGetController@get_feedback_edit', function () {
        })->middleware('Admin');
        Route::post('/feedback-edit/{slug}', 'AdminPostController@post_feedback_edit', function () {
        })->middleware('Admin');
    });

    Route::group(['prefix' => 'user', 'middleware' => 'Admin'], function () {
        Route::get('/users', 'AdminGetController@get_users');
        Route::post('/users', 'AdminPostController@post_users');

        Route::get('/user-edit/{slug}', 'AdminGetController@get_user_edit');
        Route::post('/user-edit/{slug}', 'AdminPostController@post_user_edit');

        Route::get('/user-add', 'AdminGetController@get_user_add');
        Route::post('/user-add', 'AdminPostController@post_user_add');
    });

    Route::group(['prefix' => 'tur', 'middleware' => 'Admin'], function () {

        Route::get('/is-turu', 'AdminGetController@get_is_turu');
        Route::post('/is-turu', 'AdminPostController@post_is_turu');

        Route::get('/is-turu-ekle', 'AdminGetController@get_is_turu_ekle');
        Route::post('/is-turu-ekle', 'AdminPostController@post_is_turu_ekle');

        Route::get('/malzeme-turu', 'AdminGetController@get_malzeme_turu');
        Route::post('/malzeme-turu', 'AdminPostController@post_malzeme_turu');

        Route::get('/malzeme-turu-ekle', 'AdminGetController@get_malzeme_turu_ekle');
        Route::post('/malzeme-turu-ekle', 'AdminPostController@post_malzeme_turu_ekle');

        Route::get('/uygulama-turu', 'AdminGetController@get_uygulama_turu');
        Route::post('/uygulama-turu', 'AdminPostController@post_uygulama_turu');

        Route::get('/uygulama-turu-ekle', 'AdminGetController@get_uygulama_turu_ekle');
        Route::post('/uygulama-turu-ekle', 'AdminPostController@post_uygulama_turu_ekle');


        Route::get('/birim-turu', 'AdminGetController@get_birim_turu');
        Route::post('/birim-turu', 'AdminPostController@post_birim_turu');

        Route::get('/birim-turu-ekle', 'AdminGetController@get_birim_turu_ekle');
        Route::post('/birim-turu-ekle', 'AdminPostController@post_birim_turu_ekle');


        Route::get('/yetki-turu', 'AdminGetController@get_yetki_turu');
        Route::post('/yetki-turu', 'AdminPostController@post_yetki_turu');

        Route::get('/yetki-turu-ekle', 'AdminGetController@get_yetki_turu_ekle');
        Route::post('/yetki-turu-ekle', 'AdminPostController@post_yetki_turu_ekle');

    });

    Route::group(['prefix' => 'blog', 'middleware' => 'Admin'], function () {
        Route::get('/', 'AdminGetController@get_blog');
        Route::post('/', 'AdminPostController@post_blog_sil');

        Route::get('/blog-add', 'AdminGetController@get_blog_add');
        Route::post('/blog-add', 'AdminPostController@post_blog_add');

        Route::get('/blog-edit/{slug}', 'AdminGetController@get_blog_edit');
        Route::post('/blog-edit/{slug}', 'AdminPostController@post_blog_edit');

        Route::get('/categories', 'AdminGetController@get_categories');
        Route::post('/categories', 'AdminPostController@post_categories');

        Route::get('/categorie-add', 'AdminGetController@get_categorie_add');
        Route::post('/categorie-add', 'AdminPostController@post_categorie_add');
    });

    Route::get('/about-us', 'AdminGetController@get_about_us', function () {
    })->middleware('Admin');
    Route::post('/about-us', 'AdminPostController@post_about_us', function () {
    })->middleware('Admin');
});

//General Welcome Page:
Route::get('/welcome', function () {
    return view('welcome');
});

//Clear Cache facade value:
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function () {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function () {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});
