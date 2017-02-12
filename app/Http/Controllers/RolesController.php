<?php

namespace Sleighdogs\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Sleighdogs\User;

class RolesController extends Controller
{
    // orchestra => 0
    // musician  => 1
    // member    => 2
    public $roles = ['orchestra', 'musician', 'member'];


    /**
     * RolesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_confirmation');
    }

    /**
     * Select Role after login
     * @return \Illuminate\Http\Response
     */
    public function select()
    {
        $user_roles = array();

        $user = User::find(Auth::user()->id);
        foreach ($this->roles as $key => $role) {
            if ($user->$role == 1) {
                $user_roles[$key] = $role;
            }
        }

        return view('roles', compact('user_roles'));
    }

    public function update($role)
    {
        $user = User::find(Auth::user()->id);
        $user->current_role = $role;
        $user->save();

        return redirect('/home');
    }
}
