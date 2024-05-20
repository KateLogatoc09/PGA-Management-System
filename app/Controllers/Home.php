<?php

namespace App\Controllers;
use App\Models\AnnouncementModel;
class Home extends BaseController
{
    private $announce;
    public function __construct()
    {
        $this->announce = new AnnouncementModel();
    }
    public function index()
    {
        $data = [
            'announcement' => $this->announce->findAll(),
        ];
        return view('index', $data);
    }
    public function Test()
    {
        return view('test');
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
    public function forgot()
    {
        return view('forgot');
    }
    public function password()
    {
        return view('recovery');
    }
    public function qr()
    {
        return view('qr');
    }
    

    

}
