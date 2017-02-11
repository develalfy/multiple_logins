<?php

namespace Sleighdogs\Http\Controllers;

use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class ConfirmationController extends Controller
{
    public function resend()
    {
        $token = Str::random(60);
//        $link = "http://$_SERVER[HTTP_HOST]/public/index.php/confirmation/activate/$token";
        $link = "http://$_SERVER[HTTP_HOST]/confirmation/activate/$token";

        // Insert Token to database
        // Send mail with the same token

        $data = [
            'title' => 'simple title',
            'body' => "please, click here to activate your account \n" . 'Click here: ' . $link
        ];
        try {
            Mail::raw($data['body'], function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'), env('MAIL_SENDER_NAME'));
                $message->to(Auth::user()->email)->subject($data['title']);
            });
        } catch (Exception $e) {
            return $e->getMessage();
        }

        Session::flash('flash_message', 'E-mail has been sent');

        return redirect()->back();
    }

    public function activate($token)
    {
        dd($token);
    }
}
