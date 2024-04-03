<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GradeModel;
use App\Models\Subjects;
use App\Models\AccountModel;
use App\Models\TeacherModel;
use App\Models\AdmissionsModel;
use App\Models\LearnerModel;

class TeacherController extends BaseController
{
    private $grade, $subjects, $acc, $teacher, $admissions, $learner;
    public function __construct()
    {
        $this->grade = new GradeModel();
        $this->subjects = new Subjects();
        $this->acc = new AccountModel();
        $this->teacher = new TeacherModel();
        $this->admissions = new AdmissionsModel();
        $this->learner = new LearnerModel();
    }

    public function teacher()
    {
        $session = session();
        $curruser = $this->acc->select('id')->where('username', $_SESSION['username'])->first();

        $data = [
            'teach' => $this->teacher->where('account_id', $curruser)->first(),
        ];

        return view('teacher', $data);
    }
    
    public function teacherinfo(){
        $session = session();
        $curruser = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
        
        $data = [
            'prof' => $this->teacher->where('account_id', $curruser)->first(),
        ];
            return view ('teacherinfo', $data);
        }


    public function teachersave()  {
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
                'account_id' => $this->acc->select('id')->where('username', $_SESSION['username'])->first(),
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
            return redirect()->to('teacher');
        }

        public function grade()
    {
            $data = [
                'grade' => $this->teacher->select('*')->join('student_grades','teachers.id = student_grades.teacher_account','inner')->findAll(),
                'learner' => $this->admissions->select('admissions.student_id as id, student_id, first_name, middle_name, last_name')->join('student_learner','student_learner.account_id = admissions.account_id','inner')
                ->join('sections','sections.id = admissions.section','inner')->orderBy('student_learner.last_name')->FindAll(),
                'subject' => $this->subjects->findAll(),
                ];
            return view ('grade', $data);
    }
    
        public function saveGrade()  {
            $session = session();
            $id = $_POST['id'];
            $sid = $this->request->getVar('student_id');
            $res = $this->admissions->select('admissions.student_id')->where('admissions.student_id', $sid)->first();

            $data = [
                'teacher_account' => $this->teacher->select('teachers.id')
                ->join('accounts','accounts.id = teachers.account_id','inner')->where('username', $_SESSION['username'])->first(),
                'subject' => $this->request->getVar('subject'),
                'grade' => $this->request->getVar('grade'),
            ];

            if($res) {
                $data['student_id'] = $sid;
            } else {
                $session->setFlashdata('msg','Student doesn\'t exist.');
                return redirect()->to('grade');
            }
    
            if ($id != null) {
                $res = $this->grade->set($data)->where('id', $id)->update();
                if($res) {
                    $session->setFlashdata('msg','Updated Successfully.');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
            } else {
                $res = $this->grade->save($data);
                if($res) {
                    $session->setFlashdata('msg','Saved Successfully.');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
            }   
            return redirect()->to('grade');
        }
    
        public function deleteGrade($id)
        {
            $session = session();
            $res = $this->grade->delete($id);
            if($res) {
                $session->setFlashdata('msg','Deleted Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
            return redirect()->to('grade');
        }
    
        
        public function editGrade($id)
        {
            $data = [
                'grade' => $this->teacher->select('*')->join('student_grades','teachers.id = student_grades.teacher_account','inner')->findAll(),
                'learner' => $this->admissions->select('*')->join('student_learner','student_learner.account_id = admissions.account_id','inner')
                ->join('sections','sections.id = admissions.section','inner')->orderBy('student_learner.last_name')->FindAll(),
               'subject' => $this->subjects->findAll(),
                'gr' => $this->grade->where('id', $id)->first(),
            ];
    
            return view('grade', $data);
            
        }
}
