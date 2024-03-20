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

class StudentController extends BaseController
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

    public function index()
    {
        $session = session();
        $curruser = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
        $enrolled = $this->admissions->select('status')->where('account_id', $curruser)->first();
        
        $data = [
            'learn' => $this->learner->where('account_id', $curruser)->first(),
            'ad' => $this->admissions->where('account_id', $curruser)->first(),
            'fam' => $this->family->where('account_id', $curruser)->FindAll(),
            'address' => $this->address->where('account_id', $curruser)->FindAll(),
            'sibling' => $this->sibling->where('account_id', $curruser)->FindAll(),
            'school' => $this->school->where('account_id', $curruser)->FindAll(),
            'status' => $enrolled,
        ];

        return view('student', $data);
    }


}
