<?php

namespace Sleighdogs\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Session;
use Sleighdogs\User;
use Validator;
use Sleighdogs\Http\Controllers\ConfirmationController;

class MembersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_confirmation');
        $this->middleware('check_role');
        $this->middleware('check_orchestra');
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('members.add');
    }

    /**
     * insert new member
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|max:255',
            'surname' => 'required|max:255',
            'gender' => 'required',
            'email' => Rule::unique('users')->where(function ($query) {
                $query->where('member', '=', 1);
            })
        ]);

        $user = User::where('email', $request->get('email'))
            ->first();
        if ($user == null) {
            $data = $request->all();
            $user = new User();
            $user->firstname = $data['firstname'];
            $user->surname = $data['surname'];
            $user->gender = $data['gender'];
            $user->member = 1;
            $user->current_role = '2';
            $user->email = $data['email'];
            $user->password = '';
            $user->save();

            // send confirmation email
            $confirm = new ConfirmationController();
            $confirm->resend($request->get('email'));
        } else {
            $user->member = 1;
            $user->save();
        }

        Session::flash('flash_message', 'Member has been created');
        return redirect()->back();
    }
}
