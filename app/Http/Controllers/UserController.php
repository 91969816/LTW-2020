<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('users_login');
    }
    //
    public function index_register ()
    {
        return view('users_register');
    }
    function login()
    {

    }
    function register()
    {
        
    }
    function logout()
    {

    }
}
