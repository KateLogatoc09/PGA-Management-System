<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GradeModel;
use App\Models\Subjects;
use App\Models\AccountModel;
use App\Models\TeacherModel;
use App\Models\AdmissionsModel;
use App\Models\LearnerModel;
use App\Models\AddressModel;
use App\Models\FamilyModel;

use App\Models\Sections;
use SimpleSoftwareIO\QrCode\Generator;

class TeacherController extends BaseController
{
    private $grade, $subjects, $acc, $teacher, $admissions, $learner, $sections, $family, $address;
    public function __construct()
    {
        $this->grade = new GradeModel();
        $this->family = new FamilyModel();
        $this->address = new AddressModel();
        $this->subjects = new Subjects();
        $this->sections = new Sections();
        $this->acc = new AccountModel();
        $this->teacher = new TeacherModel();
        $this->admissions = new AdmissionsModel();
        $this->learner = new LearnerModel();
    }

    
    public function teacher_qr() {
        $curruser = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
        $id = $this->teacher->select('idnum')->where('account_id', $curruser)->first();
        $qrcode = new Generator;
        $session = session();
        $session->setFlashdata('qr', $qrcode->size(120)->generate($id['idnum']));
        return redirect()->to('teacher');
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
        $session = session();
        $curruser = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
        $teachid = $this->teacher->select('idnum')->where('account_id', $curruser)->first();

            $data = [
                'grade' => $this->grade->select('student_grades.id as id, student_grades.student_id, idnum, subject, grade, first_name, middle_name, last_name, name, subject_name, teacher_id')
                ->join('teachers','student_grades.teacher_account = teachers.id','inner')
                ->join('admissions','student_grades.student_id = admissions.student_id','inner')->join('student_learner','student_learner.account_id = admissions.account_id','inner')
                ->join('sections','sections.id = admissions.section','inner')->join('subjects','subjects.id = student_grades.subject','inner')->where('teacher_id', $teachid)->findAll(),
                'learner' => $this->admissions->select('admissions.student_id as id, student_id, first_name, middle_name, last_name')->join('student_learner','student_learner.account_id = admissions.account_id','inner')
                ->join('sections','sections.id = admissions.section','inner')->orderBy('student_learner.last_name')->FindAll(),
                'subject' => $this->subjects->findAll(),
                ];
            return view ('grade', $data);
    }

    
    public function advisoryClass()
    {
        $session = session();
        $curruser = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
        $teachid = $this->teacher->select('idnum')->where('account_id', $curruser)->first();

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname, admissions.account_id')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')
            ->join('sections','sections.id = admissions.section','left')->join('teachers','sections.adviser = teachers.idnum','inner')
            ->where('adviser', $teachid)->orderBy('student_learner.last_name')->FindAll(),
            'section' => $this->sections->select('adviser, name')->where('adviser', $teachid)->first(),
       ];
        return view('advisoryClass', $data);
    }

    public function searchAdvisory()
    {
        $session = session();
        $curruser = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
        $teachid = $this->teacher->select('idnum')->where('account_id', $curruser)->first();

        if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname, admissions.account_id')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')
            ->join('sections','sections.id = admissions.section','left')->join('teachers','sections.adviser = teachers.idnum','inner')->like($categ, $this->request->getVar('search'))
            ->where('adviser', $teachid)->orderBy('student_learner.last_name')->FindAll(),
            'section' => $this->sections->select('adviser, name')->where('adviser', $teachid)->first(),
       ];
        return view('advisoryClass', $data);
    }

    public function expandStudent($id)
    {
     $expand = $this->acc->select('id')->where('id', $id)->first();
     $admi = $this->admissions->select('student_id')->where('account_id', $expand)->first();
     $sub = $this->grade->select('student_id')->where('student_grades.student_id', $admi)->first();
     
        $data = [
            'learn' => $this->learner->where('student_learner.account_id', $expand)->first(),
            'ad' => $this->admissions->select('student_id, name, category,yr_lvl,program, status, admissions.photo, schedule, fname, mname, lname')
             ->join('sections','sections.id = admissions.section','left')->join('teachers','sections.adviser = teachers.idnum','left')
             ->where('admissions.account_id', $expand)->first(),
            'fam' => $this->family->where('family.account_id', $expand)->FindAll(),
            'address' => $this->address->where('address.account_id', $expand)->FindAll(), 
            'grade' => $this->grade->select('subject_name, type, fname, mname, lname, subject, grade')
            ->join('admissions','student_grades.student_id = admissions.student_id','inner')
            ->join('subjects','student_grades.subject = subjects.id','inner')->join('teachers','subjects.teacher_id = teachers.idnum','inner')
            ->where('admissions.student_id', $sub)->FindAll(), 
        ];
 
        return view('expandStudent', $data);
    }

    public function searchGrade()
    {
        $session = session();
        $curruser = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
        $teachid = $this->teacher->select('idnum')->where('account_id', $curruser)->first();

        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else {
            $categ = $this->request->getVar('categ');
        }
        
            $data = [
                'grade' => $this->grade->select('student_grades.id as id, student_grades.student_id, idnum, subject, grade, first_name, middle_name, last_name, name, subject_name, teacher_id')
                ->join('teachers','student_grades.teacher_account = teachers.id','inner')
                ->join('admissions','student_grades.student_id = admissions.student_id','inner')->join('student_learner','student_learner.account_id = admissions.account_id','inner')
                ->join('sections','sections.id = admissions.section','inner')->join('subjects','subjects.id = student_grades.subject','inner')->where('teacher_id', $teachid)
                ->like($categ, $this->request->getVar('search'))->FindAll(),
                'learner' => $this->admissions->select('admissions.student_id as id, student_id, first_name, middle_name, last_name')->join('student_learner','student_learner.account_id = admissions.account_id','inner')
                ->join('sections','sections.id = admissions.section','inner')->orderBy('student_learner.last_name')->FindAll(),
                'subject' => $this->subjects->findAll(),
                ];
            return view ('grade', $data);
    }
    
        public function saveGrade()  {
            $session = session();
            $id = $_POST['id'];
            //get curr user id
            $curruser = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
            //get idnum of curr user id
            $teachid = $this->teacher->select('idnum')->where('account_id', $curruser)->first();
            //get subjects handled by the curr user
            $sub = $this->subjects->where('teacher_id', $teachid)->findAll();

            //get stud id
            $tid = $this->request->getVar('student_id');
            //testing if user exists
            $re = $this->admissions->select('student_id')->where('student_id', $tid)->first();

            $data = [
                'teacher_account' => $this->teacher->select('teachers.id')
                ->join('accounts','accounts.id = teachers.account_id','inner')->where('username', $_SESSION['username'])->first(),
                'subject' => $this->request->getVar('subject'),
                'grade' => $this->request->getVar('grade'),
            ];

            if($re) {
                $data['student_id'] = $tid;
            } else {
                $session->setFlashdata('msg','Student doesn\'t exist.');
                return redirect()->to('grade');
            }
            if(is_array($sub)) {
                foreach($sub as $s) {
                    if($this->request->getVar('subject') != $s['id']){
                        $session->setFlashdata('msg','You don\'t handle this subject.');
                        return redirect()->to('grade');
                    }
                }
            } else {
                $session->setFlashdata('msg','You don\'t handle this subject.');
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
            $session = session();
            $curruser = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
            $teachid = $this->teacher->select('idnum')->where('account_id', $curruser)->first();
    
                $data = [
                    'grade' => $this->grade->select('student_grades.id as id, student_grades.student_id, idnum, subject, grade, first_name, middle_name, last_name, name, subject_name, teacher_id')
                    ->join('teachers','student_grades.teacher_account = teachers.id','inner')
                    ->join('admissions','student_grades.student_id = admissions.student_id','inner')->join('student_learner','student_learner.account_id = admissions.account_id','inner')
                    ->join('sections','sections.id = admissions.section','inner')->join('subjects','subjects.id = student_grades.subject','inner')->where('teacher_id', $teachid)->findAll(),
                    'learner' => $this->admissions->select('admissions.student_id as id, student_id, first_name, middle_name, last_name')->join('student_learner','student_learner.account_id = admissions.account_id','inner')
                    ->join('sections','sections.id = admissions.section','inner')->orderBy('student_learner.last_name')->FindAll(),
                    'subject' => $this->subjects->findAll(),
                'gr' => $this->grade->where('id', $id)->first(),
            ];
    
            return view('grade', $data);
            
        }

        public function simple_qr() {
            $curruser = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
            $id = $this->teacher->select('idnum')->where('account_id', $curruser)->first();
            $qrcode = new Generator;
            $session = session();
            $session->setFlashdata('qr', $qrcode->size(120)->generate($id['idnum']));
            return redirect()->to('teacher');
        }
}
