<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class GeneralController extends BaseController
{
    public function general(){
            return view ('general');
        }

    public function applyStudent(){
            return view ('applyStudent');
        }
    
    public function applyParent(){
        return view ('applyParent');
    }

    public function applyConfirm(){
        return view ('applyConfirm');
    }

    
    public function announcement(){
        return view ('announcement');
    }
}
