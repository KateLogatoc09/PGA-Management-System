<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BorrowedBooksModel; // Update the use statement for BorrowedBooksModel

class LibraryController extends BaseController
{
    public function index()
    {
        return view('library');
    }

 
    public function saveData()
    {
        // Update the use statement for BorrowedBooksModel
        $borrowedBooksModel = new BorrowedBooksModel();

        $data = [
            'book_title' => $this->request->getPost('bookTitle'),
            'book_number' => $this->request->getPost('bookNumber'),
            'student_id' => $this->request->getPost('studIDnum'),
            'student_section' => $this->request->getPost('studSec'),
            'student_year_level' => $this->request->getPost('studYearLevel'),
            'date_borrowed' => $this->request->getPost('dateBorrowed'),
            'date_return' => $this->request->getPost('dateReturn'),
        ];

                // Insert data and handle errors
            if ($borrowedBooksModel->insert($data)) {
                // Redirect with a success query parameter
                return redirect()->to('/li?status=success');
            } else {
                // Redirect with an error query parameter
                return redirect()->to('/li?status=error');
            }

    }
}
