<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TeacherModel;

class AdminController extends BaseController
{
    
    private $teacher;
    public function __construct()
    {
        $this->teacher = new TeacherModel();
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
                'teacher' => $this->teacher->findAll(),
                ];
            return view ('admin', $data);
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
                return view('admin', $data);
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
                
                return view('admin', $data);
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

                return view('admin', $data);
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

        return view('admin', $data);
        }
    }
}
