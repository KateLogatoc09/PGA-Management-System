<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class GeneralController extends BaseController
{
    public function general(){
            return view ('general');
        }
}
