<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Announce;
use App\Models\Bildirim;
use App\Models\Hakkimizda;
use Illuminate\Support\ServiceProvider;


class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function($view)
        {
            $bildirimler = Bildirim::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
            $bcount = Bildirim::Where('user_id',Auth::id())->where('read_at', NULL)->count();
            $announceup= Announce::orderBy('baslik','desc')->take(3)->get();
            $announces = Announce::findOrFail(3);
            $hakkimizda = Hakkimizda::where('id', 1)->select('hakkimizda.*')->first();
            $bloglar = Blog::all();

            View::share(array(
                'bildirimler' => $bildirimler,
                'bcount' => $bcount,
                'announceup' => $announceup,
                'announces' => $announces,
                'hakkimizda' => $hakkimizda,
                'bloglar' => $bloglar
            ));
        });
    }


    public function register()
    {
        //
    }
}
