<?php

namespace Sleighdogs\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Sleighdogs\Http\Controllers\RolesController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->checkUserConfirmation() === 0) {
            return view('confirmation');
        }

        $roles = new RolesController();
        $user_type = $roles->roles[Auth::user()->current_role];

        return view('home', compact('user_type'));
    }

    private function checkUserConfirmation()
    {
        return Auth::user()->confirmed;
    }
}
