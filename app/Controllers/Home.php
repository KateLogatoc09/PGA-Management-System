<?php

namespace App\Controllers;
use App\Models\AccountModel;
class Home extends BaseController
{
    public function index()
    {
        return view('index');
    }
    public function logreg()
    {
        helper(['form']);
        return view('login');
    }
    public function reg()
    {
        helper(['form']);
        return view('register');
    }
    public function ab()
    {
        return view('about');
    }
    public function verify()
    {
        return view('verify');
    }
    public function verifying()
    {
        return view('verifying');
    }
    public function forget()
    {
        return view('forget');
    }

    

}
