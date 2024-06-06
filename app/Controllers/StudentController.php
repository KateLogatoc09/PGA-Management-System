<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LearnerModel;
use App\Models\AccountModel;
use App\Models\AddressModel;
use App\Models\AdmissionsModel;
use App\Models\SiblingModel;
use App\Models\FamilyModel;
use App\Models\SchoolAttendedModel;
use App\Models\BorrowedBooksModel;
use SimpleSoftwareIO\QrCode\Generator;
use App\Models\AddBooksModel;
use App\Models\GradeModel;
use App\Models\PermitModel;
use App\Models\ScheduleModel;

class StudentController extends BaseController
{
    private $book, $borrowedBook, $enrollment, $learner, $family, $address, $admissions, $grade, $sibling, 
    $school, $acc, $permit, $config, $encrypter, $schedule;
    public function __construct()
    {
        $this->learner = new LearnerModel();
        $this->family = new FamilyModel();
        $this->address = new AddressModel();
        $this->admissions = new AdmissionsModel();
        $this->sibling = new SiblingModel();
        $this->school = new SchoolAttendedModel();
        $this->acc = new AccountModel();
        $this->borrowedBook = new BorrowedBooksModel();
        $this->book = new AddBooksModel();
        $this->grade = new GradeModel();
        $this->permit = new PermitModel();      
        $this->schedule = new ScheduleModel();
        $this->config    = new \Config\Encryption();  
        $this->encrypter = \Config\Services::encrypter($this->config);
    }

