<?php

namespace Sleighdogs\Http\Controllers\Auth;

use Sleighdogs\User;
use Sleighdogs\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/confirmation/resend';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
            'firstname' => 'required|max:255',
            'surname' => 'required|max:255',
            'gender' => 'required',
            'role_type' => 'required',
            'orchestra_name' => 'required_if:role_type.0,orchestra|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'surname' => $data['surname'],
            'gender' => $data['gender'],
            'orchestra' => in_array('orchestra', $data['role_type']) ? true : false,
            'musician' => in_array('musician', $data['role_type']) ? true : false,
            'orchestra_name' => in_array('orchestra', $data['role_type']) ? $data['orchestra_name'] : '',
            'current_role' => in_array('orchestra', $data['role_type']) ? 0 : 1, // if orchestra selected put it as current role else put musician
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
