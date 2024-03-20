<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BorrowedBooksModel;
use App\Models\AddBooksModel;

class LibraryController extends BaseController
{
    private $book, $borrowedBook;
    public function __construct()
    {
        $this->borrowedBook = new BorrowedBooksModel();
        $this->book = new AddBooksModel();
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
            'student_id' => $this->request->getVar('studIDnum'),
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
                    return redirect()->to('borrowers');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                    return redirect()->to('borrowers');
                }
            } else {
                $session->setFlashdata('msg','There isn\'t enough books available.');
                return redirect()->to('li');
            }
        } else {
            if($qty['book_qty'] >= $this->request->getVar('book_qty')) {
                $res = $this->borrowedBook->save($data);
                if($res) {
                    $session->setFlashdata('msg','Saved Successfully.');
                    return redirect()->to('borrowers');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                    return redirect()->to('borrowers');
                }
            } else {
                $session->setFlashdata('msg','There isn\'t enough books available.');
                return redirect()->to('li');
            }
        }  
    }

    //Student start 
    public function borrowBook()  {
        $session = session();
        $id = $_POST['id'];
        $qty = $this->book->select('book_qty')->where('id',$this->request->getVar('book_id'))->first();
        $stat = $this->book->select('status')->where('id',$this->request->getVar('book_id'))->first();
        $data = [
            'student_id' => $this->request->getVar('studIDnum'),
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
                    return redirect()->to('li');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                    return redirect()->to('li');
                }
            } else {
                $session->setFlashdata('msg','There isn\'t enough books available.');
                return redirect()->to('li');
            }
        } else {
            if($qty['book_qty'] >= $this->request->getVar('book_qty')) {
                $res = $this->borrowedBook->save($data);
                if($res) {
                    $session->setFlashdata('msg','Saved Successfully.');
                    return redirect()->to('li');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                    return redirect()->to('li');
                }
            } else {
                $session->setFlashdata('msg','There isn\'t enough books available.');
                return redirect()->to('li');
            }
        }
    } else {
        $session->setFlashdata('msg','Book is not available.');
        return redirect()->to('li');
    }
                
            
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
                return redirect()->to('books');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
                return redirect()->to('books');
            }
        } else {
            $res = $this->book->save($data);
            if($res) {
                $session->setFlashdata('msg','Saved Successfully.');
                return redirect()->to('books');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
                return redirect()->to('books');
            }
        }   
    }

    public function librarian()
    {
        $data = [
            'currentuser' => $_SESSION['username'],
            'booky' => $this->book->findAll(),
            'borrow' => $this->book->select('*')->join('borrowedbooks','borrowedbooks.book_id = books.id','inner')->orderBy('books.book_title')->FindAll(),
            'borrowedBook' => $this->borrowedBook->findAll(),
        ];
        return view('librarian', $data);
    }

    public function borrowers()
    {
        $data = [
            'currentuser' => $_SESSION['username'],
            'borrow' => $this->book->select('*')->join('borrowedbooks','borrowedbooks.book_id = books.id','inner')->orderBy('books.book_title')->FindAll(),
            'borrowedBook' => $this->borrowedBook->findAll(),
        ];
        return view('borrowers', $data);
    }

    
    public function books()
    {
        $data = [
            'currentuser' => $_SESSION['username'],
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
            return redirect()->to('borrowers');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
            return redirect()->to('borrowers');
        }
    }

    public function editBorrow($id)
    {
        $data = [
            'currentuser' => $_SESSION['username'],
            'borrowedBook' => $this->borrowedBook->findAll(),
            'borrow' => $this->book->select('*')->join('borrowedbooks','borrowedbooks.book_id = books.id','inner')->orderBy('books.book_title')->FindAll(),
            'borrowed' => $this->borrowedBook->where('id', $id)->first(),
        ];

        return view('borrowers', $data);
        
    }

    public function deleteBook($id)
    {
        $session = session();
        $res = $this->book->delete($id);
        if($res) {
            $session->setFlashdata('msg','Deleted Successfully.');
            return redirect()->to('books');
        } else {
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
            return redirect()->to('books');
        }
        
    }

    public function editBook($id)
    {
        $data = [
            'currentuser' => $_SESSION['username'],
            'booky' => $this->book->findAll(),
            'booke' => $this->book->where('id', $id)->first(),
        ];

        return view('books', $data);
        
    }
}
