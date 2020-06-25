<?php

namespace App\Http\Controllers\Apim;

use App\Http\Controllers\Controller;
use Auth;
use View;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $mail = new ContactMail($request->name, $request->email, $request->title, $request->message);
        Mail::to([ 'iseser@iseser.com' ])->send($mail);

        return response(null, 204);
    }
}
