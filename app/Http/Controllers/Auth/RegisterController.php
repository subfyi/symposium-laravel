<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use View;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Models\Parameters;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $titlecons = Parameters::where('type', 'titlecon')->get();
        $materialcon = Parameters::where('type', 'materialcon')->get();
        $gendercon = Parameters::where('type', 'gender')->get();
        View::share(['titlecons' => $titlecons, 'materialcon' => $materialcon, 'gendercon' => $gendercon]);
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $tarih = str_slug(Carbon::now());
        $user =  User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'address' => $data['address'],
            'iletisim' => $data['iletisim'],
            'u_title' => $data['u_title'],
            'u_type' => $data['u_type'],
            'gender' => $data['gender'],
            'institution' => $data['institution'],
            'faculty' => $data['faculty'],
            'department' => $data['department'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'slug' => str_slug($data['name']).'_'.$tarih,
        ]);

        Mail::to($data['email'])->send(new WelcomeMail($user));

        return $user;
    }

}
