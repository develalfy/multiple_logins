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
    /**
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function resend()
    {
        $token = Str::random(60);
        $link = route('confirmation.activate', $token);
        $data = [
            'title' => 'simple title',
            'body' => "please, click here to activate your account \n" . 'Click here: ' . $link
        ];

        try {
            Mail::raw($data['body'], function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'), env('MAIL_SENDER_NAME'));
                $message->to(Auth::user()->email)->subject($data['title']);
            });

            $user = User::find(Auth::user()->id);
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
        return view('confirmation');
    }

}
