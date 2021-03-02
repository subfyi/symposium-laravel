<?php

namespace App\Http\Controllers\Apim;

use App\Mail\ResetMail;
use App\Mail\ResetMailProve;
use App\Models\Kullanicilar;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Error;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class KullaniciController extends Controller
{
    public function json() {
        return [
            "myId" => auth('api')->id(),
            "kullanicilar" => Kullanicilar::orderBy('name', 'asc')->select('id', 'name', 'surname', 'email')->get()
        ];
    }

    public function myself() {
        return Kullanicilar::where('id', auth('api')->id())->select('id', 'name', 'surname', 'email', 'role')->first();
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
                'role' => 1,
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



    public function forgot(Request $request)
    {

        $user = Kullanicilar::where('email', '=', $request->email)->first();

        //Check if the user exists
        if ( ! $user) {
            throw new Error("The e-mail is not registered on our system.");
        }
        $data      = [
            'email'      => $request->email,
            'token'      => Str::random(60),
            'created_at' => new Carbon(now())
        ];
        $tokenData = DB::table('password_resets')->insert($data);

        //Generate, the password reset link. The token generated is embedded in the link
        $link = 'https://iseser.com/auth/reset-password/'.urlencode($data['token']).'/'.urlencode($data['email']);

        Mail::send(new ResetMail($user, $link));

        return 1;
    }

    public function resetGet()
    {
        $data = DB::table('password_resets')
                  ->where('email', request()->query('email'))
                  ->where('token', request()->query('token'))
                  ->first();

        if ( ! $data) {
            throw new Error('Link is invalid');
        }
    }

    public function reset(Request $request)
    {
        $data = DB::table('password_resets')
                  ->where('email', $request->email)
                  ->where('token', $request->token)
                  ->first();

        if ( ! $data) {
            throw new Error('Link is invalid');
        }


        $user = Kullanicilar::where('email', '=', $request->email)->first();
        try {
            $user->update([
                'password' => Hash::make($request->password),
            ]);



            Mail::send(new ResetMailProve($user));

            DB::table('password_resets')
              ->where('email', $request->email)
              ->where('token', $request->token)->delete();
        } catch (\Throwable $e) {
            if (strpos($e->getMessage(), "Integrity constraint violation") !== false) {
                throw new Error("The same e-mail is already registered on our system.");
            } else {
                throw $e;
            }
        }
    }
}
