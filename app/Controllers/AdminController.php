<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TeacherModel;
use App\Models\AlumniModel;
use App\Models\AccountModel;

class AdminController extends BaseController
{
    
    private $teacher, $alumni, $account;
    public function __construct()
    {
        $this->teacher = new TeacherModel();
        $this->alumni = new AlumniModel();
        $this->account = new AccountModel();
    }

    public function index()
    {
            $data = [
                'currentuser' => $_SESSION['username'],
                'account' => $this->account->findAll(),
                ];
            return view ('admin', $data);
    }

    public function alumni()
    {
            $data = [
                'currentuser' => $_SESSION['username'],
                'alumni' => $this->alumni->findAll(),
                ];
            return view ('alumni', $data);
    }

    public function addTeacher()
    {
            $data = [
                'currentuser' => $_SESSION['username'],
                'teacher' => $this->teacher->findAll(),
                ];
                return view('adminteach', $data);
    }

    public function save()  {
        $session = session();
        $id = $_POST['id'];
        $data = [
            'idnum' => $this->request->getVar('idnum'),
            'fname' => $this->request->getVar('fname'),
            'mname' => $this->request->getVar('mname'),
            'lname' => $this->request->getVar('lname'),
            'dob' => $this->request->getVar('dob'),
        ];

        if ($id != null) {
            $res = $this->teacher->set($data)->where('id', $id)->update();
            if($res) {
                $session->setFlashdata('msg','Updated Successfully.');
                return redirect()->to('adminteach');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
                return redirect()->to('adminteach');
            }
        } else {
            $res = $this->teacher->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
                return redirect()->to('adminteach');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
                return redirect()->to('adminteach');
            }
        }  
    }

    public function delete($id)
    {
        $session = session();
        $res = $this->teacher->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
            return redirect()->to('adminteach');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
            return redirect()->to('adminteach');
        }
    }

    public function edit($id)
    {
        $data = [
            'currentuser' => $_SESSION['username'],
            'teacher' => $this->teacher->findAll(),
            'prof' => $this->teacher->where('id', $id)->first(),
        ];

        return view('adminteach', $data);
        
    }

    
    public function saveAlumni()  {
        $session = session();
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
            $res = $this->alumni->set($data)->where('id', $id)->update();
            if($res) {
                $session->setFlashdata('msg','Updated Successfully.');
                return redirect()->to('alumni');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
                return redirect()->to('alumni');
            }
        } else {
            $res = $this->alumni->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
                return redirect()->to('alumni');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
                return redirect()->to('alumni');
            }
        }   
    }

    public function deleteAlumni($id)
    {
        $session = session();
        $res = $this->alumni->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
            return redirect()->to('alumni');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
            return redirect()->to('alumni');
        }
    }

    
    public function editAlumni($id)
    {
        $data = [
            'currentuser' => $_SESSION['username'],
            'alumni' => $this->alumni->findAll(),
            'alum' => $this->alumni->where('id', $id)->first(),
        ];

        return view('alumni', $data);
        
    }

    
    public function saveAccount()  {
        $session = session();
        $id = $_POST['id'];
        $data = [
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'role' => $this->request->getVar('role'),
            'status' => $this->request->getVar('status'),
            'suspension' => $this->request->getVar('suspension'),
        ];

        if ($id != null) {
            $res = $this->account->set($data)->where('id', $id)->update();
            if($res) {
                $session->setFlashdata('msg','Updated Successfully.');
                return redirect()->to('admin');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
                return redirect()->to('admin');
            }
        } else {
            $res = $this->account->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
                return redirect()->to('admin');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
                return redirect()->to('admin');
            }
        }  
    }

    public function deleteAccount($id)
    {
        $session = session();
        $res = $this->account->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
            return redirect()->to('admin');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
            return redirect()->to('admin');
        }
    }

    public function editAccount($id)
    {
        $data = [
            'currentuser' => $_SESSION['username'],
            'account' => $this->account->findAll(),
            'acc' => $this->account->where('id', $id)->first(),
        ];

        return view('admin', $data);
        
    }

}
