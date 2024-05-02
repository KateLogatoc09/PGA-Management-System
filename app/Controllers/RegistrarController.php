<?php

namespace App\Controllers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;
use App\Models\LearnerModel;
use App\Models\AddressModel;
use App\Models\AdmissionsModel;
use App\Models\SiblingModel;
use App\Models\FamilyModel;
use App\Models\SchoolAttendedModel;
use App\Models\GradeModel;
use App\Controllers\BaseController;
use App\Models\AlumniModel;
use App\Models\Subjects;
use App\Models\Sections;
use App\Models\ApplicationModel;
use App\Models\AccountModel;

class RegistrarController extends BaseController
{
    private $learner, $family, $address, $admissions, $sibling, $school, $section, $grade, $sections, $subjects, $alumni, $app, $account;
    public function __construct()
    {
        $this->learner = new LearnerModel();
        $this->family = new FamilyModel();
        $this->address = new AddressModel();
        $this->admissions = new AdmissionsModel();
        $this->sibling = new SiblingModel();
        $this->school = new SchoolAttendedModel();
        $this->sections = new Sections();
        $this->grade = new GradeModel();
        $this->alumni = new AlumniModel();
        $this->sections = new Sections();
        $this->subjects = new Subjects();
        $this->app = new ApplicationModel();
        $this->account = new AccountModel();
    }

    public function registrar()
    {
        return view ('registrar');
    }
    
        
    public function mail()
    {
        return view('email');
    }
       
    public function application()
    {
        $data = [
            'appli' => $this->account->select('*')->join('application','application.account_id = accounts.id','inner')->orderBy('application.fullname')->FindAll(),
        ];
            return view ('application', $data);
    }

    public function searchAppli()
    {
        $data = [
            'appli' => $this->account->select('*')->join('application','application.account_id = accounts.id','inner')->like('email', $this->request->getVar('search'))->orLike('application.fullname', $this->request->getVar('search'))->orderBy('application.fullname')->findAll(),
        ];
            return view ('application', $data);
    }

    public function editApplication($id)
    {
        $data = [
            'appli' => $this->account->select('*')->join('application','application.account_id = accounts.id','inner')->orderBy('application.fullname')->FindAll(),
            'ap' => $this->app->where('id', $id)->first(),
            ];

        return view('application', $data);
        
    }

    public function saveApplication()
    {
        $session = session();
        $id = $_POST['id'];
        $data = [
            'status' => $this->request->getVar('status'),
        ];

        if ($id != null) {
            $res = $this->app->set($data)->where('id', $id)->update();
            if($res) {
                $session->setFlashdata('msg','Updated Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        } else {
            $res = $this->app->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        }  
         
        return redirect()->to('application');
        
    }

    public function deleteApplication($id)
    {
        $session = session();
        $res = $this->app->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
        }
        return redirect()->to('application');
    }

    public function alumni()
    {
        $data = [
            'alumni' => $this->alumni->findAll(),
                ];
        return view ('alumni', $data);
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
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        } else {
            $res = $this->alumni->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        }   
        return redirect()->to('alumni');
    }