    public function index()
    {
        $session = session();
        $curruser = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
        $enrolled = $this->admissions->select('status')->where('account_id', $curruser)->first();

        $data = [
            'learn' => $this->learner->where('account_id', $curruser)->first(),
            'ad' => $this->admissions->select('admissions.id as id, student_id, name, category,yr_lvl,program, specialization, school_year, status,
            birth_cert, report_card, good_moral, admissions.photo, schedule, fname, mname, lname')
            ->join('sections','sections.id = admissions.section','left')->join('teachers','sections.adviser = teachers.idnum','left')
            ->where('admissions.account_id', $curruser)->first(),
            'fam' => $this->family->where('account_id', $curruser)->FindAll(),
            'address' => $this->address->where('account_id', $curruser)->FindAll(),
            'sibling' => $this->sibling->where('account_id', $curruser)->FindAll(),
            'school' => $this->school->where('account_id', $curruser)->FindAll(), 
            'status' => $enrolled,
        ];

        return view('student', $data);
    }

    public function studgrade()
    {
        $session = session();
        $curruser = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
        $enrolled = $this->admissions->select('status')->where('account_id', $curruser)->first();

        $admi = $this->admissions->select('student_id')->where('account_id', $curruser)->first();
        $sub = $this->grade->select('student_id')->where('student_grades.student_id', $admi)->first();
        
        $data = [
            'grade' => $this->grade->select('subject_name, type, fname, mname, lname, subject, grade, quarter, school_year')
            ->join('admissions','student_grades.student_id = admissions.student_id','inner')
            ->join('subjects','student_grades.subject = subjects.id','inner')->join('teachers','subjects.teacher_id = teachers.idnum','inner')
            ->where('admissions.student_id', $sub)->FindAll(), 
            'status' => $enrolled,
        ];

        return view('studgrade', $data);
    }

    public function simple_qr() {
        $curruser = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
        $id = $this->admissions->select('student_id')->where('account_id', $curruser)->first();
        $qrcode = new Generator;
        $session = session();
        $session->setFlashdata('qr', $qrcode->size(120)->generate(bin2hex($this->encrypter->encrypt($id['student_id']))));
        return redirect()->to('student');
    }
    
    public function studentlibrary()
    {
        $data = [
            'booky' => $this->book->select('*')->where('status', 'AVAILABLE')->findAll(),
        ];
        return view('studentlibrary', $data);
    }

    public function permit()
    {
        return view('permit');
    }

    public function searchLibrary()
    {
        $data = [
            'booky' => $this->book->like($this->request->getVar('categ'), $this->request->getVar('search'))->orderBy('book_title')->findAll(),
        ];
        return view('studentlibrary', $data);
    }

public function studentborrowBook()  {
    $session = session();
    $id = $_POST['id'];
    $qty = $this->book->select('book_qty')->where('id',$this->request->getVar('book_id'))->first();
    $stat = $this->book->select('status')->where('id',$this->request->getVar('book_id'))->first();
    $data = [
        'account_id' => $this->acc->select('id')->where('username', $_SESSION['username'])->first(),
        'book_qty' => $this->request->getVar('book_qty'),
        'date_borrowed' => $this->request->getVar('dateBorrowed'),
        'date_to_be_return' => $this->request->getVar('dateReturn'),
        'book_id' => $this->request->getVar('book_id'),
        'status' => 'PENDING'
    ];

    if($stat['status'] == 'AVAILABLE') {
    if ($id != null) {
        if($qty['book_qty'] >= $this->request->getVar('book_qty')) {
            $res = $this->borrowedBook->set($data)->where('id', $id)->update();
            if($res) {
                $session->setFlashdata('msg','Updated Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        } else {
            $session->setFlashdata('msg','There isn\'t enough books available.');
        }
    } else {
        if($qty['book_qty'] >= $this->request->getVar('book_qty')) {
            $res = $this->borrowedBook->save($data);
            if($res) {
                $session->setFlashdata('msg','Borrowed Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        } else {
            $session->setFlashdata('msg','There isn\'t enough books available.');
        }
    }
} else {
    $session->setFlashdata('msg','Book is not available.');
}          
return redirect()->to('studentlibrary');   
}

public function savepermit() {
    $session = session();
    $permit_photo = $this->request->getFile('permit_photo');
    $quarter = $this->request->getVar('quarter');
    $acc = $this->acc->select('id')->where('username', $_SESSION['username'])->first();

        //permit
        $test1 = $permit_photo->move(PUBLIC_PATH.'\\account\\'.$acc['id'].'\\');
        $name1 = $permit_photo->getClientPath();
        $path1 = '/account/'.$acc['id'].'/'.$name1;

        $data = [
            'permit_photo' => $path1,
            'quarter' => $quarter,
            'account_id' => $acc,
        ];
            $res = $this->permit->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');             
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
    return redirect()->to('permit');
}

public function editlearner($id)
{
    $data = [
        'learn' => $this->learner->where('id', $this->encrypter->decrypt(hex2bin($id)))->first(),
    ];

    return view('editlearner', $data);
} 

public function saveEditLearner()  {
    $session = session();
    $id = $_POST['id'];
    $photo = $this->request->getFile('photo');
    $check = $this->learner->select('photo')->where('account_id',$id)->first();
    
    if($photo != "") {

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
            'gender' => $this->request->getVar('gender'),
            'marital_status' => $this->request->getVar('marital_status'),
            'birthdate' => $this->request->getVar('birthdate'),
            'birthplace' => $this->request->getVar('birthplace'),
            'mobile_num' => $this->request->getVar('mobile_num'),
            'nationality' => $this->request->getVar('nationality'),
            'religion' => $this->request->getVar('religion'),
            'photo' => $path,
            'curdate' => date('Y-m-d H:i:s'),
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
            'gender' => $this->request->getVar('gender'),
            'marital_status' => $this->request->getVar('marital_status'),
            'birthdate' => $this->request->getVar('birthdate'),
            'birthplace' => $this->request->getVar('birthplace'),
            'mobile_num' => $this->request->getVar('mobile_num'),
            'nationality' => $this->request->getVar('nationality'),
            'religion' => $this->request->getVar('religion'),
            'curdate' => date('Y-m-d H:i:s'),
            'account_id' => $this->acc->select('id')->where('username', $_SESSION['username'])->first(),
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
    return redirect()->to('student');
}

public function editaddress($id)
{
    $data = [
         'add' => $this->address->where('id', $this->encrypter->decrypt(hex2bin($id)))->first(),
    ];

    return view('editaddress', $data);
}

public function saveEditAddress()  {
    $session = session();
    $id = $_POST['id'];
    $data = [
        'id' => $this->request->getVar('id'),
        'type' => $this->request->getVar('type'),
        'region' => $this->request->getVar('region'),
        'province' => $this->request->getVar('province'),
        'municipality' => $this->request->getVar('municipality'),
        'barangay' => $this->request->getVar('barangay'),
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
    return redirect()->to('student');
}

public function editfamily($id)
{
    $data = [
       'fam' => $this->family->where('id', $this->encrypter->decrypt(hex2bin($id)))->first(),
    ];

    return view('editfamily', $data);
}

public function saveEditFamily()  {
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
    return redirect()->to('student');
}

public function editsibling($id)
{
    $data = [
        'sib' => $this->sibling->where('id', $this->encrypter->decrypt(hex2bin($id)))->first(),
    ];

    return view('editsibling', $data);
}

public function saveEditSibling()  {
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
    return redirect()->to('student');
}

public function editschool($id)
{
    $data = [
        'sch' => $this->school->where('id', $this->encrypter->decrypt(hex2bin($id)))->first(),
    ];

    return view('editschool', $data);
}

public function saveEditSchool()  {
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
    return redirect()->to('student');
}

public function studentschedule(){
    $curruser = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
    $sec = $this->admissions->select('section')->where('account_id', $curruser)->first();

    $data = [
        'Monday' => $this->schedule->select('schedule.id as id, day, start_time, end_time, name, subject, fname, mname, lname')
        ->join('sections','schedule.section_id = sections.id','inner')->join('teachers','sections.adviser = teachers.idnum','inner')
        ->where('section_id', $sec)->like('day', 'Monday')->orderBy('start_time')->findAll(),
        
        'Tuesday' => $this->schedule->select('schedule.id as id, day, start_time, end_time, name, subject, fname, mname, lname')
        ->join('sections','schedule.section_id = sections.id','inner')->join('teachers','sections.adviser = teachers.idnum','inner')
        ->where('section_id', $sec)->like('day', 'Tuesday')->orderBy('start_time')->findAll(),
       
        'Wednesday' => $this->schedule->select('schedule.id as id, day, start_time, end_time, name, subject, fname, mname, lname')
        ->join('sections','schedule.section_id = sections.id','inner')->join('teachers','sections.adviser = teachers.idnum','inner')
        ->where('section_id', $sec)->like('day', 'Wednesday')->orderBy('start_time')->findAll(),
    ];

    return view ('studentschedule', $data);
}
}
