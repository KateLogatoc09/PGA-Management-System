<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\Sections;
use App\Controllers\BaseController;

class SectionController extends BaseController

{
    use ResponseTrait;

    public function index()
    {
        $model = new Sections(); // Replace YourModel with the actual model name
        $data = $model->findAll();

        return $this->respond($data);
    }
}
