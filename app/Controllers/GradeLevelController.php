<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\GradeLevel;
use App\Controllers\BaseController;

class GradeLevelController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $model = new GradeLevel(); // Replace YourModel with the actual model name
        $data = $model->findAll();

        return $this->respond($data);
    }
}
