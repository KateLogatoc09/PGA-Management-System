<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TeacherModel;
use App\Models\AlumniModel;
use App\Models\AccountModel;

class AdminController extends BaseController
{
    
    private $teacher;
    public function __construct()
    {
        $this->teacher = new TeacherModel();
        $this->alumni = new AlumniModel();
        $this->account = new AccountModel();
    }

    public function index()
    {
        if(!session()->get('isLoggedIn'))
        {
            return redirect()->to('login');
        }
        else
        {
            $session = session();
            session_start();
            $data = [
                'currentuser' => $_SESSION['username'],
                'account' => $this->account->findAll(),
                ];
            return view ('admin', $data);
            }
    }

    public function alumni()
    {
        if(!session()->get('isLoggedIn'))
        {
            return redirect()->to('login');
        }
        else
        {
            $session = session();
            session_start();
            $data = [
                'currentuser' => $_SESSION['username'],
                'alumni' => $this->alumni->findAll(),
                ];
            return view ('alumni', $data);
            }
    }

    public function addTeacher()
    {
        if(!session()->get('isLoggedIn'))
        {
            return redirect()->to('login');
        }
        else
        {
            $session = session();
            session_start();
            $data = [
                'currentuser' => $_SESSION['username'],
                'teacher' => $this->teacher->findAll(),
                ];
                return view('adminteach', $data);
            }
    }
    public function save()  {
        $id = $_POST['id'];
        $data = [
            'idnum' => $this->request->getVar('idnum'),
            'fname' => $this->request->getVar('fname'),
            'mname' => $this->request->getVar('mname'),
            'lname' => $this->request->getVar('lname'),
            'dob' => $this->request->getVar('dob'),
        
        ];

        if ($id != null) {
            $this->teacher->set($data)->where('id', $id)->update();
        } else {
            $this->teacher->save($data);
        }
        if(!session()->get('isLoggedIn'))
        {
            return redirect()->to('login');
        }
        else
            {
                $session = session();
                session_start();
                $data = [
                    'currentuser' => $_SESSION['username'],
                    'teacher' => $this->teacher->findAll(),
                    '$teach' => $this->teacher->where('id', $id)->first(),
                ];
                
                return view('adminteach', $data);
            }
    }

    public function delete($id)
    {
        $this->teacher->delete($id);
        if(!session()->get('isLoggedIn'))
        {
            return redirect()->to('login');
        }
        else
            {
                $session = session();
                session_start();
                $data = [
                    'currentuser' => $_SESSION['username'],
                    'teacher' => $this->teacher->findAll(),
                    '$teach' => $this->teacher->where('id', $id)->first(),
                ];

                return view('adminteach', $data);
    }
    }

    public function edit($id)
    {
        if(!session()->get('isLoggedIn'))
        {
            return redirect()->to('login');
        }
        else
        {
            $session = session();
            session_start();
        $data = [
            'currentuser' => $_SESSION['username'],
            'teacher' => $this->teacher->findAll(),
            'prof' => $this->teacher->where('id', $id)->first(),
        ];

        return view('adminteach', $data);
        }
    }

    public function saveAlumni()  {
        $id = $_POST['id'];
        $data = [
            'fullname' => $this->request->getVar('fullname'),
            'gender' => $this->request->getVar('gender'),
            'email' => $this->request->getVar('email'),
            'phone' => $this->request->getVar('phone'),
            'address' => $this->request->getVar('address'),
            'occupation' => $this->request->getVar('occupation'),
            'yr_graduated' => $this->request->getVar('yr_graduated'),
        ];

        if ($id != null) {
            $this->alumni->set($data)->where('id', $id)->update();
        } else {
            $this->alumni->save($data);
        }
        if(!session()->get('isLoggedIn'))
        {
            return redirect()->to('login');
        }
        else
            {
                $session = session();
                session_start();
                $data = [
                    'currentuser' => $_SESSION['username'],
                    'alumni' => $this->alumni->findAll(),
                    'alum' => $this->teacher->where('id', $id)->first(),
                ];
                
                return view('alumni', $data);
            }
    }

    public function deleteAlumni($id)
    {
        $this->alumni->delete($id);
        if(!session()->get('isLoggedIn'))
        {
            return redirect()->to('login');
        }
        else
            {
                $session = session();
                session_start();
                $data = [
                    'currentuser' => $_SESSION['username'],
                    'alumni' => $this->alumni->findAll(),
                    'alum' => $this->alumni->where('id', $id)->first(),
                ];

                return view('alumni', $data);
    }
    }

    public function editAlumni($id)
    {
        if(!session()->get('isLoggedIn'))
        {
            return redirect()->to('login');
        }
        else
        {
            $session = session();
            session_start();
        $data = [
            'currentuser' => $_SESSION['username'],
            'alumni' => $this->alumni->findAll(),
            'alum' => $this->alumni->where('id', $id)->first(),
        ];

        return view('alumni', $data);
        }
    }

    public function saveAccount()  {
        $id = $_POST['id'];
        $data = [
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'role' => $this->request->getVar('role'),
        ];

        if ($id != null) {
            $this->account->set($data)->where('id', $id)->update();
        } else {
            $this->account->save($data);
        }
        if(!session()->get('isLoggedIn'))
        {
            return redirect()->to('login');
        }
        else
            {
                $session = session();
                session_start();
                $data = [
                    'currentuser' => $_SESSION['username'],
                    'account' => $this->account->findAll(),
                    'acc' => $this->account->where('id', $id)->first(),
                ];
                
                return view('admin', $data);
            }
    }

    public function deleteAccount($id)
    {
        $this->account->delete($id);
        if(!session()->get('isLoggedIn'))
        {
            return redirect()->to('login');
        }
        else
            {
                $session = session();
                session_start();
                $data = [
                    'currentuser' => $_SESSION['username'],
                    'account' => $this->account->findAll(),
                    'acc' => $this->account->where('id', $id)->first(),
                ];

                return view('admin', $data);
    }
    }

    public function editAccount($id)
    {
        if(!session()->get('isLoggedIn'))
        {
            return redirect()->to('login');
        }
        else
        {
            $session = session();
            session_start();
        $data = [
            'currentuser' => $_SESSION['username'],
            'account' => $this->account->findAll(),
            'acc' => $this->account->where('id', $id)->first(),
        ];

        return view('admin', $data);
        }
    }

}
