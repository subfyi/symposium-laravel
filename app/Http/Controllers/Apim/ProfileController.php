<?php

namespace App\Http\Controllers\Apim;

use App\Models\Kullanicilar;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index() {
        $user = Kullanicilar::with(['utitle', 'utype', 'genderdata'])->where('id', auth('api')->user()->id)
        ->select(
            'name',
            'surname',
            'email',
            'address',
            'u_title',
            'u_type',
            'gender',
            'status',
            'institution',
            'faculty',
            'department',
            'slug',
            'iletisim'
        )
        ->first();

        return $user;
    }

    public function store(Request $request) {
        Kullanicilar::where('id', auth('api')->user()->id)->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'address' => $request->address,
            'u_title' => $request->u_title,
            'u_type' => $request->u_type,
            'gender' => $request->gender,
            'institution' => $request->institution,
            'faculty' => $request->faculty,
            'department' => $request->department,
            'iletisim' => $request->iletisim
        ]);

        if(!empty($request->password)) {
            Kullanicilar::where('id', auth('api')->user()->id)->update([
                'password' => Hash::make($request->password)
            ]);
        }
    }
}
