<?php

namespace App\Http\Controllers\Apim;

use App\Models\Kullanicilar;
use App\Http\Controllers\Controller;
use Auth;
use View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class KullaniciController extends Controller
{
    public function json() {
        return [
            "myId" => auth('api')->id(),
            "kullanicilar" => Kullanicilar::orderBy('name', 'asc')->select('id', 'name', 'email')->get()
        ];
    }

    public function myself() {
        return Kullanicilar::where('id', auth('api')->id())->select('id', 'name', 'email', 'yetki')->first();
    }

    public function me(Request $request) {
        return [
            "user_id" => auth('api')->user()->id
        ];
    }
}
