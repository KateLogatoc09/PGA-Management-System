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
use App\Models\AddBooksModel;

class StudentController extends BaseController
{
    private $book, $borrowedBook, $enrollment, $learner, $family, $address, $admissions, $sibling, $school, $acc;
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

    
    public function studentlibrary()
    {
        $data = [
            'booky' => $this->book->findAll(),
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
        'date_return' => $this->request->getVar('dateReturn'),
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
                $session->setFlashdata('msg','Saved Successfully.');
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

}
