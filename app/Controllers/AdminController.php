<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TeacherModel;
use App\Models\AlumniModel;
use App\Models\AccountModel;
use App\Models\LearnerModel;
use App\Models\AddressModel;
use App\Models\AdmissionsModel;
use App\Models\SiblingModel;
use App\Models\FamilyModel;
use App\Models\SchoolAttendedModel;

class AdminController extends BaseController
{
    
    private $teacher, $alumni, $account, $learner, $family, $address, $admissions, $sibling, $school;
    public function __construct()
    {
        $this->teacher = new TeacherModel();
        $this->alumni = new AlumniModel();
        $this->account = new AccountModel();
        $this->learner = new LearnerModel();
        $this->family = new FamilyModel();
        $this->address = new AddressModel();
        $this->admissions = new AdmissionsModel();
        $this->sibling = new SiblingModel();
        $this->school = new SchoolAttendedModel();
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
                return redirect()->to('addTeacher');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
                return redirect()->to('addTeacher');
            }
        } else {
            $res = $this->teacher->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
                return redirect()->to('addTeacher');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
                return redirect()->to('addTeacher');
            }
        }  
    }

    public function delete($id)
    {
        $session = session();
        $res = $this->teacher->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
            return redirect()->to('addTeacher');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
            return redirect()->to('addTeacher');
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
                return redirect()->to('admins');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
                return redirect()->to('admins');
            }
        } else {
            $res = $this->account->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
                return redirect()->to('admins');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
                return redirect()->to('admins');
            }
        }  
    }

    public function deleteAccount($id)
    {
        $session = session();
        $res = $this->account->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
            return redirect()->to('admins');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
            return redirect()->to('admins');
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

    public function adminstudent()
    {
        $data = [
            'currentuser' => $_SESSION['username'],
            'learner' => $this->admissions->select('*')->join('student_learner','student_learner.account_id = admissions.account_id','right')->orderBy('student_learner.last_name')->FindAll(),
        ];
        return view('adminstudent', $data);
    }

    public function admininfoadmissions()
    {
        $data = [
            'currentuser' => $_SESSION['username'],
            'student' => $this->learner->select('*')->join('admissions','admissions.account_id = student_learner.account_id','inner')->orderBy('student_learner.last_name')->FindAll(),
        ];
        return view('admininfoadmissions', $data);
    }

    
    public function adminadmissions()  {
        $session = session();
        $id = $_POST['id'];
        $data = [
            'student_id' => $this->request->getVar('student_id'),
            'category' => $this->request->getVar('category'),
            'yr_lvl' => $this->request->getVar('yr_lvl'),
            'section' => $this->request->getVar('section'),
            'program' => $this->request->getVar('program'),
            'status' => $this->request->getVar('status'),
            'account_id' => $this->request->getVar('account_id'),
        ];

        if ($id != null) {
            $res = $this->admissions->set($data)->where('id', $id)->update();
            if($res) {
                $session->setFlashdata('msg','Updated Successfully.');
                return redirect()->to('admininfoadmissions');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
                return redirect()->to('admininfoadmissions');
            }
        } else {
            $res = $this->admissions->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
                return redirect()->to('admininfoadmissions');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
                return redirect()->to('admininfoadmissions');
            }
        }  
    }

    public function deleteAdmissions($id)
    {
        $session = session();
        $res = $this->admissions->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
            return redirect()->to('admininfoadmissions');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
            return redirect()->to('admininfoadmissions');
        }
    }

    
    public function editAdmissions($id)
    {
        $data = [
            'currentuser' => $_SESSION['username'],
            'admissions' => $this->admissions->where('id', $id)->first(),
            'student' => $this->learner->select('*')->join('admissions','admissions.account_id = student_learner.account_id','inner')->orderBy('student_learner.last_name')->FindAll(),
        ];

        return view('admininfoadmissions', $data);
        
    }

    
    public function saveLearner()  {
        $session = session();
        $id = $_POST['id'];
        $photo = $this->request->getFile('photo');
        $check = $this->learner->select('photo')->where('account_id',$id)->first();
        
        if($photo != null) {

            if($id != null) {
                $test = $photo->move(PUBLIC_PATH.'\\account\\'.$id.'\\');
                $name = $photo->getClientPath();
                $path = '/account/'.$id.'/'.$name;
            } else {
                $test = $photo->move(PUBLIC_PATH.'\\account\\'.$this->request->getVar('account_id').'\\');
                $name = $photo->getClientPath();
                $path = '/account/'.$this->request->getVar('account_id').'/'.$name;
            }

            $data = [
                'id' => $this->request->getVar('id'),
                'first_name' => $this->request->getVar('first_name'),
                'middle_name' => $this->request->getVar('middle_name'),
                'last_name' => $this->request->getVar('last_name'),
                'nickname' => $this->request->getVar('nickname'),
                'age' => $this->request->getVar('age'),
                'gender' => $this->request->getVar('gender'),
                'marital_status' => $this->request->getVar('marital_status'),
                'birthdate' => $this->request->getVar('birthdate'),
                'birthplace' => $this->request->getVar('birthplace'),
                'mobile_num' => $this->request->getVar('mobile_num'),
                'nationality' => $this->request->getVar('nationality'),
                'religion' => $this->request->getVar('religion'),
                'photo' => $path,
                'account_id' => $this->request->getVar('account_id'),
            ];

            if ($id != null) {
                if($check) {
                unlink(PUBLIC_PATH.$check);
                }
                $res = $this->learner->set($data)->where('id', $id)->update();
                if($res) {
                    $session->setFlashdata('msg','Updated Successfully.');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
                
            } else {
                $res = $this->learner->save($data);
                if($res) {
                    $session->setFlashdata('msg','Saved Successfully.');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
            }  
        } else  {
            $data = [
                'id' => $this->request->getVar('id'),
                'first_name' => $this->request->getVar('first_name'),
                'middle_name' => $this->request->getVar('middle_name'),
                'last_name' => $this->request->getVar('last_name'),
                'nickname' => $this->request->getVar('nickname'),
                'age' => $this->request->getVar('age'),
                'gender' => $this->request->getVar('gender'),
                'marital_status' => $this->request->getVar('marital_status'),
                'birthdate' => $this->request->getVar('birthdate'),
                'birthplace' => $this->request->getVar('birthplace'),
                'mobile_num' => $this->request->getVar('mobile_num'),
                'nationality' => $this->request->getVar('nationality'),
                'religion' => $this->request->getVar('religion'),
                'account_id' => $this->account->select('id')->where('username', $_SESSION['username'])->first(),
            ];

            if ($id != null) {
                $res = $this->learner->set($data)->where('id', $id)->update();
                if($res) {
                    $session->setFlashdata('msg','Updated Successfully.');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
                
            } else {
                $res = $this->learner->save($data);
                if($res) {
                    $session->setFlashdata('msg','Saved Successfully.');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
            } 
        }
        return redirect()->to('adminstudent');
    }
    
    public function deleteLearner($id)
    {
        $session = session();
        $res = $this->learner->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
            return redirect()->to('adminstudent');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
            return redirect()->to('adminstudent');
        }
    }

    
    public function editLearner($id)
    {
        $data = [
            'currentuser' => $_SESSION['username'],
            'learner' => $this->admissions->select('*')->join('student_learner','student_learner.account_id = admissions.account_id','right')->orderBy('student_learner.last_name')->FindAll(),
            'learn' => $this->learner->where('id', $id)->first(),
        ];

        return view('adminstudent', $data);
    }

    public function adminstudinfo()
    {
        $data = [
            'family' => $this->learner->select('*')->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('family','family.account_id = student_learner.account_id','inner')->orderBy('student_learner.last_name')->FindAll(),
        ];

        return view('adminstudinfo', $data);
    }

    
    public function adminfamily()  {
        $session = session();
        $id = $_POST['id'];
        $data = [
            'id' => $this->request->getVar('id'),
            'relation' => $this->request->getVar('relation'), 
            'fullname' => $this->request->getVar('fullname'), 
            'res_add' => $this->request->getVar('res_add'),
            'off_add' => $this->request->getVar('off_add'), 
            'mob_num' => $this->request->getVar('mob_num'), 
            'off_num' => $this->request->getVar('off_num'), 
            'email' => $this->request->getVar('email'), 
            'occupation' => $this->request->getVar('occupation'),
            'account_id' => $this->request->getVar('account_id'),
        ];

        if ($id != null) {
            $res = $this->family->set($data)->where('id', $id)->update();
            if($res) {
                $session->setFlashdata('msg','Updated Successfully.');
                return redirect()->to('adminstudinfo');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
                return redirect()->to('adminstudinfo');
            }
        } else {
            $res = $this->family->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
                return redirect()->to('adminstudinfo');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
                return redirect()->to('adminstudinfo');
            }
        }  
    }

    
    public function deletefamily($id)
    {
        $session = session();
        $res = $this->family->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
            return redirect()->to('adminstudinfo');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
            return redirect()->to('adminstudinfo');
        }
    }

    
    public function editfamily($id)
    {
        $data = [
            'currentuser' => $_SESSION['username'],
            'family' => $this->learner->select('*')->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('family','family.account_id = student_learner.account_id','inner')->orderBy('student_learner.last_name')->FindAll(),
            'fam' => $this->family->where('id', $id)->first(),
        ];

        return view('adminstudinfo', $data);
    }

    public function admininfoaddress()
    {
        $data = [
            'address' => $this->learner->select('*')->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('address','address.account_id = student_learner.account_id','inner')->orderBy('student_learner.last_name')->FindAll(),
        ];

        return view('admininfoaddress', $data);
    }

    
    public function adminaddress()  {
        $session = session();
        $id = $_POST['id'];
        $data = [
            'id' => $this->request->getVar('id'),
            'type' => $this->request->getVar('type'),
            'address' => $this->request->getVar('address'),
            'postal_code' => $this->request->getVar('postal_code'),
            'tel_num' => $this->request->getVar('tel_num'),
            'account_id' => $this->request->getVar('account_id'),
        ];

        if ($id != null) {
            $res = $this->address->set($data)->where('id', $id)->update();
            if($res) {
                $session->setFlashdata('msg','Updated Successfully.');
                return redirect()->to('admininfoaddress');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
                return redirect()->to('admininfoaddress');
            }
        } else {
            $res = $this->address->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
                return redirect()->to('admininfoaddress');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
                return redirect()->to('admininfoaddress');
            }
        }  
    }

    public function deleteaddress($id)
    {
        $session = session();
        $res = $this->address->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
            return redirect()->to('admininfoaddress');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
            return redirect()->to('admininfoaddress');
        }
    }

    
    public function editaddress($id)
    {
        $data = [
            'currentuser' => $_SESSION['username'],
            'address' => $this->learner->select('*')->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('address','address.account_id = student_learner.account_id','inner')->orderBy('student_learner.last_name')->FindAll(),
            'add' => $this->address->where('id', $id)->first(),
        ];

        return view('admininfoaddress', $data);
    }

    public function admininfosibling()
    {
        $data = [
            'sibling' => $this->learner->select('*')->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sibling','sibling.account_id = student_learner.account_id','inner')->orderBy('student_learner.last_name')->FindAll(),
        ];

        return view('admininfosibling', $data);
    }

    public function adminsibling()  {
        $session = session();
        $id = $_POST['id'];
        $data = [
            'id' => $this->request->getVar('id'),
            'fullname' => $this->request->getVar('fullname'),
            'yr_lvl' => $this->request->getVar('yr_lvl'),
            'affiliation' => $this->request->getVar('affiliation'),
            'account_id' => $this->request->getVar('account_id'),
        ];

        if ($id != null) {
            $res = $this->sibling->set($data)->where('id', $id)->update();
            if($res) {
                $session->setFlashdata('msg','Updated Successfully.');
                return redirect()->to('admininfosibling');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
                return redirect()->to('admininfosibling');
            }
        } else {
            $res = $this->sibling->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
                return redirect()->to('admininfosibling');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
                return redirect()->to('admininfosibling');
            }
        }  
    }

    public function deletesibling($id)
    {
        $session = session();
        $res = $this->sibling->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
            return redirect()->to('admininfosibling');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
            return redirect()->to('admininfosibling');
        }
    }

    
    public function editsibling($id)
    {
        $data = [
            'currentuser' => $_SESSION['username'],
            'sibling' => $this->learner->select('*')->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sibling','sibling.account_id = student_learner.account_id','inner')->orderBy('student_learner.last_name')->FindAll(),
            'sib' => $this->sibling->where('id', $id)->first(),
        ];

        return view('admininfosibling', $data);
    }
}
