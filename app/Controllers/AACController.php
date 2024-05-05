<?php

namespace App\Controllers;
use App\Models\Subjects;
use App\Models\Sections;
use App\Models\LearnerModel;

use App\Controllers\BaseController;

class AACController extends BaseController
{
    private $section, $subjects, $learner;
    public function __construct()
    {
        $this->sections = new Sections();
        $this->subjects = new Subjects();
        $this->learner = new LearnerModel();
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
        
    public function searchAacsection()
    {
        $data = [
            'stud_section' => $this->sections->like('name', $this->request->getVar('search'))->findAll(),
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
                'subject' => $this->subjects->orderBy('name')->findAll(),
            ];
                return view ('aacsubjects', $data);
        }

        
    public function searchAacsubject()
    {
        $data = [
            'subject' => $this->subjects->like('name', $this->request->getVar('search'))->orderBy('name')->findAll(),
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
  
    public function searchCecelia()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->where('section', '15')->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->like('last_name', $this->request->getVar('search'))->orLike('first_name', $this->request->getVar('search'))
            ->orLike('middle_name', $this->request->getVar('search'))->orLike('student_id', $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Cecelia', $data);
    }

    public function searchTherese()
    {
        $data = [
            'student' => $this->learner->where('section', '14')->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->like('last_name', $this->request->getVar('search'))->orLike('first_name', $this->request->getVar('search'))
            ->orLike('middle_name', $this->request->getVar('search'))->orLike('student_id', $this->request->getVar('search'))
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Therese_of_Lisieux', $data);
    }

    public function St_Joseph_Husband_of_Mary()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')->where('section', '1')
            ->orderBy('student_learner.last_name')->FindAll(),
       ];
        return view('St_Joseph_Husband_of_Mary', $data);
    }

    public function St_Perpetua_and_Felicity()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '2')->FindAll(),
       ];
        return view('St_Perpetua_and_Felicity', $data);
    }

    public function St_Louise_de_Marillac()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '3')->FindAll(),
       ];
        return view('St_Louise_de_Marillac', $data);
    }

    public function St_Dominic_Savio()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '4')->FindAll(),
       ];
        return view('St_Dominic_Savio', $data);
    }

    public function St_Pedro_Calungsod()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '5')->FindAll(),
       ];
        return view('St_Pedro_Calungsod', $data);
    }

    public function St_Gemma_Galgani()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '6')->FindAll(),
       ];
        return view('St_Gemma_Galgani', $data);
    }

    public function St_Catherine_of_Siena()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '7')->FindAll(),
       ];
        return view('St_Catherine_of_Siena', $data);
    }

    public function St_Lawrence_of_Manila()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '8')->FindAll(),
       ];
        return view('St_Lawrence_of_Manila', $data);
    }

    public function St_Pio_of_Pietrelcina()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '9')->FindAll(),
       ];
        return view('St_Pio_of_Pietrelcina', $data);
    }

    public function St_Matthew_the_Evangelist()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '10')->FindAll(),
       ];
        return view('St_Matthew_the_Evangelist', $data);
    }

    public function St_Jerome_of_Stridon()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '11')->FindAll(),
       ];
        return view('St_Jerome_of_Stridon', $data);
    }

    public function St_Francis_of_Assisi()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '12')->FindAll(),
       ];
        return view('St_Francis_of_Assisi', $data);
    }

    public function St_Luke_the_Evangelist()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '13')->FindAll(),
       ];
        return view('St_Luke_the_Evangelist', $data);
    }
    
    public function St_Therese_of_Lisieux()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '14')->FindAll(),
       ];
        return view('St_Therese_of_Lisieux', $data);
    }

    public function St_Cecelia()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '15')->FindAll(),
       ];
        return view('St_Cecelia', $data);
    }

    public function St_Martin_the_Porres()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '16')->FindAll(),
       ];
        return view('St_Martin_the_Porres', $data);
    }

    public function St_Albert_the_Great()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '17')->FindAll(),
       ];
        return view('St_Albert_the_Great', $data);
    }

    public function St_Stephen()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '18')->FindAll(),
       ];
        return view('St_Stephen', $data);
    }

    public function St_Francis_Xavier()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '19')->FindAll(),
       ];
        return view('St_Francis_Xavier', $data);
    }

    public function St_John_the_Beloved()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '20')->FindAll(),
       ];
        return view('St_John_the_Beloved', $data);
    }

    public function St_Joseph_Freinademetz()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '21')->FindAll(),
       ];
        return view('St_Joseph_Freinademetz', $data);
    }

    public function St_Thomas_Aquinas()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '22')->FindAll(),
       ];
        return view('St_Thomas_Aquinas', $data);
    }

    
    public function St_Arnold_Janssen()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '23')->FindAll(),
       ];
        return view('St_Arnold_Janssen', $data);
    }

    
    public function St_Agatha_Sicily()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '24')->FindAll(),
       ];
        return view('St_Agatha_Sicily', $data);
    }

    
    public function St_Scholastica()
    {
        $data = [
            'student' => $this->learner->select('admissions.id as id, first_name, middle_name, last_name, student_id, name, section, category,yr_lvl,program')
            ->join('admissions','admissions.account_id = student_learner.account_id','inner')->join('sections','sections.id = admissions.section','left')
            ->orderBy('student_learner.last_name')->where('section', '25')->FindAll(),
       ];
        return view('St_Scholastica', $data);
    }
}
