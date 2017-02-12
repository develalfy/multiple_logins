<?php

namespace Sleighdogs\Http\Controllers;

use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Sleighdogs\User;


class ConfirmationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param null $email
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function resend($email = null)
    {
        $token = Str::random(60);
        $link = route('confirmation.activate', $token);
        if ($email == null) {
            $email = Auth::user()->email;
            $member_body = "please, click here to activate your account \n" . $link;
        }else {
            $member_body = "please, reset your password \n Click here: ". route('password.request');
        }
        $data = [
            'title' => 'simple title',
            'body' => $member_body
        ];

        try {
            Mail::raw($data['body'], function ($message) use ($data, $email) {
                $message->from(env('MAIL_USERNAME'), env('MAIL_SENDER_NAME'));
                $message->to($email)->subject($data['title']);
            });

            $user = User::where('email', $email)->first();
            $user->confirmation = $token;
            $user->save();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        Session::flash('flash_message', 'E-mail has been sent');

        return redirect()->back();
    }

    /**
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate($token)
    {
        $user = User::find(Auth::user()->id);
        if ($token != $user->confirmation) {
            return redirect()->to('/home');
        }

        $user->confirmed = 1;
        $user->save();

        Session::flash('flash_message', 'E-mail has been verified');

        return redirect()->to('/home');
    }


    /**
     * View confirmation page.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirm()
    {
        if (Auth::user()->confirmed === 1) {
            return redirect()->route('home');
        }
        return view('confirmation');
    }

}