    public function deleteAlumni($id)
    {
        $session = session();
        $res = $this->alumni->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
        }
        return redirect()->to('alumni');
    }

    
    public function editAlumni($id)
    {
        $data = [
            'alumni' => $this->alumni->findAll(),
            'alum' => $this->alumni->where('id', $id)->first(),
        ];

        return view('alumni', $data);
        
    }

    public function sections()
    {
        $data = [
            'stud_section' => $this->sections->findAll(),
        ];
            return view ('sections', $data);
    }


    public function searchSection()
    {
        $data = [
            'stud_section' => $this->sections->like('name', $this->request->getVar('search'))->findAll(),
        ];
            return view ('sections', $data);
    }

    public function saveSection()  {
        $session = session();
        $id = $_POST['id'];
        $data = [
            'id' => $this->request->getVar('id'),
            'name' => $this->request->getVar('name'),
            'grade_level_id' => $this->request->getVar('grade_level_id'),
        ];

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
        return redirect()->to('sections');
    }

    public function deleteSection($id)
    {
        $session = session();
        $res = $this->sections->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
        }
        return redirect()->to('sections');
    }

    
    public function editSection($id)
    {
        $data = [
            'stud_section' => $this->sections->findAll(),
            'sec' => $this->sections->where('id', $id)->first(),
        ];

        return view('sections', $data);
    }

    
    public function subjects()
    {
        $data = [
            'subject' => $this->subjects->orderBy('name')->findAll(),
        ];
            return view ('subjects', $data);
    }

    public function searchSubject()
    {
        $data = [
            'subject' => $this->subjects->like('name', $this->request->getVar('search'))->orderBy('name')->findAll(),
        ];
            return view ('subjects', $data);
    }

    public function saveSubject()  {
        $session = session();
        $id = $_POST['id'];
        $data = [
            'id' => $this->request->getVar('id'),
            'name' => $this->request->getVar('name'),
            'type' => $this->request->getVar('type'),
            'yr_lvl' => $this->request->getVar('yr_lvl'),
        ];

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
        return redirect()->to('subjects');
    }

    public function deleteSubject($id)
    {
        $session = session();
        $res = $this->subjects->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
        }
        return redirect()->to('subjects');
    }

    
    public function editSubject($id)
    {
        $data = [
            'subject' => $this->subjects->findAll(),
            'sub' => $this->subjects->where('id', $id)->first(),
        ];

        return view('subjects', $data);
    }


    public function registerstudent()
    {
        $data = [
            'learner' => $this->admissions->select('student_learner.id as id, first_name, middle_name, last_name, nickname, birthdate, birthplace, age,
            gender, marital_status, mobile_num, nationality, religion, student_learner.photo, student_id, email, name, yr_lvl')->join('student_learner','student_learner.account_id = admissions.account_id','inner')
            ->join('accounts','accounts.id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->FindAll(),
            ];
        return view('registerstudent', $data);
    }

    public function regSaveLearner()  {
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
                unlink(PUBLIC_PATH.Implode($check));
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
        return redirect()->to('registerstudent');
    }
   
    public function regDeleteLearner($id)
    {
        $session = session();
        $res = $this->learner->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
            return redirect()->to('registerstudent');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
            return redirect()->to('registerstudent');
        }
    }

    
    public function regEditLearner($id)
    {
        $data = [
            'learner' => $this->admissions->select('student_learner.id as id, first_name, middle_name, last_name, nickname, birthdate, birthplace, age,
            gender, marital_status, mobile_num, nationality, religion, student_learner.photo, student_id, email, name, yr_lvl')->join('student_learner','student_learner.account_id = admissions.account_id','inner')
            ->join('accounts','accounts.id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->FindAll(),
            'learn' => $this->learner->where('id', $id)->first(),
        ];

        return view('registerstudent', $data);
    } 

    public function regfam()
    {
        $data = [
            'family' => $this->learner->select('*')->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('family','family.account_id = student_learner.account_id','inner')->orderBy('student_learner.last_name')->FindAll(),
        ];

        return view('regfam', $data);
    }

    public function regSavefamily()  {
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
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        } else {
            $res = $this->family->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        }  
        return redirect()->to('regfam');
    }

    
    public function regDeletefamily($id)
    {
        $session = session();
        $res = $this->family->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
        }
        return redirect()->to('regfam');
    }

    
    public function regEditfamily($id)
    {
        $data = [
            'family' => $this->learner->select('*')->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('family','family.account_id = student_learner.account_id','inner')->orderBy('student_learner.last_name')->FindAll(),
            'fam' => $this->family->where('id', $id)->first(),
        ];

        return view('regfam', $data);
    }

    public function regaddress()
    {
        $data = [
            'address' => $this->learner->select('*')->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('address','address.account_id = student_learner.account_id','inner')->orderBy('student_learner.last_name')->FindAll(),
        ];

        return view('regaddress', $data);
    }

    
    public function regSaveaddress()  {
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
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        } else {
            $res = $this->address->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        }  
        return redirect()->to('regaddress');
    }

    public function regDeleteaddress($id)
    {
        $session = session();
        $res = $this->address->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
        }
        return redirect()->to('regaddress');
    }

    
    public function regEditaddress($id)
    {
        $data = [
            'address' => $this->learner->select('*')->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('address','address.account_id = student_learner.account_id','inner')->orderBy('student_learner.last_name')->FindAll(),
            'add' => $this->address->where('id', $id)->first(),
        ];

        return view('regaddress', $data);
    }

    public function regsibling()
    {
        $data = [
            'sibling' => $this->learner->select('*')->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sibling','sibling.account_id = student_learner.account_id','inner')->orderBy('student_learner.last_name')->FindAll(),
        ];

        return view('regsibling', $data);
    }

    public function regSavesibling()  {
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
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        } else {
            $res = $this->sibling->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        }  
        return redirect()->to('regsibling');
    }

    public function regDeletesibling($id)
    {
        $session = session();
        $res = $this->sibling->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
        }
        return redirect()->to('regsibling');
    }

    
    public function regEditsibling($id)
    {
        $data = [
            'sibling' => $this->learner->select('*')->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sibling','sibling.account_id = student_learner.account_id','inner')->orderBy('student_learner.last_name')->FindAll(),
            'sib' => $this->sibling->where('id', $id)->first(),
        ];

        return view('regsibling', $data);
    }


    public function regschool()
    {
        $data = [
            'school' => $this->learner->select('*')->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('school_attended','school_attended.account_id = student_learner.account_id','inner')->orderBy('student_learner.last_name')->FindAll(),
        ];

        return view('regschool', $data);
    }

    public function regSaveschool()  {
        $session = session();
        $id = $_POST['id'];
        $data = [
            'id' => $this->request->getVar('id'),
            'grade' => $this->request->getVar('grade'),
            'school_name' => $this->request->getVar('school_name'),
            'level' => $this->request->getVar('level'),
            'period' => $this->request->getVar('period'),
            'account_id' => $this->request->getVar('account_id'),
        ];

        if ($id != null) {
            $res = $this->school->set($data)->where('id', $id)->update();
            if($res) {
                $session->setFlashdata('msg','Updated Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        } else {
            $res = $this->school->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        }  
        return redirect()->to('regschool');
    }

    public function regDeleteschool($id)
    {
        $session = session();
        $res = $this->school->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
        }
        return redirect()->to('regschool');
    }

    
    public function regEditschool($id)
    {
        $data = [
            'school' => $this->learner->select('*')->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('school_attended','school_attended.account_id = student_learner.account_id','inner')->orderBy('student_learner.last_name')->FindAll(),
            'sch' => $this->school->where('id', $id)->first(),
        ];

        return view('regschool', $data);
    }

    
    public function regadmissions()
    {
        $data = [
            'stud_section' => $this->sections->findAll(),
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, category,yr_lvl,program, status,
            birth_cert, report_card, good_moral, admissions.photo, schedule')->join('admissions','admissions.account_id = student_learner.account_id','inner')
            ->join('sections','sections.id = admissions.section','left')->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('regadmissions', $data);
    }

    
    public function regSaveadmissions()  {
        $session = session();
        $id = $_POST['id'];
        $twobytwo = $this->request->getFile('twobytwo');
        $birth_cert = $this->request->getFile('birth_cert');
        $report_card = $this->request->getFile('report_card');
        $good_moral = $this->request->getFile('good_moral');

        $data = [
            'student_id' => $this->request->getVar('student_id'),
            'category' => $this->request->getVar('category'),
            'yr_lvl' => $this->request->getVar('yr_lvl'),
            'section' => $this->request->getVar('section'),
            'program' => $this->request->getVar('program'),
            'status' => $this->request->getVar('status'),
            'schedule' => $this->request->getVar('schedule'),
            'account_id' => $this->request->getVar('account_id'),
        ];

        if($twobytwo != '') {
            $test1 = $twobytwo->move(PUBLIC_PATH.'\\account\\'.$id.'\\');
            $name1 = $twobytwo->getClientPath();
            $path1 = '/account/'.$id.'/'.$name1;
            
            $data['photo'] = $path1;
        }
        
        if($birth_cert != '') {
            $test2 = $birth_cert->move(PUBLIC_PATH.'\\account\\'.$id.'\\');
            $name2 = $birth_cert->getClientPath();
            $path2 = '/account/'.$id.'/'.$name2;

            $data['birth_cert'] = $path2;
        } 

        if($report_card != '') {
            $test3 = $report_card->move(PUBLIC_PATH.'\\account\\'.$id.'\\');
            $name3 = $report_card->getClientPath();
            $path3 = '/account/'.$id.'/'.$name3;

            $data['report_card'] = $path3;
        } 

        if($good_moral != '') {
            $test4 = $good_moral->move(PUBLIC_PATH.'\\account\\'.$id.'\\');
            $name4 = $good_moral->getClientPath();
            $path4 = '/account/'.$id.'/'.$name4;

            $data['good_moral'] = $path4;
        } 

        if ($id != null) {
            $res = $this->admissions->set($data)->where('id', $id)->update();
            if($res) {
                $session->setFlashdata('msg','Updated Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        } else {
            $res = $this->admissions->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        }  
        return redirect()->to('regadmissions');
    }

    public function regDeleteadmissions($id)
    {
        $session = session();
        $res = $this->admissions->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
        }
        return redirect()->to('regadmissions');
    }

    
    public function regEditadmissions($id)
    {
        $data = [
            'stud_section' => $this->sections->findAll(),
            'admissions' => $this->admissions->where('id', $id)->first(),
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, category,yr_lvl,program, status,
            birth_cert, report_card, good_moral, admissions.photo, schedule')->join('admissions','admissions.account_id = student_learner.account_id','inner')
            ->join('sections','sections.id = admissions.section','left')->orderBy('student_learner.last_name')->FindAll(),
       ];

        return view('regadmissions', $data);
        
    }

    public function reggrade()
    {
            $data = [
                'grade' => $this->grade->select('*')->join('teachers','teachers.id = student_grades.teacher_account','inner')->findAll(),
                ];
            return view ('reggrade', $data);
    }

    
    public function searchStudgrade()
    {
            $data = [
                'grade' => $this->grade->select('*')->join('teachers','teachers.id = student_grades.teacher_account','inner')->like('student_id', $this->request->getVar('search'))->orLike('teacher_account', $this->request->getVar('search'))->findAll(),
                ];
            return view ('reggrade', $data);
    }

    public function send() {
        $recipient = $this->request->getVar('recipient');
        $subject = $this->request->getVar('subject');
        $message = $this->request->getVar('message');
        $attachment = $this->request->getFile('attachment');

        $session = session();

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->AuthType = 'XOAUTH2';

        $provider = new Google(
            [
                'clientId' => '80579387547-1nvlh9celk9oath3ud4c5cng70e85eoa.apps.googleusercontent.com',
                'clientSecret' => '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',
            ]
        );

        $mail->setOAuth(
            new OAuth(
                [
                    'provider' => $provider,
                    'clientId' => '80579387547-1nvlh9celk9oath3ud4c5cng70e85eoa.apps.googleusercontent.com',
                    'clientSecret' => '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',
                    'refreshToken' => '1//0gEXq5M_HNKxPCgYIARAAGBASNwF-L9IrD7uHL_3rMFWrJKDq-DZn2c6gLrKOVZ3vGTASBmFWQJvq_ErmjVqbC-2NfKFOWOPee7I',
                    'userName' => 'developers.pga@gmail.com',
                ]
            )
        );

        //sender information
        $mail->setFrom('developers.pga@gmail.com', 'PGA developers');

        //receiver email address and name
        $mail->addAddress($recipient); 

        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body    = $message;

        if($attachment != '') {
            $test = $attachment->move(PUBLIC_PATH.'\\attachments\\');
            $name = $attachment->getClientPath();
            $path = 'attachments/'.$name;

            $mail->addAttachment($path);
        }
                
        // Send mail   
        if (!$mail->send()) {
            $mail->smtpClose();
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
            return redirect()->to('email');
        } else {
            $mail->smtpClose();
            $session->setFlashdata('msg','Sent Successfully.');
            return redirect()->to('email');
        }

    }
}