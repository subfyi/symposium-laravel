<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Yorum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomePostController extends HomeController
{


    public function post_blog_yorum(Request $request, $slug)
    {
        if (Auth::check()) {
            $validator = Validator::make($request->all(), [
                'icerik' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'isim' => 'required',
                'icerik' => 'required',
            ]);
        }
        if ($validator->fails()) {
            $mesaj = $validator->messages();
            return response(['durum' => 'error', 'baslik' => 'Hatalı', 'icerik' => 'eksik alan ' . $mesaj]);
        }
        $kategori = explode('/', $slug);
        $request->merge(['blog' => $kategori[count($kategori) - 1]]);
        if(Auth::check()){
            $request->merge(['kullanici_id' => Auth::user()->id]);

        }


        Yorum::create($request->all());
        return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Kayıt başarı ile yapıldı']);

    }

}
