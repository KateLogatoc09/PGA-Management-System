<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GradeModel;

class GradeController extends BaseController
{
    public function index()
    {

        return view('student/content/graph', $data);
    }

    private function getChartData()
    {
        $chartModel = new GradeModel(); // Replace with your actual model name
        $data = $chartModel->findAll();

        return $data;
    }
    
}
