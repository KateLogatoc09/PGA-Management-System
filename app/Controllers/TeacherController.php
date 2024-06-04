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
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Mpdf\Mpdf;


class TeacherController extends BaseController
{
    private $grade, $subjects, $acc, $teacher, $admissions, $learner, $sections, $family, $address, $config, $encrypter;
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
        $this->config    = new \Config\Encryption();  
        $this->encrypter = \Config\Services::encrypter($this->config);
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
                'grade' => $this->grade->select('student_grades.id as id, student_grades.student_id, idnum, school_year, subject, grade, first_name, middle_name, last_name, name, subject_name, teacher_id, quarter')
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
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, school_year, fname, mname, lname, admissions.account_id')
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
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program, school_year, fname, mname, lname, admissions.account_id')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')
            ->join('sections','sections.id = admissions.section','left')->join('teachers','sections.adviser = teachers.idnum','inner')->like($categ, $this->request->getVar('search'))
            ->where('adviser', $teachid)->orderBy('student_learner.last_name')->FindAll(),
            'section' => $this->sections->select('adviser, name')->where('adviser', $teachid)->first(),
       ];
        return view('advisoryClass', $data);
    }

    public function expandStudent($id)
    {
     $expand = $this->acc->select('id')->where('id', $this->encrypter->decrypt(hex2bin($id)))->first();
     $admi = $this->admissions->select('student_id')->where('account_id', $expand)->first();
     $sub = $this->grade->select('student_id')->where('student_grades.student_id', $admi)->first();
     
        $data = [
            'learn' => $this->learner->where('student_learner.account_id', $expand)->first(),
            'ad' => $this->admissions->select('student_id, name, category,yr_lvl,program, specialization, school_year, status, admissions.photo, schedule, fname, mname, lname')
             ->join('sections','sections.id = admissions.section','left')->join('teachers','sections.adviser = teachers.idnum','left')
             ->where('admissions.account_id', $expand)->first(),
            'fam' => $this->family->where('family.account_id', $expand)->FindAll(),
            'address' => $this->address->where('address.account_id', $expand)->FindAll(), 
            'grade' => $this->grade->select('subject_name, type, fname, mname, lname, subject, grade, quarter, school_year')
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
                'grade' => $this->grade->select('student_grades.id as id, student_grades.student_id, idnum, school_year, subject, grade, first_name, middle_name, last_name, name, subject_name, teacher_id, quarter')
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
            $re = $this->admissions->select('id, school_year')->where('student_id', $tid)->first();

            $data = [
                'teacher_account' => $this->teacher->select('teachers.id')
                ->join('accounts','accounts.id = teachers.account_id','inner')->where('username', $_SESSION['username'])->first(),
                'subject' => $this->request->getVar('subject'),
                'grade' => $this->request->getVar('grade'),
                'quarter' => $this->request->getVar('quarter'),
            ];

            if($re) {
                $data['student_id'] = $tid;
            } else {
                $session->setFlashdata('msg','Student doesn\'t exist.');
                return redirect()->to('grade');
            }

            if(is_array($sub)) {
                $counter = 0;
                foreach($sub as $s) {
                    if($this->request->getVar('subject') == $s['id']){
                        break;
                    } else if($counter == count( $sub ) - 1) {
                        $session->setFlashdata('msg','You don\'t handle this subject.');
                        return redirect()->to('grade');
                    }

                    $counter = $counter + 1;
                }
            } else {
                $session->setFlashdata('msg','You don\'t handle this subject.');
                return redirect()->to('grade');
            }
            
            if ($id != "") {
                //test for duplicate quarter
                $dupli2 = $dupli = $this->grade->select('student_grades.id as id, student_grades.student_id, idnum, school_year, subject, grade, first_name, middle_name, last_name, name, subject_name, teacher_id, quarter')
                ->join('teachers','student_grades.teacher_account = teachers.id','inner')
                ->join('admissions','student_grades.student_id = admissions.student_id','inner')->join('student_learner','student_learner.account_id = admissions.account_id','inner')
                ->join('sections','sections.id = admissions.section','inner')->join('subjects','subjects.id = student_grades.subject','inner')->where('teacher_id', $teachid)->where('quarter', $this->request->getVar('quarter'))->where('subject', $this->request->getVar('subject'))->where('school_year', $re['school_year'])->where('student_grades.id !=',$id)->FindAll();
                if($dupli2) {
                    $session->setFlashdata('msg','Duplicate Records.');
                } else {
                    $res = $this->grade->set($data)->where('id', $id)->update();
                    if($res) {
                        $session->setFlashdata('msg','Updated Successfully.');
                    } else {
                        $session->setFlashdata('msg','Something went wrong. Please try again later.');
                    }
                }
            } else {
                //test for duplicate quarter grade for sub in same AY
                $dupli = $this->grade->select('student_grades.id as id, student_grades.student_id, idnum, school_year, subject, grade, first_name, middle_name, last_name, name, subject_name, teacher_id, quarter')
                ->join('teachers','student_grades.teacher_account = teachers.id','inner')
                ->join('admissions','student_grades.student_id = admissions.student_id','inner')->join('student_learner','student_learner.account_id = admissions.account_id','inner')
                ->join('sections','sections.id = admissions.section','inner')->join('subjects','subjects.id = student_grades.subject','inner')->where('teacher_id', $teachid)->where('quarter', $this->request->getVar('quarter'))->where('subject', $this->request->getVar('subject'))->where('school_year', $re['school_year'])->where('student_grades.student_id', $tid)->FindAll();

                if($dupli) {
                    $session->setFlashdata('msg','Duplicate Records.');
                } else {
                    $data['admission_id'] = $re['id'];
                    $res = $this->grade->save($data);
                    if($res) {
                        $session->setFlashdata('msg','Saved Successfully.');
                    } else {
                        $session->setFlashdata('msg','Something went wrong. Please try again later.');
                    } 
                }
            }   
            return redirect()->to('grade');
        }
    
        public function deleteGrade($id)
        {
            $session = session();
            $res = $this->grade->delete($this->encrypter->decrypt(hex2bin($id)));
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
                    'grade' => $this->grade->select('student_grades.id as id, student_grades.student_id, idnum, school_year, subject, grade, first_name, middle_name, last_name, name, subject_name, teacher_id, quarter')
                    ->join('teachers','student_grades.teacher_account = teachers.id','inner')
                    ->join('admissions','student_grades.student_id = admissions.student_id','inner')->join('student_learner','student_learner.account_id = admissions.account_id','inner')
                    ->join('sections','sections.id = admissions.section','inner')->join('subjects','subjects.id = student_grades.subject','inner')->where('teacher_id', $teachid)->findAll(),
                    'learner' => $this->admissions->select('admissions.student_id as id, student_id, first_name, middle_name, last_name')->join('student_learner','student_learner.account_id = admissions.account_id','inner')
                    ->join('sections','sections.id = admissions.section','inner')->orderBy('student_learner.last_name')->FindAll(),
                    'subject' => $this->subjects->findAll(),
                'gr' => $this->grade->where('id', $this->encrypter->decrypt(hex2bin($id)))->first(),
            ];
    
            return view('grade', $data);
            
        }

        public function simple_qr() {
            $curruser = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
            $id = $this->teacher->select('idnum')->where('account_id', $curruser)->first();
            $qrcode = new Generator;
            $session = session();
            $session->setFlashdata('qr', $qrcode->size(120)->generate(bin2hex($this->encrypter->encrypt($id['idnum']))));
            return redirect()->to('teacher');
        }

        public function chart()
        {
            $session = session();
            //get curr user id
            $curruser = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
            //get idnum of curr user id
            $teachid = $this->teacher->select('idnum')->where('account_id', $curruser)->first();
            //get subjects handled by the curr user
            $sub = $this->subjects->where('teacher_id', $teachid)->findAll();

            foreach($sub as $s) {

            $allGrades['sub'.$s['id']] = $this->grade->select('student_grades.student_id, idnum, school_year, subject, AVG(grade) as GWA, CONCAT(first_name,\' \', last_name) as student, name, subject_name, teacher_id, quarter')
            ->join('teachers','student_grades.teacher_account = teachers.id','inner')
            ->join('admissions','student_grades.student_id = admissions.student_id','inner')->join('student_learner','student_learner.account_id = admissions.account_id','inner')
            ->join('sections','sections.id = admissions.section','inner')->join('subjects','subjects.id = student_grades.subject','inner')->where('teacher_id', $teachid)->where('subject', $s['id'])->where('school_year','2023-2024')
            ->groupBy('student_grades.student_id, student_grades.quarter, teachers.idnum, student_learner.last_name, student_learner.first_name')->orderBy('GWA','DESC')->limit(10)->findAll();

            }
            
            $allGrades['sub'] = $sub;

            return view('chart', $allGrades);
        }

        public function generateReport() {
            $session = session();
            //get curr user id
            $curruser = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
            //get idnum of curr user id
            $teachid = $this->teacher->select('idnum')->where('account_id', $curruser)->first();
            //get subjects handled by the curr user
            $sub = $this->subjects->where('teacher_id', $teachid)->findAll();

            foreach($sub as $s) {

            $allGrades['sub'.$s['id']] = $this->grade->select('student_grades.student_id, idnum, school_year, subject, AVG(grade) as GWA, CONCAT(first_name,\' \', last_name) as student, name, subject_name, teacher_id, quarter')
            ->join('teachers','student_grades.teacher_account = teachers.id','inner')
            ->join('admissions','student_grades.student_id = admissions.student_id','inner')->join('student_learner','student_learner.account_id = admissions.account_id','inner')
            ->join('sections','sections.id = admissions.section','inner')->join('subjects','subjects.id = student_grades.subject','inner')->where('teacher_id', $teachid)->where('subject', $s['id'])->where('school_year','2023-2024')
            ->groupBy('student_grades.student_id, student_grades.quarter, teachers.idnum, student_learner.last_name, student_learner.first_name')->orderBy('GWA','DESC')->limit(10)->findAll();

            }

            $student = $this->learner->select('school_year, CONCAT(last_name,", ",first_name," ",middle_name) as student, age, admissions.yr_lvl, name, gender, admissions.student_id as studid')
            ->join('admissions','admissions.account_id = student_learner.account_id', 'inner')
            ->join('sections','admissions.section = sections.id', 'inner')
            ->join('student_grades','student_grades.student_id = admissions.student_id', 'inner')
            ->join('subjects','subjects.id = student_grades.subject', 'inner')
            ->where('teacher_id', $teachid)->findAll();

            $allGrades['sub'] = $sub;

            $pdf = new \Mpdf\Mpdf();
            
            $html = "<div style='text-align:center'><img src='img/pga.jpg' style='float: left;margin-right:40' width='120' height='120'><h1 style='line-height: 50px; '>Puerto Galera Academy Inc. Students' Report</h1></div><hr style='padding:0;margin:3'>";
            $html .= "<div style='text-align:center'><small>Puerto Galera, Oriental Mindoro, Philippines</small></div><hr style='padding:0;margin:3'><div>";
            foreach($allGrades['sub'] as $all) {
            $html .= "<img src='".$this->request->getVar("report".$all['id'])."' style='margin: 20px' width='300' height='200'?>";
            }
 
            $html .= '<h3>List of Students</h3>';
            $html .= "</div><table style='border:1px black' width='100%'><tr>
            <td style='background-color:gray;color:white'>No.</td>
            <td style='background-color:gray;color:white'>Student's Name</td>
            <td style='background-color:gray;color:white'>Student's ID</td>
            <td style='background-color:gray;color:white'>Gender</td>
            <td style='background-color:gray;color:white'>Year Level</td>
            <td style='background-color:gray;color:white'>Section</td></tr>";

            foreach($student as $stud) {
                $x = 1;
                $html .= "<tr><td>".$x."</td>";
                $html .= "<td>".$stud['student']."</td>";
                $html .= "<td>".$stud['studid']."</td>";
                $html .= "<td>".$stud['gender']."</td>";
                $html .= "<td>".$stud['yr_lvl']."</td>";
                $html .= "<td>".$stud['name']."</td></tr>";
                $x++;
            }
            $html .= "</table>";
            $pdf->WriteHTML($html);
            $pdf->Output('Report.pdf');

            return redirect()->to('chart');
        }

        public function generateGrade() {
            $session = session();
            $studinfo = $this->admissions->select('school_year, CONCAT(last_name,", ",first_name," ",middle_name) as student, age, yr_lvl, name, gender, admissions.student_id')
            ->join('student_learner','admissions.account_id = student_learner.account_id', 'inner')
            ->join('sections','admissions.section = sections.id', 'inner')
            ->where('admissions.student_id',$this->request->getVar('student_id'))
            ->where('school_year', $this->request->getVar('school_year'))->first();

            $studgrade = $this->grade->select('subject_name, grade, quarter')
            ->join('admissions','student_grades.admission_id = admissions.id', 'inner')
            ->join('student_learner','admissions.account_id = student_learner.account_id', 'inner')
            ->join('sections','admissions.section = sections.id', 'inner')
            ->join('subjects','student_grades.subject = subjects.id','inner')
            ->where('student_grades.student_id',$this->request->getVar('student_id'))
            ->where('school_year', $this->request->getVar('school_year'))->findAll();

            if($studinfo['yr_lvl'] == "Grade 11" || $studinfo['yr_lvl'] == "Grade 12") {
                //Reading the Spreadsheet
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $spreadsheet = $reader->load("SHS-CARD.xlsx");
                //GetActiveSheet
                $sheet = $spreadsheet->getSheetByName('CARD');
                //Set Values
                $sheet->setCellValue('B10','School Year '.str_replace("-"," - ",$studinfo['school_year']));
                $sheet->setCellValue('C12',$studinfo['student']);
                $sheet->setCellValue('M12',$studinfo['age']);
                if(str_contains($studinfo['yr_lvl'], "Grade")) {
                    $sheet->setCellValue('C13',str_replace("Grade ","",$studinfo['yr_lvl']));
                } else {
                    $sheet->setCellValue('C13',str_replace("Kinder ","",$studinfo['yr_lvl']));
                }
                $sheet->setCellValue('G13',$studinfo['name']);
                $sheet->setCellValue('M13',$studinfo['gender']);
                $sheet->setCellValue('G14',$this->request->getVar('lrn'));
                //Grades
                foreach($studgrade as $gd) {
                    if(str_contains($gd['subject_name'], "Filipino") && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G18',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Filipino") && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H18',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Filipino") && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I18',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Filipino") && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J18',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "English") && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G19',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "English") && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H19',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "English") && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I19',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "English") && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J19',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Mathematics") && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G20',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Mathematics") && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H20',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Mathematics") && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I20',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Mathematics") && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J20',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Science") && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G21',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Science") && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H21',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Science") && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I21',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Science") && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J21',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "AP") && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G22',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "AP") && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H22',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "AP") && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I22',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "AP") && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J22',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "TLE") && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G23',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "TLE") && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H23',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "TLE") && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I23',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "TLE") && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J23',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "MAPEH") && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G24',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "MAPEH") && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H24',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "MAPEH") && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I24',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "MAPEH") && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J24',$gd['grade']);
                    } else if($gd['subject_name'] == "Music" && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G25',$gd['grade']);
                    } else if($gd['subject_name'] == "Music" && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H25',$gd['grade']);
                    } else if($gd['subject_name'] == "Music" && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I25',$gd['grade']);
                    } else if($gd['subject_name'] == "Music" && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J25',$gd['grade']);
                    } else if($gd['subject_name'] == "Arts" && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G26',$gd['grade']);
                    } else if($gd['subject_name'] == "Arts" && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H26',$gd['grade']);
                    } else if($gd['subject_name'] == "Arts" && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I26',$gd['grade']);
                    } else if($gd['subject_name'] == "Arts" && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J26',$gd['grade']);
                    } else if($gd['subject_name'] == "Physical Education" && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G27',$gd['grade']);
                    } else if($gd['subject_name'] == "Physical Education" && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H27',$gd['grade']);
                    } else if($gd['subject_name'] == "Physical Education" && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I27',$gd['grade']);
                    } else if($gd['subject_name'] == "Physical Education" && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J27',$gd['grade']);
                    } else if($gd['subject_name'] == "Health" && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G28',$gd['grade']);
                    } else if($gd['subject_name'] == "Health" && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H28',$gd['grade']);
                    } else if($gd['subject_name'] == "Health" && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I28',$gd['grade']);
                    } else if($gd['subject_name'] == "Health" && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J28',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "ESP w/ CL") && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G29',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "ESP w/ CL") && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H29',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "ESP w/ CL") && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I29',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "ESP w/ CL") && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J29',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "ICT") && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G30',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "ICT") && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H30',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "ICT") && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I30',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "ICT") && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J30',$gd['grade']);
                    } else if($gd['subject_name'] == "Conduct" && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G31',$gd['grade']);
                    } else if($gd['subject_name'] == "Conduct" && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H31',$gd['grade']);
                    } else if($gd['subject_name'] == "Conduct" && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I31',$gd['grade']);
                    } else if($gd['subject_name'] == "Conduct" && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J31',$gd['grade']);
                    }
                }
                //Writing to File
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $writer->save($this->request->getVar('student_id').'.xlsx');

                $session->setFlashdata('msg','Generated Grade Successfully');
            
            } else {
                //Reading the Spreadsheet
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $spreadsheet = $reader->load("CARD-JH.xlsx");
                //GetActiveSheet
                $sheet = $spreadsheet->getSheetByName('CARD');
                //Set Values
                $sheet->setCellValue('B10','School Year '.str_replace("-"," - ",$studinfo['school_year']));
                $sheet->setCellValue('C12',$studinfo['student']);
                $sheet->setCellValue('M12',$studinfo['age']);
                if(str_contains($studinfo['yr_lvl'], "Grade")) {
                    $sheet->setCellValue('C13',str_replace("Grade ","",$studinfo['yr_lvl']));
                } else {
                    $sheet->setCellValue('C13',str_replace("Kinder ","",$studinfo['yr_lvl']));
                }
                $sheet->setCellValue('G13',$studinfo['name']);
                $sheet->setCellValue('M13',$studinfo['gender']);
                $sheet->setCellValue('G14',$this->request->getVar('lrn'));
                //Grades
                foreach($studgrade as $gd) {
                    if(str_contains($gd['subject_name'], "Filipino") && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G18',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Filipino") && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H18',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Filipino") && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I18',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Filipino") && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J18',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "English") && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G19',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "English") && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H19',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "English") && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I19',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "English") && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J19',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Math") && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G20',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Math") && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H20',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Math") && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I20',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Math") && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J20',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Science") && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G21',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Science") && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H21',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Science") && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I21',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "Science") && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J21',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "AP") && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G22',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "AP") && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H22',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "AP") && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I22',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "AP") && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J22',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "TLE") && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G23',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "TLE") && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H23',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "TLE") && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I23',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "TLE") && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J23',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "MAPEH") && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G24',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "MAPEH") && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H24',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "MAPEH") && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I24',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "MAPEH") && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J24',$gd['grade']);
                    } else if($gd['subject_name'] == "Music" && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G25',$gd['grade']);
                    } else if($gd['subject_name'] == "Music" && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H25',$gd['grade']);
                    } else if($gd['subject_name'] == "Music" && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I25',$gd['grade']);
                    } else if($gd['subject_name'] == "Music" && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J25',$gd['grade']);
                    } else if($gd['subject_name'] == "Arts" && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G26',$gd['grade']);
                    } else if($gd['subject_name'] == "Arts" && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H26',$gd['grade']);
                    } else if($gd['subject_name'] == "Arts" && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I26',$gd['grade']);
                    } else if($gd['subject_name'] == "Arts" && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J26',$gd['grade']);
                    } else if($gd['subject_name'] == "Physical Education" && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G27',$gd['grade']);
                    } else if($gd['subject_name'] == "Physical Education" && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H27',$gd['grade']);
                    } else if($gd['subject_name'] == "Physical Education" && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I27',$gd['grade']);
                    } else if($gd['subject_name'] == "Physical Education" && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J27',$gd['grade']);
                    } else if($gd['subject_name'] == "Health" && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G28',$gd['grade']);
                    } else if($gd['subject_name'] == "Health" && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H28',$gd['grade']);
                    } else if($gd['subject_name'] == "Health" && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I28',$gd['grade']);
                    } else if($gd['subject_name'] == "Health" && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J28',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "ESP w/ CL") && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G29',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "ESP w/ CL") && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H29',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "ESP w/ CL") && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I29',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "ESP w/ CL") && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J29',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "ICT") && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G30',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "ICT") && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H30',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "ICT") && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I30',$gd['grade']);
                    } else if(str_contains($gd['subject_name'], "ICT") && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J30',$gd['grade']);
                    } else if($gd['subject_name'] == "Conduct" && $gd['quarter'] == 1) {
                        $sheet->setCellValue('G31',$gd['grade']);
                    } else if($gd['subject_name'] == "Conduct" && $gd['quarter'] == 2) {
                        $sheet->setCellValue('H31',$gd['grade']);
                    } else if($gd['subject_name'] == "Conduct" && $gd['quarter'] == 3) {
                        $sheet->setCellValue('I31',$gd['grade']);
                    } else if($gd['subject_name'] == "Conduct" && $gd['quarter'] == 4) {
                        $sheet->setCellValue('J31',$gd['grade']);
                    }
                }
                //Writing to File
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $writer->save($this->request->getVar('student_id').'.xlsx');

                $session->setFlashdata('msg','Generated Grade Successfully');
            }


            return redirect()->back();
        }
}
