<?php

namespace App\Controllers;
use App\Models\Subjects;
use App\Models\Sections;
use App\Models\TeacherModel;
use App\Models\LearnerModel;
use App\Models\ScheduleModel;

use App\Controllers\BaseController;

class AACController extends BaseController
{
    private $section, $subjects, $learner, $teacher, $schedule, $config, $encrypter;
    public function __construct()
    {
        $this->sections = new Sections();
        $this->subjects = new Subjects();
        $this->teacher = new TeacherModel();
        $this->learner = new LearnerModel();
        $this->schedule = new ScheduleModel();
        $this->config    = new \Config\Encryption();  
        $this->encrypter = \Config\Services::encrypter($this->config);
    }

    public function AAC(){
            return view ('AAC');
        }
    
        
    public function schedule(){
        $data = [
            'schedule' => $this->schedule->select('schedule.id as id, day, start_time, end_time, name, subject')
            ->join('sections','schedule.section_id = sections.id','inner')->findAll(),
            'subject' => $this->subjects->findAll(),
            'section' => $this->sections->findAll(),
        ];

        return view ('schedule', $data);
    }

       
    public function scheduleList(){
        $data = [
            'stud_section' => $this->sections->select('sections.id as id, name, grade_level_id, adviser, fname, mname, lname')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->findAll(),
            'teacher' => $this->teacher->orderBy('lname')->findAll(),
        ];

        return view ('scheduleList', $data);
    }

