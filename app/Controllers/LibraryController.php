<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BorrowedBooksModel;
use App\Models\AddBooksModel;
use App\Models\AccountModel;
use App\Models\AdmissionsModel;

class LibraryController extends BaseController
{
    private $book, $borrowedBook, $acc, $admissions;
    public function __construct()
    {
        $this->borrowedBook = new BorrowedBooksModel();
        $this->book = new AddBooksModel();
        $this->acc = new AccountModel();
        $this->admissions = new AdmissionsModel();
    }

    public function index()
    {
        $data = [
            'booky' => $this->book->findAll(),
        ];
        return view('library', $data);
    }

    public function saveBorrowedBook()  {
        $session = session();
        $qty = $this->book->select('book_qty')->where('id',$this->request->getVar('book_id'))->first();
        $id = $_POST['id'];
        $data = [
            'account_id' => $this->acc->select('id')->where('username', $_SESSION['username'])->first(),
            'book_qty' => $this->request->getVar('book_qty'),
            'date_borrowed' => $this->request->getVar('dateBorrowed'),
            'date_return' => $this->request->getVar('dateReturn'),
            'status' => $this->request->getVar('status'),
            'book_id' => $this->request->getVar('book_id'),
        ];

        if ($id != null) {
            if($qty['book_qty'] >= $this->request->getVar('book_qty') || $this->request->getVar('status') == "RETURNED") {
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
        return redirect()->to('borrowers');
    }

    //Student start 
    public function borrowBook()  {
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
    return redirect()->to('li');   
    }
    

    public function saveBook()  {
        $session = session();
        $id = $_POST['id'];
        $data = [
            'book_title' => $this->request->getPost('bookTitle'),
            'book_number' => $this->request->getPost('bookNumber'),
            'book_author' => $this->request->getPost('bookAuthor'),
            'book_publisher' => $this->request->getPost('book_publisher'),
            'place_printed' => $this->request->getPost('place_printed'),
            'book_category' => $this->request->getPost('book_category'),
            'book_pages' => $this->request->getPost('book_pages'),
            'book_qty' => $this->request->getPost('book_qty'),
            'ISBN' => $this->request->getPost('ISBN'),
            'datepublish' => $this->request->getPost('datePublish'),
            'status' => $this->request->getPost('status'),
        ];

        if ($id != null) {
            $res = $this->book->set($data)->where('id', $id)->update();
            if($res) {
                $session->setFlashdata('msg','Updated Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        } else {
            $res = $this->book->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
        }   
        return redirect()->to('books');
    }

    public function librarian()
    {
        $data = [
            'booky' => $this->book->findAll(),
            'borrow' => $this->book->select('borrowedbooks.id as id, first_name, middle_name, last_name, student_id, book_title, ISBN, borrowedbooks.book_qty as book_qty, date_borrowed, date_return, borrowedbooks.status as status')->join('borrowedbooks','borrowedbooks.book_id = books.id','inner')
            ->orderBy('books.book_title')->join('student_learner','student_learner.account_id = borrowedbooks.account_id','inner')
            ->join('admissions','admissions.account_id = borrowedbooks.account_id','inner')->FindAll(),
        ];
        return view('librarian', $data);
    }

    public function borrowers()
    {
        $data = [
            'borrow' => $this->book->select('borrowedbooks.id as id, first_name, middle_name, last_name, student_id, book_title, ISBN, borrowedbooks.book_qty as book_qty, date_borrowed, date_return, borrowedbooks.status as status')->join('borrowedbooks','borrowedbooks.book_id = books.id','inner')
            ->orderBy('books.book_title')->join('student_learner','student_learner.account_id = borrowedbooks.account_id','inner')
            ->join('admissions','admissions.account_id = borrowedbooks.account_id','inner')->FindAll(),
            'borrow2' => $this->book->select('*')->join('borrowedbooks','borrowedbooks.book_id = books.id','inner')->orderBy('books.book_title')->FindAll(),
            'booky' => $this->book->findAll(),
         ];
        return view('borrowers', $data);
    }

    
    public function books()
    {
        $data = [
            'booky' => $this->book->findAll(),
        ];
        return view('books', $data);
    }

    public function deleteBorrow($id)
    {
        $session = session();
        $res = $this->borrowedBook->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
        }
        return redirect()->to('borrowers');
    }

    public function editBorrow($id)
    {
        $data = [
            'borrow' => $this->book->select('borrowedbooks.id as id, first_name, middle_name, last_name, student_id, book_title, ISBN, borrowedbooks.book_qty as book_qty, date_borrowed, date_return, borrowedbooks.status as status')->join('borrowedbooks','borrowedbooks.book_id = books.id','inner')
            ->orderBy('books.book_title')->join('student_learner','student_learner.account_id = borrowedbooks.account_id','inner')
            ->join('admissions','admissions.account_id = borrowedbooks.account_id','inner')->FindAll(),
            'borrow2' => $this->book->select('*')->join('borrowedbooks','borrowedbooks.book_id = books.id','inner')->orderBy('books.book_title')->FindAll(),
            'borrowed' => $this->borrowedBook->where('id', $id)->first(),
            'booky' => $this->book->findAll(),
        ];

        return view('borrowers', $data);
        
    }

    public function deleteBook($id)
    {
        $session = session();
        $res = $this->book->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
        }
        return redirect()->to('books');
    }

    public function editBook($id)
    {
        $data = [
            'booky' => $this->book->findAll(),
            'booke' => $this->book->where('id', $id)->first(),
        ];
        return view('books', $data);
    }
}
