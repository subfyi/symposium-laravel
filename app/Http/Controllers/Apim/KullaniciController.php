<?php

namespace App\Http\Controllers\Apim;

use App\Mail\ResetMail;
use App\Models\Kullanicilar;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Error;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Throwable;

class KullaniciController extends Controller
{
    public function json()
    {
        return [
            "myId"         => auth('api')->id(),
            "kullanicilar" => Kullanicilar::orderBy('name', 'asc')->select('id', 'name', 'surname', 'email')->get()
        ];
    }

    public function myself()
    {
        return Kullanicilar::where('id', auth('api')->id())->select('id', 'name', 'surname', 'email', 'yetki')->first();
    }

    public function me(Request $request)
    {
        return [
            "user_id" => auth('api')->user()->id
        ];
    }

    public function register(Request $request)
    {
        try {
            Kullanicilar::create([
                'name'        => $request->name,
                'surname'     => $request->surname,
                'email'       => $request->email,
                'password'    => Hash::make($request->password),
                'yetki'       => 1,
                'iletisim'    => $request->iletisim,
                'address'     => $request->address,
                'u_title'     => $request->title,
                'u_type'      => $request->type,
                'gender'      => $request->gender,
                'status'      => 2,
                'institution' => $request->institution,
                'faculty'     => $request->faculty,
                'department'  => $request->department
            ]);
        } catch (\Throwable $e) {
            if (strpos($e->getMessage(), "Integrity constraint violation") !== false) {
                throw new Error("The same e-mail is already registered on our system.");
            } else {
                throw $e;
            }
        }
    }


    public function forgot(Request $request)
    {

        $user = Kullanicilar::where('email', '=', $request->email)->first();

        //Check if the user exists
        if ( ! $user) {
            throw new Error("The e-mail is not registered on our system.");
        }

        DB::table('password_resets')->insert([
            'email'      => $request->email,
            'token'      => Str::random(60),
            'created_at' => new Carbon(now())
        ]);

        //Get the token just created above
        $tokenData = DB::table('password_resets')->where('email', $user->email)->first();

        if ($tokenData->token) {

            //Generate, the password reset link. The token generated is embedded in the link
            $link = 'https://iseser.com/auth/reset-password/'.$tokenData->token.'?email='.urlencode($user->email);

            Mail::send(new ResetMail($user, $link));

            return 1;
        } else {
            return 0;
        }

    }

    public function reset(Request $request)
    {
        $user = Kullanicilar::where('email', '=', $request->email)->first();
        try {
            $user->update([
                'password'    => Hash::make($request->password),
            ]);

            Mail::send(new ResetMailProve($user));
        } catch (\Throwable $e) {
            if (strpos($e->getMessage(), "Integrity constraint violation") !== false) {
                throw new Error("The same e-mail is already registered on our system.");
            } else {
                throw $e;
            }
        }
    }
}
