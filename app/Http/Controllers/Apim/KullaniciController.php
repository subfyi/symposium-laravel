<?php

namespace App\Http\Controllers\Apim;

use App\Models\Kullanicilar;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Kullanici;
use Auth;
use Error;
use View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Throwable;

class KullaniciController extends Controller
{
    public function json() {
        return [
            "myId" => auth('api')->id(),
            "kullanicilar" => Kullanicilar::orderBy('name', 'asc')->select('id', 'name', 'surname', 'email')->get()
        ];
    }

    public function myself() {
        return Kullanicilar::where('id', auth('api')->id())->select('id', 'name', 'surname', 'email', 'yetki')->first();
    }

    public function me(Request $request) {
        return [
            "user_id" => auth('api')->user()->id
        ];
    }

    public function register(Request $request) {
        try {
            Kullanicilar::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'yetki' => 1,
                'iletisim' => $request->iletisim,
                'address' => $request->address,
                'u_title' => $request->title,
                'u_type' => $request->type,
                'gender' => $request->gender,
                'status' => 2,
                'institution' => $request->institution,
                'faculty' => $request->faculty,
                'department' => $request->department
            ]);
        } catch(\Throwable $e)  {
            if(strpos($e->getMessage(), "Integrity constraint violation") !== false) {
                throw new Error("The same e-mail is already registered on our system.");
            } else {
                throw $e;
            }
        }
    }
}
