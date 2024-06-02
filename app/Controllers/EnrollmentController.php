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


class EnrollmentController extends BaseController
{
    private $enrollment, $learner, $family, $address, $admissions, $sibling, $school, $acc;
    public function __construct()
    {
        $this->learner = new LearnerModel();
        $this->family = new FamilyModel();
        $this->address = new AddressModel();
        $this->admissions = new AdmissionsModel();
        $this->sibling = new SiblingModel();
        $this->school = new SchoolAttendedModel();
        $this->acc = new AccountModel();
  
    }

    public function confirm()
    {
        return view('confirm');
    }
    
    public function learner()
    {
        return view('learner');
    }

    public function address()
    {
        return view('address');
    }

    public function admission()
    {
        return view('admission');
    }

    public function family()
    {
        return view('family');
    }

    public function sibling()
    {
        return view('sibling');
    }

    public function school()
    {
        return view('school');
    }

    public function save()  {
        $session = session();
        $id = $_POST['id'];
        $photo = $this->request->getFile('photo');
        $acc = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
        $check = $this->learner->select('photo')->where('account_id',$acc)->first();
        
        if($photo != null) {

            $test = $photo->move(PUBLIC_PATH.'\\account\\'.$acc['id'].'\\');
            $name = $photo->getClientPath();
            $path = '/account/'.$acc['id'].'/'.$name;

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
                'account_id' => $this->acc->select('id')->where('username', $_SESSION['username'])->first(),
            ];

            if ($id != null) {
                unlink(PUBLIC_PATH.$check);
                $res = $this->learner->set($data)->where('id', $id)->update();
                if($res) {
                    $session->setFlashdata('msg','Updated Successfully.');
                    return redirect()->to('address');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
                
            } else {
                $res = $this->learner->save($data);
                if($res) {
                    $session->setFlashdata('msg','Saved Successfully.');
                    return redirect()->to('address');
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
                    return redirect()->to('address');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
                
            } else {
                $res = $this->learner->save($data);
                if($res) {
                    $session->setFlashdata('msg','Saved Successfully.');
                    return redirect()->to('address');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
            } 
        }
        return redirect()->to('learner');
    }

    
    public function saveaddress()  {
        $session = session();
        $id = $_POST['id'];
        $data = [
            'id' => $this->request->getVar('id'),
            'type' => $this->request->getVar('type'),
            'region' => $this->request->getVar('region'),
            'province' => $this->request->getVar('province'),
            'municipality' => $this->request->getVar('municipality'),
            'barangay' => $this->request->getVar('barangay'),
            'street' => $this->request->getVar('street'),
            'postal_code' => $this->request->getVar('postal_code'),
            'tel_num' => $this->request->getVar('tel_num'),
            'account_id' => $this->acc->select('id')->where('username', $_SESSION['username'])->first(),
        ];

        if ($id != null) {
            $res = $this->address->set($data)->where('id', $id)->update();
            if($res) {
                $session->setFlashdata('msg','Updated Successfully.');
                return redirect()->to('admission');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        } else {
            $res = $this->address->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
                return redirect()->to('admission');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        }  
        return redirect()->to('address');
    }

    public function saveadmissions()  {
        $session = session();
        $id = $_POST['id'];
        $birth = $this->request->getFile('birth');
        $report = $this->request->getFile('report');
        $moral = $this->request->getFile('moral');
        $by2 = $this->request->getFile('2by2');
        $categ = $this->request->getVar('category');
        $acc = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
        //update
        $checkbirth = $this->admissions->select('birth_cert')->where('account_id',$acc)->first();
        $checkreport = $this->admissions->select('report_card')->where('account_id',$acc)->first();
        $checkmoral = $this->admissions->select('good_moral')->where('account_id',$acc)->first();
        $checkby2 = $this->admissions->select('photo')->where('account_id',$acc)->first();

        if($categ == 'Transferee') {
            //birth
            $test1 = $birth->move(PUBLIC_PATH.'\\account\\'.$acc['id'].'\\');
            $name1 = $birth->getClientPath();
            $path1 = '/account/'.$acc['id'].'/'.$name1;
            //report
            $test2 = $report->move(PUBLIC_PATH.'\\account\\'.$acc['id'].'\\');
            $name2 = $report->getClientPath();
            $path2 = '/account/'.$acc['id'].'/'.$name2;
            //moral
            $test3 = $moral->move(PUBLIC_PATH.'\\account\\'.$acc['id'].'\\');
            $name3 = $moral->getClientPath();
            $path3 = '/account/'.$acc['id'].'/'.$name3;
            //photo id 2by2
            $test4 = $by2->move(PUBLIC_PATH.'\\account\\'.$acc['id'].'\\');
            $name4 = $by2->getClientPath();
            $path4 = '/account/'.$acc['id'].'/'.$name4;

            $data = [
                'category' => $this->request->getVar('category'),
                'yr_lvl' => $this->request->getVar('yr_lvl'),
                'program' => $this->request->getVar('program'),
                'specialization' => $this->request->getVar('specialization'),
                'school_year' => $this->request->getVar('school_year'),
                'birth_cert' => $path1,
                'report_card' => $path2,
                'good_moral' => $path3,
                'photo' => $path4,
                'account_id' => $acc,
            ];

            if ($id != null) {
                unlink(PUBLIC_PATH.$checkbirth);
                unlink(PUBLIC_PATH.$checkreport);
                unlink(PUBLIC_PATH.$checkmoral);
                unlink(PUBLIC_PATH.$checkby2);
                $res = $this->admissions->set($data)->where('id', $id)->update();
                if($res) {
                    $session->setFlashdata('msg','Updated Successfully.');
                    return redirect()->to('family');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
                
            } else {
                $res = $this->admissions->save($data);
                if($res) {
                    $session->setFlashdata('msg','Saved Successfully.');
                    return redirect()->to('family');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
            } 
        } else {
            $data = [
                'category' => $this->request->getVar('category'),
                'yr_lvl' => $this->request->getVar('yr_lvl'),
                'program' => $this->request->getVar('program'),
                'specialization' => $this->request->getVar('specialization'),
                'school_year' => $this->request->getVar('school_year'),
                'account_id' => $acc,
            ];

            if ($id != null) {
                $res = $this->admissions->set($data)->where('id', $id)->update();
                if($res) {
                    $session->setFlashdata('msg','Updated Successfully.');
                    return redirect()->to('family');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
                
            } else {
                $res = $this->admissions->save($data);
                if($res) {
                    $session->setFlashdata('msg','Saved Successfully.');
                    return redirect()->to('family');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
            } 
        }
        return redirect()->to('admission');
    }

    public function savesibling()  {
        $session = session();
        $id = $_POST['id'];
        $num = (count($_POST) - 1) / 3;

        $data = [
            'id' => $this->request->getVar('id'),
            'fullname' => $this->request->getVar('fullname'),
            'yr_lvl' => $this->request->getVar('yr_lvl'),
            'affiliation' => $this->request->getVar('affiliation'),
            'account_id' => $this->acc->select('id')->where('username', $_SESSION['username'])->first(),
        ];


        if ($id != null) {
            $res = $this->sibling->set($data)->where('id', $id)->update();
            if($res) {
                $session->setFlashdata('msg','Updated Successfully.');
                return redirect()->to('school');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        } else {
            if($num > 1) {
                for($x = 1;$x < $num;$x++) {
                    $data1 = [
                        'fullname' => $this->request->getVar('fullname'.$x),
                        'yr_lvl' => $this->request->getVar('yr_lvl'.$x),
                        'affiliation' => $this->request->getVar('affiliation'.$x),
                        'account_id' => $this->acc->select('id')->where('username', $_SESSION['username'])->first(),
                    ]; 
    
                    $this->sibling->save($data1);
                }
            }

            $res = $this->sibling->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
                return redirect()->to('school');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        }
        return redirect()->to('sibling');
    }

    public function savefamily()  {
        $session = session();

        $relation = $this->request->getVar('relation2');
        $fullname = $this->request->getVar('fullname2');
        $res_add = $this->request->getVar('res_add2');
        $off_add = $this->request->getVar('off_add2');
        $mob_num = $this->request->getVar('mob_num2');
        $off_num = $this->request->getVar('off_num2');
        $email = $this->request->getVar('email2');
        $occupation = $this->request->getVar('occupation2');

        $data = [
            'relation' => $this->request->getVar('relation'),
            'fullname' => $this->request->getVar('fullname'), 
            'res_add' => $this->request->getVar('res_add'),
            'off_add' => $this->request->getVar('off_add'), 
            'mob_num' => $this->request->getVar('mob_num'), 
            'off_num' => $this->request->getVar('off_num'), 
            'email' => $this->request->getVar('email'), 
            'occupation' => $this->request->getVar('occupation'),
            'account_id' => $this->acc->select('id')->where('username', $_SESSION['username'])->first(),
        ];

        if($fullname != '') {
            $data2 = [
                'relation' => $relation,
                'fullname' => $fullname,
                'res_add' => $res_add,
                'off_add' => $off_add,
                'mob_num' => $mob_num,
                'off_num' => $off_num,
                'email' => $email,
                'occupation' => $occupation,
                'account_id' => $this->acc->select('id')->where('username', $_SESSION['username'])->first(),
            ];

            $this->family->save($data2);
        }

            $res = $this->family->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
                return redirect()->to('sibling');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }

        return redirect()->to('family');
    }

    public function saveschool()  {
        $session = session();
        $id = $_POST['id'];
        $num = (count($_POST) - 1) / 4;

        $data = [
            'id' => $this->request->getVar('id'),
            'grade' => $this->request->getVar('grade'),
            'school_name' => $this->request->getVar('school_name'), 
            'level' => $this->request->getVar('level'),
            'period' => $this->request->getVar('period'), 
            'account_id' => $this->acc->select('id')->where('username', $_SESSION['username'])->first(),
        ];

        if ($id != null) {
            $res = $this->school->set($data)->where('id', $id)->update();
            if($res) {
                $session->setFlashdata('msg','Updated Successfully.');
                return redirect()->to('confirm');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        } else {
            if($num > 1) {
                for($x = 1;$x < $num;$x++) {
                    $data1 = [
                        'grade' => $this->request->getVar('grade'.$x),
                        'school_name' => $this->request->getVar('school_name'.$x), 
                        'level' => $this->request->getVar('level'.$x),
                        'period' => $this->request->getVar('period'.$x), 
                        'account_id' => $this->acc->select('id')->where('username', $_SESSION['username'])->first(),
                    ]; 
    
                    $this->school->save($data1);
                }
            }
            $res = $this->school->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
                return redirect()->to('confirm');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        }  
        return redirect()->to('school');
    }
}
