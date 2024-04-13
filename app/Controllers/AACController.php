<?php

namespace App\Controllers;
use App\Models\Subjects;
use App\Models\Sections;

use App\Controllers\BaseController;

class AACController extends BaseController
{
    private $section, $subjects;
    public function __construct()
    {
        $this->sections = new Sections();
        $this->subjects = new Subjects();
    }

    public function AAC(){
            return view ('AAC');
        }

        public function aacsections()
        {
            $data = [
                'stud_section' => $this->sections->findAll(),
            ];
                return view ('aacsections', $data);
        }
    
        public function aacsaveSection()  {
            $session = session();
            $id = $_POST['id'];
            $data = [
                'id' => $this->request->getVar('id'),
                'name' => $this->request->getVar('name'),
                'grade_level_id' => $this->request->getVar('grade_level_id'),
            ];
    
            if ($id != null) {
                $res = $this->sections->set($data)->where('id', $id)->update();
                if($res) {
                    $session->setFlashdata('msg','Updated Successfully.');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
            } else {
                $res = $this->sections->save($data);
                if($res) {
                    $session->setFlashdata('msg','Saved Successfully.');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
            }  
            return redirect()->to('aacsections');
        }
    
        public function aacdeleteSection($id)
        {
            $session = session();
            $res = $this->sections->delete($id);
            if($res) {
                $session->setFlashdata('msg','Deleted Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
            return redirect()->to('aacsections');
        }
    
        
        public function aaceditSection($id)
        {
            $data = [
                'stud_section' => $this->sections->findAll(),
                'sec' => $this->sections->where('id', $id)->first(),
            ];
    
            return view('aacsections', $data);
        }
    
        
        public function aacsubjects()
        {
            $data = [
                'subject' => $this->subjects->findAll(),
            ];
                return view ('aacsubjects', $data);
        }
    
        public function aacsaveSubject()  {
            $session = session();
            $id = $_POST['id'];
            $data = [
                'id' => $this->request->getVar('id'),
                'name' => $this->request->getVar('name'),
                'type' => $this->request->getVar('type'),
                'yr_lvl' => $this->request->getVar('yr_lvl'),
            ];
    
            if ($id != null) {
                $res = $this->subjects->set($data)->where('id', $id)->update();
                if($res) {
                    $session->setFlashdata('msg','Updated Successfully.');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
            } else {
                $res = $this->subjects->save($data);
                if($res) {
                    $session->setFlashdata('msg','Saved Successfully.');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
            }  
            return redirect()->to('aacsubjects');
        }
    
        public function deleteSubject($id)
        {
            $session = session();
            $res = $this->subjects->delete($id);
            if($res) {
                $session->setFlashdata('msg','Deleted Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
            return redirect()->to('aacsubjects');
        }
    
        
        public function aaceditSubject($id)
        {
            $data = [
                'subject' => $this->subjects->findAll(),
                'sub' => $this->subjects->where('id', $id)->first(),
            ];
    
            return view('aacsubjects', $data);
        }
    
}
