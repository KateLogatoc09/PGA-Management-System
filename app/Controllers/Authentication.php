<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AccountModel;

class Authentication extends BaseController
{
    private $acc;
    public function __construct()
    {
        $this->acc = new AccountModel();
  
    }

    public function Logout() {
        $session = session();
        session_destroy();
        return redirect()->to('login');
    }

    public function LoginAuth() {

        $session = session();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $this->acc->where('username', $username)->first();
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

    public function register()
    {
        helper(['form']);
        $rules =[
            'username' => 'required|min_length[4]|max_length[100]|is_unique[accounts.username]',
            'email' => 'valid_email|is_unique[accounts.email]',
            'password' =>'required|min_length[4]|max_length[50]',
            'confirmpassword' => 'matches[password]',
        ];
            if($this->validate($rules)){

            $data =[
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getVar('role'),
            'status' => 'UNVERIFIED',
            ];

            $this->acc->save($data);

            return redirect()->to('login');
        }else{
            $data['validation'] = $this->validator;
            return redirect()->to('/reg');
            };
    }
}
