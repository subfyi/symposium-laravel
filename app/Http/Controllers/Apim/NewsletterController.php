<?php

namespace App\Http\Controllers\Apim;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        Newsletter::subscribeOrUpdate($request->email);
        if(!Newsletter::lastActionSucceeded()) {
            throw new Exception(Newsletter::getLastError());
        }

        return response(null, 204);
    }

    public function unsubscribe(Request $request)
    {
        Newsletter::unsubscribe($request->email);
        if(!Newsletter::lastActionSucceeded()) {
            throw new Exception(Newsletter::getLastError());
        }

        return response(null, 204);
    }
}
