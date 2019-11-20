<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use View;


class AdminController extends Controller
{

    public function __construct()
    {
        $announceup= Announce::orderBy('baslik','desc')->take(3)->get();
        View::share('announceup', $announceup);

    }
}
