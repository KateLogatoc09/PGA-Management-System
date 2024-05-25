<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnnouncementModel;
use App\Models\TeacherModel;
use App\Models\AccountModel;
use App\Models\FeedbackModel;

class AdminController extends BaseController
{
    
    private $teacher, $account, $feedback, $announce, $config, $encrypter;
    public function __construct()
    {
        $this->teacher = new TeacherModel();
        $this->account = new AccountModel();
        $this->feedback = new FeedbackModel();
        $this->announce = new AnnouncementModel();
        $this->config    = new \Config\Encryption();  
        $this->encrypter = \Config\Services::encrypter($this->config);
    }

    public function index()
    {
            $data = [
                'account' => $this->account->where('role !=', 'ADMIN')->orderBy('username')->findAll(),
                ];
            return view ('admin', $data);
    }

    public function feedbackview()
    {
            $data = [
                'feedback' => $this->feedback->select('feedback.id as id, rating, comment, email')
                ->join('accounts','accounts.id = feedback.account_id','inner')->findAll(),
                ];
            return view ('feedbackview', $data);
    }

    public function searchAccount()
    {
        $categ = $this->request->getVar('categ');
            $data = [
                'account' => $this->account->where('role !=', 'ADMIN')->like($categ, $this->request->getVar('search'))->orderBy('username')->findAll(),
                ];
            return view ('admin', $data);
    }

    public function announce()
    {
            return view ('announce');
    }

    public function addTeacher()
    {
            $data = [
                'teacher' => $this->teacher->orderBy('lname')->findAll(),
                ];
                return view('adminteach', $data);
    }


    public function searchTeacher()
    {
        if($this->request->getVar('categ') == 'Teacher') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

            $data = [
                'teacher' => $this->teacher->like($categ, $this->request->getVar('search'))->orderBy('lname')->findAll(),
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
            'age' => $this->request->getVar('age'),
            'gender' => $this->request->getVar('gender'),
            'dob' => $this->request->getVar('dob'),
            'address' => $this->request->getVar('address'),
            'phone' => $this->request->getVar('phone'),
        ];

        if ($id != null) {
            $res = $this->teacher->set($data)->where('id', $id)->update();
            if($res) {
                $session->setFlashdata('msg','Updated Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        } else {
            $res = $this->teacher->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        }  
        return redirect()->to('addTeacher');
    }

    public function delete($id)
    {
        $session = session();
        $res = $this->teacher->delete($this->encrypter->decrypt(hex2bin($id)));
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
        }
        return redirect()->to('addTeacher');
    }

    public function edit($id)
    {
        $data = [
            'teacher' => $this->teacher->findAll(),
            'prof' => $this->teacher->where('id', $this->encrypter->decrypt(hex2bin($id)))->first(),
        ];

        return view('adminteach', $data);
        
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
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        } else {
            $res = $this->account->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        }  
        return redirect()->to('admins');
    }

    public function deleteAccount($id)
    {
        $session = session();
        $res = $this->account->delete($this->encrypter->decrypt(hex2bin($id)));
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
        }
        return redirect()->to('admins');
    }

    public function editAccount($id)
    {
        $data = [
            'account' => $this->account->where('role !=', 'ADMIN')->findAll(),
            'acc' => $this->account->where('id', $this->encrypter->decrypt(hex2bin($id)))->first(),
        ];

        return view('admin', $data);
        
    }


    public function addannounce() {
        $session = session();
        $attach = $this->request->getFile('attachment');
        $data = [
            'subject' => $this->request->getVar('subject'),
            'content' => $this->request->getVar('content'),
            'date' => date("Y-m-d H:i:s")
        ];

        if($attach != '') {
            $date = date("Y-m-d");
            $attach->move(PUBLIC_PATH.'\\announcement\\'.$date.'\\');
            $name = $attach->getClientPath();
            $path = '/announcement/'.$date.'/'.$name;
            $data['attachment'] = $path;
        }

        $res = $this->announce->save($data);
        if($res) {
            $session->setFlashdata('msg','Saved Successfully.');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
        }

        return redirect()->to('announce');
    }
}
