<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GradeModel;
use App\Models\Subjects;

class TeacherController extends BaseController
{
    private $grade, $subjects;
    public function __construct()
    {
        $this->grade = new GradeModel();
        $this->subjects = new Subjects();
    }

    public function teacher(){
            return view ('teacher');
        }

        public function grade()
    {
            $data = [
                'grade' => $this->grade->findAll(),
                'subject' => $this->subjects->findAll(),
                ];
            return view ('grade', $data);
    }
    
        public function saveGrade()  {
            $session = session();
            $id = $_POST['id'];
            $data = [
                'student_id' => $this->request->getVar('student_id'),
                'teacher_id' => $this->request->getVar('teacher_id'),
                'subject' => $this->request->getVar('subject'),
                'grade' => $this->request->getVar('grade'),
            ];
    
            if ($id != null) {
                $res = $this->grade->set($data)->where('id', $id)->update();
                if($res) {
                    $session->setFlashdata('msg','Updated Successfully.');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
            } else {
                $res = $this->grade->save($data);
                if($res) {
                    $session->setFlashdata('msg','Saved Successfully.');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
            }   
            return redirect()->to('grade');
        }
    
        public function deleteGrade($id)
        {
            $session = session();
            $res = $this->grade->delete($id);
            if($res) {
                $session->setFlashdata('msg','Deleted Successfully.');
            } else {
                $session->setFlashdata('msg','Something went wrong. Please try again later.');
            }
            return redirect()->to('grade');
        }
    
        
        public function editGrade($id)
        {
            $data = [
                'grade' => $this->grade->findAll(),
                'subject' => $this->subjects->findAll(),
                'gr' => $this->grade->where('id', $id)->first(),
            ];
    
            return view('grade', $data);
            
        }
}