    public function deleteSchedule($id)
        {
            $session = session();
            $res = $this->schedule->delete($id);
            if($res) {
                $session->setFlashdata('msg','Deleted Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
            return redirect()->to('schedule');
        }
    
        
        public function editSchedule($id)
        {
            $data = [
                'schedule' => $this->schedule->select('schedule.id as id, day, start_time, end_time, name, subject')
                ->join('sections','schedule.section_id = sections.id','inner')->findAll(),
                'subject' => $this->subjects->findAll(),
                'section' => $this->sections->findAll(),
                'sched' => $this->schedule->where('id', $id)->first(),
            ];
    
            return view('schedule', $data);
        }

    public function saveSchedule()  {
        $session = session();
        $id = $_POST['id'];
        $data = [
            'day' => $this->request->getPost('day'),
            'subject' => $this->request->getPost('subject'),
            'start_time' => $this->request->getPost('start_time'),
            'end_time' => $this->request->getPost('end_time'),
            'section_id' => $this->request->getPost('section_id'),
        ];

        if ($id != null) {
            $res = $this->schedule->set($data)->where('id', $id)->update();
            if($res) {
                $session->setFlashdata('msg','Updated Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        } else {
            $res = $this->schedule->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        }   
        return redirect()->to('schedule');
    }

        public function aacsections()
        {
            $data = [
                'stud_section' => $this->sections->select('sections.id as id, name, grade_level_id, adviser, fname, mname, lname')
                ->join('teachers','sections.adviser = teachers.idnum','inner')->findAll(),
                'teacher' => $this->teacher->orderBy('lname')->findAll(),
            ];
                return view ('aacsections', $data);
        }
        
    public function searchAacsection()
    {
        if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'stud_section' => $this->sections->select('sections.id as id, name, grade_level_id, adviser, fname, mname, lname')
                ->join('teachers','sections.adviser = teachers.idnum','inner')->like($categ, $this->request->getVar('search'))->findAll(),
            'teacher' => $this->teacher->orderBy('lname')->findAll(),
        ];
            return view ('aacsections', $data);
    }
    
        public function aacsaveSection()  {
            $session = session();
            $id = $_POST['id'];
            $tid = $this->request->getVar('adviser');
            $re = $this->teacher->select('idnum')->where('idnum', $tid)->first();

            $data = [
                'name' => $this->request->getVar('name'),
                'grade_level_id' => $this->request->getVar('grade_level_id'),
            ];

            if($re) {
                $data['adviser'] = $tid;
            } else {
                $session->setFlashdata('msg','Teacher doesn\'t exist.');
                return redirect()->to('aacsections');
            }
    
            if ($id != null) {
                $res = $this->sections->set($data)->where('id', $id)->update();
                if($res) {
                    $session->setFlashdata('msg','Updated Successfully.');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
            } else {
                $res = $this->sections->save($data);
                if($res) {
                    $session->setFlashdata('msg','Saved Successfully.');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
            }   
          
            return redirect()->to('aacsections');
        }
    
        public function aacdeleteSection($id)
        {
            $session = session();
            $res = $this->sections->delete($this->encrypter->decrypt(hex2bin($id)));
            if($res) {
                $session->setFlashdata('msg','Deleted Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
            return redirect()->to('aacsections');
        }
    
        
        public function aaceditSection($id)
        {
            $data = [
                'stud_section' => $this->sections->select('sections.id as id, name, grade_level_id, adviser, fname, mname, lname')
                ->join('teachers','sections.adviser = teachers.idnum','inner')->findAll(),
                'teacher' => $this->teacher->orderBy('lname')->findAll(),
                'sec' => $this->sections->where('id', $this->encrypter->decrypt(hex2bin($id)))->first(),
            ];
    
            return view('aacsections', $data);
        }
    
        
        public function aacsubjects()
        {
            $data = [
                'subject' => $this->subjects->select('subjects.id as id, subject_name, type, teacher_id, yr_lvl, fname, mname, lname')
                ->join('teachers','subjects.teacher_id = teachers.idnum','inner')->orderBy('subject_name')->findAll(),
                'teacher' => $this->teacher->orderBy('lname')->findAll(),
            ];
                return view ('aacsubjects', $data);
        }

        
    public function searchAacsubject()
    {
        if($this->request->getVar('categ') == 'Teacher') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'subject' => $this->subjects->select('subjects.id as id, subject_name, type, teacher_id, yr_lvl, fname, mname, lname')
            ->join('teachers','subjects.teacher_id = teachers.idnum','inner')->like($categ, $this->request->getVar('search'))->orderBy('subject_name')->findAll(),
            'teacher' => $this->teacher->orderBy('lname')->findAll(),
        ];
            return view ('aacsubjects', $data);
    }
    
        public function aacsaveSubject()  {
            $session = session();
            $id = $_POST['id'];
            $tid = $this->request->getVar('teacher_id');
            $re = $this->teacher->select('*')->where('idnum', $tid)->first();

            $data = [
                'subject_name' => $this->request->getVar('subject_name'),
                'type' => $this->request->getVar('type'),
                'yr_lvl' => $this->request->getVar('yr_lvl'),
            ];

            if($re) {
                $data['teacher_id'] = $tid;
            } else {
                $session->setFlashdata('msg','Teacher doesn\'t exist.');
                return redirect()->to('aacsubjects');
            }
    
            if ($id != null) {
                $res = $this->subjects->set($data)->where('id', $id)->update();
                if($res) {
                    $session->setFlashdata('msg','Updated Successfully.');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
            } else {
                $res = $this->subjects->save($data);
                if($res) {
                    $session->setFlashdata('msg','Saved Successfully.');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
            }   
          
            return redirect()->to('aacsubjects');
        }
    
        public function aacdeleteSubject($id)
        {
            $session = session();
            $res = $this->subjects->delete($this->encrypter->decrypt(hex2bin($id)));
            if($res) {
                $session->setFlashdata('msg','Deleted Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
            return redirect()->to('aacsubjects');
        }
    
        
        public function aaceditSubject($id)
        {
            $data = [
                'subject' => $this->subjects->select('subjects.id as id, subject_name, type, teacher_id, yr_lvl, fname, mname, lname')
                ->join('teachers','subjects.teacher_id = teachers.idnum','inner')->orderBy('subject_name')->findAll(),
                'teacher' => $this->teacher->orderBy('lname')->findAll(),
                'sub' => $this->subjects->where('id', $this->encrypter->decrypt(hex2bin($id)))->first(),
            ];
    
            return view('aacsubjects', $data);
        }

    public function St_Joseph_Husband_of_Mary()
    {
        
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '1')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Joseph_Husband_of_Mary', $data);
    }

    public function searchJoseph_Husband_of_Mary()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '1')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Joseph_Husband_of_Mary', $data);
    }

    public function St_Perpetua_and_Felicity()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '2')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Perpetua_and_Felicity', $data);
    }


    public function searchPerpetua_felicity()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '2')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Perpetua_and_Felicity', $data);
    }

    public function St_Louise_de_Marillac()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '3')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Louise_de_Marillac', $data);
    }

    public function searchLouise()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '3')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Louise_de_Marillac', $data);
    }

    public function St_Dominic_Savio()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '4')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Dominic_Savio', $data);
    }

    public function searchDominic()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '4')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Dominic_Savio', $data);
    }

    public function St_Pedro_Calungsod()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '5')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Pedro_Calungsod', $data);
    }

    public function searchPedro()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '5')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Pedro_Calungsod', $data);
    }

    public function St_Gemma_Galgani()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '6')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Gemma_Galgani', $data);
    }

    public function searchGemma()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '6')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Gemma_Galgani', $data);
    }

    public function St_Catherine_of_Siena()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '7')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Catherine_of_Siena', $data);
    }

    public function searchCatherine()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '7')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Catherine_of_Siena', $data);
    }

    public function St_Lawrence_of_Manila()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '8')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Lawrence_of_Manila', $data);
    }

    
    public function searchLawrence()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '8')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Lawrence_of_Manila', $data);
    }

    public function St_Pio_of_Pietrelcina()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '9')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Pio_of_Pietrelcina', $data);
    }

    public function searchPio()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '9')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Pio_of_Pietrelcina', $data);
    }

    public function St_Matthew_the_Evangelist()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '10')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Matthew_the_Evangelist', $data);
    }

    
    public function searchMatthew()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '10')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Matthew_the_Evangelist', $data);
    }

    public function St_Jerome_of_Stridon()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '11')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Jerome_of_Stridon', $data);
    }

    public function searchJerome()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '11')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Jerome_of_Stridon', $data);
    }

    public function St_Francis_of_Assisi()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '12')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Francis_of_Assisi', $data);
    }

    public function searchFrancis()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '12')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Francis_of_Assisi', $data);
    }

    public function St_Luke_the_Evangelist()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '13')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Luke_the_Evangelist', $data);
    }
    
    public function searchLuke()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '13')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Luke_the_Evangelist', $data);
    }

    public function St_Therese_of_Lisieux()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '14')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Therese_of_Lisieux', $data);
    }


    public function searchTherese()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')
            ->where('section', '14')->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Therese_of_Lisieux', $data);
    }

    public function St_Cecelia()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '15')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Cecelia', $data);
    }

    public function searchCecelia()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '15')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Cecelia', $data);
    }

    public function St_Martin_the_Porres()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '16')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Martin_the_Porres', $data);
    }


    public function searchMartin()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '16')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Martin_the_Porres', $data);
    }

    public function St_Albert_the_Great()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '17')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Albert_the_Great', $data);
    }

    public function searchAlbert()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '17')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Albert_the_Great', $data);
    }

    public function St_Stephen()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '18')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Stephen', $data);
    }

    
    public function searchStephen()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '18')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Stephen', $data);
    }

    public function St_Francis_Xavier()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '19')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Francis_Xavier', $data);
    }


    public function searchXavier()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '19')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Francis_Xavier', $data);
    }

    public function St_John_the_Beloved()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '20')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_John_the_Beloved', $data);
    }

    
    public function searchJohn()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '20')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_John_the_Beloved', $data);
    }

    public function St_Joseph_Freinademetz()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '21')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Joseph_Freinademetz', $data);
    }
    
    public function searchJoseph()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '21')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Joseph_Freinademetz', $data);
    }

    public function St_Thomas_Aquinas()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '22')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Thomas_Aquinas', $data);
    }

    
    public function searchThomas()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '22')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Thomas_Aquinas', $data);
    }

    public function St_Arnold_Janssen()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '23')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Arnold_Janssen', $data);
    }

    public function searchArnold()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '23')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Arnold_Janssen', $data);
    }

    public function St_Agatha_Sicily()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '24')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Agatha_Sicily', $data);
    }

    public function searchAgatha()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '24')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Agatha_Sicily', $data);
    }
    
    public function St_Scholastica()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '25')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Scholastica', $data);
    }

    public function searchScholastica()
    {
        if($this->request->getVar('categ') == 'Student') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else if($this->request->getVar('categ') == 'Adviser') {
            $categ = "CONCAT(fname,' ',mname,' ',lname)";
        } else {
            $categ = $this->request->getVar('categ');
        }

        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, fname, mname, lname')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->join('teachers','sections.adviser = teachers.idnum','inner')->where('section', '25')
            ->like($categ, $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Scholastica', $data);
    }
}
