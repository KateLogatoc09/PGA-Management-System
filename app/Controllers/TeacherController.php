<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TeacherController extends BaseController
{
    public function teacher(){
        if(!session()->get('isLoggedIn')){
            return redirect()->to('login');
        }
        else{
            $session = session();
            session_start();
            $data = [
                'currentuser' => $_SESSION['username'],
            ];
            return view ('teacher', $data);
        }
    }
}
