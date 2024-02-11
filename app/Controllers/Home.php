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
        return view('home/about');
    }
    public function verify()
    {
        return view('verify');
    }
    public function forget()
    {
        return view('forget');
    }

    public function Logout() {
        $session = session();
        session_destroy();
        return redirect()->to('login');
    }

    public function LoginAuth() {

        $session = session();
        $account = new AccountModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $account->where('username', $username)->first();
        if($data){
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
                
            if($authenticatePassword){
                    $ses_data = [
                        'id' => $data['id'],
                        'username' => $data['username'],
                        'role' => $data['role'],
                        'isLoggedIn' => TRUE,
                    ];
                    $session->set($ses_data);

                    if($_SESSION['role'] == 'student'){
                        return redirect()->to('/student');
                    }
                    else if($_SESSION['role'] == 'teacher'){
                        return redirect()->to('/teacher');
                    }
                    else if($_SESSION['role'] == 'librarian'){
                        return redirect()->to('/librarian');
                    }
                    else{
                        return redirect()->to('/admins');
                    }
                }
                else{
                $session->setFlashdata('msg','Password is incorrect.');
                return redirect()->to('login');
                }
            }
            else
            {
                $session->setFlashdata('msg','Email does not exist.');
                return redirect()->to('login');
            };
    }

}
