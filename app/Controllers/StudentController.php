<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class StudentController extends BaseController
{
    public function index()
    {
        return view('student');
    }


}
