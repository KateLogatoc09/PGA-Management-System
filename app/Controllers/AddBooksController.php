<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AddBooksModel;

class AddBooksController extends BaseController
{
    public function index()
    {
        return view('library');
    }

    public function saveData()
    {
        $addBooksModel = new AddBooksModel();
    
        $data = [
            'book_title' => $this->request->getPost('bookTitle'),
            'book_number' => $this->request->getPost('bookNumber'),
            'book_author' => $this->request->getPost('bookAuthor'),
            'date_publish' => $this->request->getPost('datePublish'),
        ];
    
        if ($addBooksModel->insert($data)) {
            // Insertion successful
            return redirect()->to('/li?status=success');
        } else {
            // Insertion failed
            return redirect()->to('/li?status=error');
        }
    }
    
    
}
