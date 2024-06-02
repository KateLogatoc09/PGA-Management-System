<?php

namespace App\Controllers;
use App\Models\LearnerModel;
use App\Models\AddressModel;
use App\Models\AdmissionsModel;
use App\Models\SiblingModel;
use App\Models\FamilyModel;
use App\Models\SchoolAttendedModel;
use App\Models\GradeModel;
use App\Controllers\BaseController;
use App\Models\ApplicationModel;
use App\Models\AccountModel;
use App\Models\ParentChild;

class ParentController extends BaseController
{
    private $acc, $learner, $family, $address, $admissions, $sibling, $school, $grade, $app, $parent_child;
   public function __construct()
   {
       $this->learner = new LearnerModel();
       $this->family = new FamilyModel();
       $this->address = new AddressModel();
       $this->admissions = new AdmissionsModel();
       $this->sibling = new SiblingModel();
       $this->school = new SchoolAttendedModel();
       $this->grade = new GradeModel();
       $this->app = new ApplicationModel();
       $this->acc = new AccountModel();
       $this->parent_child = new ParentChild();
   }

   public function parent()
   {
    $session = session();
    $curruser = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
    $aa = $this->app->select('id')->where('account_id', $curruser)->first();
    $child = $this->parent_child->select('child_id')->where('parent_id', $aa)->first();

    $stud = $this->admissions->select('account_id')->where('student_id', $child)->first();
       $data = [
           'learn' => $this->learner->where('student_learner.account_id', $stud)->first(),
           'ad' => $this->admissions->select('student_id, name, category,yr_lvl,program, specialization, school_year, status,
            birth_cert, report_card, good_moral, admissions.photo, schedule, fname, mname, lname')
            ->join('sections','sections.id = admissions.section','left')->join('teachers','sections.adviser = teachers.idnum','left')
            ->where('admissions.account_id', $stud)->first(),
           'fam' => $this->family->where('family.account_id', $stud)->FindAll(),
           'address' => $this->address->where('address.account_id', $stud)->FindAll(),
           'sibling' => $this->sibling->where('sibling.account_id', $stud)->FindAll(),
           'school' => $this->school->where('school_attended.account_id', $stud)->FindAll(),
       ];

       return view('parent', $data);
   }

   public function childgrade()
   {
    $session = session();
    $curruser = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
    $aa = $this->app->select('id')->where('account_id', $curruser)->first();
    $child = $this->parent_child->select('child_id')->where('parent_id', $aa)->first();
    $admi = $this->admissions->select('student_id')->where('student_id', $child)->first();
    $sub = $this->grade->select('student_id')->where('student_grades.student_id', $admi)->first();

       $data = [
           'grade' => $this->grade->select('subject_name, type, fname, mname, lname, subject, grade, quarter, school_year')
            ->join('admissions','student_grades.student_id = admissions.student_id','inner')
            ->join('subjects','student_grades.subject = subjects.id','inner')->join('teachers','subjects.teacher_id = teachers.idnum','inner')
            ->where('admissions.student_id', $sub)->FindAll(), 
       ];

       return view('childgrade', $data);
   }
}
