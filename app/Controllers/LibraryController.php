<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BorrowedBooksModel;
use App\Models\AddBooksModel;
use App\Models\AccountModel;
use App\Models\AdmissionsModel;

class LibraryController extends BaseController
{
    private $book, $borrowedBook, $acc, $admissions, $config, $encrypter;
    public function __construct()
    {
        $this->borrowedBook = new BorrowedBooksModel();
        $this->book = new AddBooksModel();
        $this->acc = new AccountModel();
        $this->admissions = new AdmissionsModel();     
        $this->config    = new \Config\Encryption();  
        $this->encrypter = \Config\Services::encrypter($this->config);
    }

    public function saveBorrowedBook()  {
        $session = session();
        $qty = $this->book->select('book_qty')->where('id',$this->request->getVar('book_id'))->first();
        $id = $_POST['id'];
        $data = [
            'book_qty' => $this->request->getVar('book_qty'),
            'date_borrowed' => $this->request->getVar('dateBorrowed'),
            'date_to_be_return' => $this->request->getVar('dateReturn'),
            'date_returned' => $this->request->getVar('date_returned'),
            'payment_status' => $this->request->getVar('payment_status'),
            'fines' => $this->request->getVar('fines'),
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
            'book_type' => $this->request->getPost('book_type'),
            'book_pages' => $this->request->getPost('book_pages'),
            'book_qty' => $this->request->getPost('book_qty'),
            'book_shelf' => $this->request->getPost('book_shelf'),
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
        return view('librarian');
    }

    public function borrowers()
    {
        $data = [
            'borrow' => $this->book->select('borrowedbooks.id as id, first_name, middle_name, last_name, student_id, book_title, 
            book_shelf, ISBN, borrowedbooks.book_qty as book_qty, date_borrowed, date_returned, date_to_be_return, payment_status, fines, 
            borrowedbooks.status as status, book_type')->join('borrowedbooks','borrowedbooks.book_id = books.id','inner')
            ->orderBy('books.book_title')->join('student_learner','student_learner.account_id = borrowedbooks.account_id','inner')
            ->join('admissions','admissions.account_id = borrowedbooks.account_id','inner')->FindAll(),
            'booky' => $this->book->orderBy('book_title')->findAll(),
         ];
        return view('borrowers', $data);
    }

    public function searchBorrower()
    {
        if($this->request->getVar('categ') == 'borrower') {
            $categ = "CONCAT(first_name,' ',middle_name,' ',last_name)";
        } else {
            $categ = $this->request->getVar('categ');
        }
        $data = [
            'borrow' => $this->book->select('borrowedbooks.id as id, first_name, middle_name, last_name, student_id, book_title, 
            book_shelf, ISBN, borrowedbooks.book_qty as book_qty, date_borrowed, date_returned, date_to_be_return, payment_status, fines, 
            borrowedbooks.status as status, book_type')->join('borrowedbooks','borrowedbooks.book_id = books.id','inner')
            ->orderBy('books.book_title')->join('student_learner','student_learner.account_id = borrowedbooks.account_id','inner')
            ->join('admissions','admissions.account_id = borrowedbooks.account_id','inner')->like($categ, $this->request->getVar('search'))->FindAll(),
            'booky' => $this->book->orderBy('book_title')->findAll(),
         ];
        return view('borrowers', $data);
    }

    
    public function books()
    {
        $data = [
            'booky' => $this->book->orderBy('book_title')->findAll(),
        ];
        return view('books', $data);
    }

    public function textbooks()
    {
        $data = [
            'shelf1' => $this->book->where('book_category', 'TEXTBOOKS')->where('book_shelf', '1')->orderBy('book_title')->findAll(),
            'shelf2' => $this->book->where('book_category', 'TEXTBOOKS')->where('book_shelf', '2')->orderBy('book_title')->findAll(),
        ];
        return view('textbooks', $data);
    }

    public function searchShelf1()
    {
        $data = [
            'shelf1' => $this->book->where('book_category', 'TEXTBOOKS')->where('book_shelf', '1')
            ->like($this->request->getVar('categ'), $this->request->getVar('search'))->
            orderBy('book_title')->findAll(),
            'shelf2' => $this->book->where('book_category', 'TEXTBOOKS')->where('book_shelf', '2')->orderBy('book_title')->findAll(),
        ];
        return view('textbooks', $data);
    }

    public function searchShelf2()
    {
        $data = [
            'shelf1' => $this->book->where('book_category', 'TEXTBOOKS')->where('book_shelf', '1')->orderBy('book_title')->findAll(), 
            'shelf2' => $this->book->where('book_category', 'TEXTBOOKS')->where('book_shelf', '2')
            ->like($this->request->getVar('categ'), $this->request->getVar('search'))->
            orderBy('book_title')->findAll(),
        ];
        return view('textbooks', $data);
    }

    public function fiction_storybook()
    {
        $data = [
            'shelf3' => $this->book->where('book_category', 'FICTION AND STORYBOOK')->where('book_shelf', '3')->orderBy('book_title')->findAll(),
            'shelf6' => $this->book->where('book_category', 'FICTION AND STORYBOOK')->where('book_shelf', '6')->orderBy('book_title')->findAll(),
        ];
        return view('fiction_storybook', $data);
    }

    public function searchShelf3()
    {
        $data = [
            'shelf3' => $this->book->where('book_category', 'FICTION AND STORYBOOK')->where('book_shelf', '3')
            ->like($this->request->getVar('categ'), $this->request->getVar('search'))->
            orderBy('book_title')->findAll(),
            'shelf6' => $this->book->where('book_category', 'FICTION AND STORYBOOK')->where('book_shelf', '6')->orderBy('book_title')->findAll(),
        ];
        return view('fiction_storybook', $data);
    }

    public function searchShelf6()
    {
        $data = [
            'shelf3' => $this->book->where('book_category', 'FICTION AND STORYBOOK')->where('book_shelf', '3')->orderBy('book_title')->findAll(),
            'shelf6' => $this->book->where('book_category', 'FICTION AND STORYBOOK')->where('book_shelf', '6')
            ->like($this->request->getVar('categ'), $this->request->getVar('search'))->
            orderBy('book_title')->findAll(),
        ];
        return view('fiction_storybook', $data);
    }
    
    public function reference_filipiniana()
    {
        $data = [
            'shelf4' => $this->book->where('book_category', 'REFERENCE AND FILIPINIANA')->where('book_shelf', '4')->orderBy('book_title')->findAll(),
            'shelf10' => $this->book->where('book_category', 'REFERENCE AND FILIPINIANA')->where('book_shelf', '10')->orderBy('book_title')->findAll(),
        ];
        return view('reference_filipiniana', $data);
    }

    public function searchShelf4()
    {
        $data = [
            'shelf4' => $this->book->where('book_category', 'REFERENCE AND FILIPINIANA')->where('book_shelf', '4')->like($this->request->getVar('categ'), $this->request->getVar('search'))
            ->orderBy('book_title')->findAll(),
            'shelf10' => $this->book->where('book_category', 'REFERENCE AND FILIPINIANA')->where('book_shelf', '10')->orderBy('book_title')->findAll(),
        ];
        return view('reference_filipiniana', $data);
    }

    
    public function searchShelf10()
    {
        $data = [
            'shelf4' => $this->book->where('book_category', 'REFERENCE AND FILIPINIANA')->where('book_shelf', '4')->orderBy('book_title')->findAll(),
            'shelf10' => $this->book->where('book_category', 'REFERENCE AND FILIPINIANA')->where('book_shelf', '10')
            ->like($this->request->getVar('categ'), $this->request->getVar('search'))
            ->orderBy('book_title')->findAll(),
        ];
        return view('reference_filipiniana', $data);
    }

    public function reference_filipiniana2()
    {
        $data = [
            'shelf11' => $this->book->where('book_category', 'REFERENCE AND FILIPINIANA')->where('book_shelf', '11')->orderBy('book_title')->findAll(),
            'shelf12' => $this->book->where('book_category', 'REFERENCE AND FILIPINIANA')->where('book_shelf', '12')->orderBy('book_title')->findAll(),
        ];
        return view('reference_filipiniana2', $data);
    }

    public function searchShelf11()
    {
        $data = [
            'shelf11' => $this->book->where('book_category', 'REFERENCE AND FILIPINIANA')->where('book_shelf', '11')
            ->like($this->request->getVar('categ'), $this->request->getVar('search'))
            ->orderBy('book_title')->findAll(),
            'shelf12' => $this->book->where('book_category', 'REFERENCE AND FILIPINIANA')->where('book_shelf', '12')->orderBy('book_title')->findAll(),
        ];
        return view('reference_filipiniana2', $data);
    }

    public function searchShelf12()
    {
        $data = [
            'shelf11' => $this->book->where('book_category', 'REFERENCE AND FILIPINIANA')->where('book_shelf', '11')->orderBy('book_title')->findAll(),
            'shelf12' => $this->book->where('book_category', 'REFERENCE AND FILIPINIANA')->where('book_shelf', '12')
            ->like($this->request->getVar('categ'), $this->request->getVar('search'))
            ->orderBy('book_title')->findAll(),
        ];
        return view('reference_filipiniana2', $data);
    }

    public function reference_filipiniana3()
    {
        $data = [
            'shelf13' => $this->book->where('book_category', 'REFERENCE AND FILIPINIANA')->where('book_shelf', '13')->orderBy('book_title')->findAll(),
            'shelf14' => $this->book->where('book_category', 'REFERENCE AND FILIPINIANA')->where('book_shelf', '14')->orderBy('book_title')->findAll(),
        ];
        return view('reference_filipiniana3', $data);
    }

    public function searchShelf13()
    {
        $data = [
            'shelf13' => $this->book->where('book_category', 'REFERENCE AND FILIPINIANA')->where('book_shelf', '13')
            ->like($this->request->getVar('categ'), $this->request->getVar('search'))
            ->orderBy('book_title')->findAll(),
            'shelf14' => $this->book->where('book_category', 'REFERENCE AND FILIPINIANA')->where('book_shelf', '14')->orderBy('book_title')->findAll(),
        ];
        return view('reference_filipiniana3', $data);
    }

    public function searchShelf14()
    {
        $data = [
            'shelf14' => $this->book->where('book_category', 'REFERENCE AND FILIPINIANA')->where('book_shelf', '14')
            ->like($this->request->getVar('categ'), $this->request->getVar('search'))
            ->orderBy('book_title')->findAll(),
            'shelf13' => $this->book->where('book_category', 'REFERENCE AND FILIPINIANA')->where('book_shelf', '13')->orderBy('book_title')->findAll(),
        ];
        return view('reference_filipiniana3', $data);
    }    

    public function multiple_copies()
    {
        $data = [
            'shelf5' => $this->book->where('book_category', 'BOOKS WITH MULTIPLE COPIES')->where('book_shelf', '5')->orderBy('book_title')->findAll(),
            'shelf7' => $this->book->where('book_category', 'BOOKS WITH MULTIPLE COPIES')->where('book_shelf', '7')->orderBy('book_title')->findAll(),
        ];
        return view('multiple_copies', $data);
    }

    public function searchShelf5()
    {
        $data = [
            'shelf5' => $this->book->where('book_category', 'BOOKS WITH MULTIPLE COPIES')->where('book_shelf', '5')
            ->like($this->request->getVar('categ'), $this->request->getVar('search'))
            ->orderBy('book_title')->findAll(),
            'shelf7' => $this->book->where('book_category', 'BOOKS WITH MULTIPLE COPIES')->where('book_shelf', '7')->orderBy('book_title')->findAll(),
        ];
        return view('multiple_copies', $data);
    }

    
    public function searchShelf7()
    {
        $data = [
            'shelf7' => $this->book->where('book_category', 'BOOKS WITH MULTIPLE COPIES')->where('book_shelf', '7')
            ->like($this->request->getVar('categ'), $this->request->getVar('search'))
            ->orderBy('book_title')->findAll(),
            'shelf5' => $this->book->where('book_category', 'BOOKS WITH MULTIPLE COPIES')->where('book_shelf', '5')->orderBy('book_title')->findAll(),
        ];
        return view('multiple_copies', $data);
    }

    
    public function multiple_copies2()
    {
        $data = [
            'shelf8' => $this->book->where('book_category', 'BOOKS WITH MULTIPLE COPIES')->where('book_shelf', '8')->orderBy('book_title')->findAll(),
            'shelf9' => $this->book->where('book_category', 'BOOKS WITH MULTIPLE COPIES')->where('book_shelf', '9')->orderBy('book_title')->findAll(),
        ];
        return view('multiple_copies2', $data);
    }

    public function searchShelf8()
    {
        $data = [
            'shelf8' => $this->book->where('book_category', 'BOOKS WITH MULTIPLE COPIES')->where('book_shelf', '8')
            ->like($this->request->getVar('categ'), $this->request->getVar('search'))
            ->orderBy('book_title')->findAll(),
            'shelf9' => $this->book->where('book_category', 'BOOKS WITH MULTIPLE COPIES')->where('book_shelf', '9')->orderBy('book_title')->findAll(),
        ];
        return view('multiple_copies2', $data);
    }


    public function searchShelf9()
    {
        $data = [
            'shelf9' => $this->book->where('book_category', 'BOOKS WITH MULTIPLE COPIES')->where('book_shelf', '9')
            ->like($this->request->getVar('categ'), $this->request->getVar('search'))
            ->orderBy('book_title')->findAll(),
            'shelf8' => $this->book->where('book_category', 'BOOKS WITH MULTIPLE COPIES')->where('book_shelf', '8')->orderBy('book_title')->findAll(),
        ];
        return view('multiple_copies2', $data);
    }

    
    public function teacher_references()
    {
        $data = [
            'shelf15' => $this->book->where('book_category', 'TEACHER\'S REFERENCES')->where('book_shelf', '15')->orderBy('book_title')->findAll(),
            'shelf16' => $this->book->where('book_category', 'TEACHER\'S REFERENCES')->where('book_shelf', '16')->orderBy('book_title')->findAll(),
        ];
        return view('teacher_references', $data);
    }

    public function searchShelf15()
    {
        $data = [
            'shelf15' => $this->book->where('book_category', 'TEACHER\'S REFERENCES')->where('book_shelf', '15')
            ->like($this->request->getVar('categ'), $this->request->getVar('search'))
            ->orderBy('book_title')->findAll(),
            'shelf16' => $this->book->where('book_category', 'TEACHER\'S REFERENCES')->where('book_shelf', '16')->orderBy('book_title')->findAll(),
        ];
        return view('teacher_references', $data);
    }

    public function searchShelf16()
    {
        $data = [
            'shelf16' => $this->book->where('book_category', 'TEACHER\'S REFERENCES')->where('book_shelf', '16')
            ->like($this->request->getVar('categ'), $this->request->getVar('search'))
            ->orderBy('book_title')->findAll(),
            'shelf15' => $this->book->where('book_category', 'TEACHER\'S REFERENCES')->where('book_shelf', '15')->orderBy('book_title')->findAll(),
        ];
        return view('teacher_references', $data);
    }
    
    public function other_textbooks()
    {
        $data = [
            'shelf17' => $this->book->where('book_category', 'OTHER TEXTBOOKS')->where('book_shelf', '17')->orderBy('book_title')->findAll(),
            'shelf18' => $this->book->where('book_category', 'OTHER TEXTBOOKS')->where('book_shelf', '18')->orderBy('book_title')->findAll(),
        ];
        return view('other_textbooks', $data);
    }

    public function searchShelf17()
    {
        $data = [
            'shelf17' => $this->book->where('book_category', 'OTHER TEXTBOOKS')->where('book_shelf', '17')
            ->like($this->request->getVar('categ'), $this->request->getVar('search'))
            ->orderBy('book_title')->findAll(),
            'shelf18' => $this->book->where('book_category', 'OTHER TEXTBOOKS')->where('book_shelf', '18')->orderBy('book_title')->findAll(),
        ];
        return view('other_textbooks', $data);
    }

    public function searchShelf18()
    {
        $data = [
            'shelf18' => $this->book->where('book_category', 'OTHER TEXTBOOKS')->where('book_shelf', '18')
            ->like($this->request->getVar('categ'), $this->request->getVar('search'))
            ->orderBy('book_title')->findAll(),
            'shelf17' => $this->book->where('book_category', 'OTHER TEXTBOOKS')->where('book_shelf', '17')->orderBy('book_title')->findAll(),
        ];
        return view('other_textbooks', $data);
    }

    public function searchBook()
    {
        $data = [
            'booky' => $this->book->like($this->request->getVar('categ'), $this->request->getVar('search'))->orderBy('book_title')->findAll(),
        ];
        return view('books', $data);
    }

    public function deleteBorrow($id)
    {
        $session = session();
        $res = $this->borrowedBook->delete($this->encrypter->decrypt(hex2bin($id)));
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
            'borrow' => $this->book->select('borrowedbooks.id as id, first_name, middle_name, last_name, student_id, book_title, book_shelf, 
            ISBN, borrowedbooks.book_qty as book_qty, date_borrowed, date_returned, date_to_be_return, payment_status, fines, borrowedbooks.status as status, book_type')
            ->join('borrowedbooks','borrowedbooks.book_id = books.id','inner')
            ->orderBy('books.book_title')->join('student_learner','student_learner.account_id = borrowedbooks.account_id','inner')
            ->join('admissions','admissions.account_id = borrowedbooks.account_id','inner')->FindAll(),
            'borrowed' => $this->borrowedBook->select('borrowedbooks.id as id, first_name, middle_name, last_name, student_id, book_title, book_shelf, 
            ISBN, borrowedbooks.book_qty as book_qty, date_borrowed, date_returned, date_to_be_return, payment_status, TIMESTAMPDIFF(HOUR, date_to_be_return, date_returned) * 6 as HOURFINE, TIMESTAMPDIFF(HOUR, date_to_be_return, CURDATE()) * 6 as CHOURFINE, TIMESTAMPDIFF(DAY, date_to_be_return, date_returned) * 3 as DAYFINE, TIMESTAMPDIFF(DAY, date_to_be_return, CURDATE()) * 3 as CDAYFINE, borrowedbooks.status as status, book_type, book_id')
            ->join('books','books.id = borrowedbooks.book_id','inner')->join('student_learner','student_learner.account_id = borrowedbooks.account_id','inner')
            ->join('admissions','admissions.account_id = borrowedbooks.account_id','inner')->where('borrowedbooks.id', $this->encrypter->decrypt(hex2bin($id)))->first(),
            'booky' => $this->book->orderBy('book_title')->findAll(),
        ];

        return view('borrowers', $data);
        
    }

    public function deleteBook($id)
    {
        $session = session();
        $res = $this->book->delete($this->encrypter->decrypt(hex2bin($id)));
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
            'booky' => $this->book->orderBy('book_title')->findAll(),
            'booke' => $this->book->where('id', $this->encrypter->decrypt(hex2bin($id)))->first(),
        ];
        return view('books', $data);
    }

}
