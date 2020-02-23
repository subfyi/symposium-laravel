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
    public function get(Request $request) {
        return auth('api')->user();
    }

    public function update(Request $request) {
        
    }
}
