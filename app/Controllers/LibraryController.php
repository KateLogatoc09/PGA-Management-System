<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BorrowedBooksModel;
use App\Models\AddBooksModel;

class LibraryController extends BaseController
{
    public function __construct()
    {
        $this->borrowedBook = new BorrowedBooksModel();
        $this->book = new AddBooksModel();
    }

    public function index()
    {
        if(!session()->get('isLoggedIn')){
            return redirect()->to('login');
        }
        else{
            $session = session();
            session_start();
            $data = [
            'currentuser' => $_SESSION['username'],
            'booky' => $this->book->findAll(),
            ];
        return view('library', $data);
        }
    }

    public function saveBorrowedBook()  {
        $id = $_POST['id'];
        $data = [
            'student_id' => $this->request->getVar('studIDnum'),
            'date_borrowed' => $this->request->getVar('dateBorrowed'),
            'date_return' => $this->request->getVar('dateReturn'),
            'status' => $this->request->getVar('status'),
            'book_id' => $this->request->getVar('book_id'),
        ];

        if ($id != null) {
            $this->borrowedBook->set($data)->where('id', $id)->update();
        } else {
            $this->borrowedBook->save($data);
        }
        if(!session()->get('isLoggedIn'))
        {
            return redirect()->to('login');
        }
        else
            {
                $session = session();
                session_start();
                $data = [
                    'currentuser' => $_SESSION['username'],
                    'borrowedBook' => $this->borrowedBook->findAll(),
                    'booky' => $this->book->findAll(),
                    'borrow' => $this->book->select('*')->join('borrowedbooks','borrowedbooks.book_id = addbooks.id','inner')->orderBy('book_title')->FindAll(),
                    'borrowed' => $this->borrowedBook->where('id', $id)->first(),
                ];
                
                return view('librarian', $data);
            }
    }

    public function borrowBook()  {
        $id = $_POST['id'];
        $data = [
            'student_id' => $this->request->getVar('studIDnum'),
            'date_borrowed' => $this->request->getVar('dateBorrowed'),
            'date_return' => $this->request->getVar('dateReturn'),
            'status' => 'Pending',
            'book_id' => $this->request->getVar('book_id'),
        ];

        if ($id != null) {
            $this->borrowedBook->set($data)->where('id', $id)->update();
        } else {
            $this->borrowedBook->save($data);
        }
        if(!session()->get('isLoggedIn'))
        {
            return redirect()->to('login');
        }
        else
            {
                $session = session();
                session_start();
                $data = [
                    'currentuser' => $_SESSION['username'],
                    'booky' => $this->book->findAll(),
                ];
                
                return view('library', $data);
            }
    }

    public function saveBook()  {
        $id = $_POST['id'];
        $data = [
            'book_title' => $this->request->getPost('bookTitle'),
            'book_number' => $this->request->getPost('bookNumber'),
            'book_author' => $this->request->getPost('bookAuthor'),
            'datepublish' => $this->request->getPost('datePublish'),
        ];

        if ($id != null) {
            $this->book->set($data)->where('id', $id)->update();
        } else {
            $this->book->save($data);
        }
        if(!session()->get('isLoggedIn'))
        {
            return redirect()->to('login');
        }
        else
            {
                $session = session();
                session_start();
                $data = [
                    'currentuser' => $_SESSION['username'],
                    'booky' => $this->book->findAll(),
                    'borrowedBook' => $this->borrowedBook->findAll(),
                    'borrow' => $this->book->select('*')->join('borrowedbooks','borrowedbooks.book_id = addbooks.id','inner')->orderBy('book_title')->FindAll(),
                    'booke' => $this->book->where('id', $id)->first(),
                ];
                
                return view('librarian', $data);
            }
    }

    public function librarian()
    {
        if(!session()->get('isLoggedIn')){
            return redirect()->to('login');
        }
        else{
            $session = session();
            session_start();
            $data = [
                'currentuser' => $_SESSION['username'],
                'booky' => $this->book->findAll(),
                'borrow' => $this->book->select('*')->join('borrowedbooks','borrowedbooks.book_id = addbooks.id','inner')->orderBy('book_title')->FindAll(),
                'borrowedBook' => $this->borrowedBook->findAll(),
            ];
        return view('librarian', $data);
        }
    }

    public function deleteBorrow($id)
    {
        $this->borrowedBook->delete($id);
        if(!session()->get('isLoggedIn'))
        {
            return redirect()->to('login');
        }
        else
            {
                $session = session();
                session_start();
                $data = [
                    'currentuser' => $_SESSION['username'],
                    'borrowedBook' => $this->borrowedBook->findAll(),
                    'booky' => $this->book->findAll(),
                    'borrow' => $this->book->select('*')->join('borrowedbooks','borrowedbooks.book_id = addbooks.id','inner')->orderBy('book_title')->FindAll(),
                    'borrowed' => $this->borrowedBook->where('id', $id)->first(),
                ];

                return view('librarian', $data);
    }
    }

    public function editBorrow($id)
    {
        if(!session()->get('isLoggedIn'))
        {
            return redirect()->to('login');
        }
        else
        {
            $session = session();
            session_start();
        $data = [
            'currentuser' => $_SESSION['username'],
            'borrowedBook' => $this->borrowedBook->findAll(),
            'booky' => $this->book->findAll(),
            'borrow' => $this->book->select('*')->join('borrowedbooks','borrowedbooks.book_id = addbooks.id','inner')->orderBy('book_title')->FindAll(),
            'borrowed' => $this->borrowedBook->where('id', $id)->first(),
        ];

        return view('librarian', $data);
        }
    }

    public function deleteBook($id)
    {
        $this->book->delete($id);
        if(!session()->get('isLoggedIn'))
        {
            return redirect()->to('login');
        }
        else
            {
                $session = session();
                session_start();
                $data = [
                    'currentuser' => $_SESSION['username'],
                    'booky' => $this->book->findAll(),
                    'borrowedBook' => $this->borrowedBook->findAll(),
                    'borrow' => $this->book->select('*')->join('borrowedbooks','borrowedbooks.book_id = addbooks.id','inner')->orderBy('book_title')->FindAll(),
                    'booke' => $this->book->where('id', $id)->first(),
                ];

                return view('librarian', $data);
    }
    }

    public function editBook($id)
    {
        if(!session()->get('isLoggedIn'))
        {
            return redirect()->to('login');
        }
        else
        {
            $session = session();
            session_start();
        $data = [
            'currentuser' => $_SESSION['username'],
            'booky' => $this->book->findAll(),
            'borrowedBook' => $this->borrowedBook->findAll(),
            'borrow' => $this->book->select('*')->join('borrowedbooks','borrowedbooks.book_id = addbooks.id','inner')->orderBy('book_title')->FindAll(),
            'booke' => $this->book->where('id', $id)->first(),
        ];

        return view('librarian', $data);
        }
    }
}
