<?php

namespace App\Controllers;
use App\Models\AnnouncementModel;
use App\Models\NotificationModel;
use App\Controllers\BaseController;
use App\Models\ApplicationModel;
use App\Models\FeedbackModel;
use App\Models\AccountModel;

class GeneralController extends BaseController
{
    private $notification, $app, $acc, $feedback, $announce;
    public function __construct()
    {
        $this->notification = new NotificationModel();
        $this->announce = new AnnouncementModel();
        $this->app = new ApplicationModel();
        $this->acc = new AccountModel();
        $this->feedback = new FeedbackModel();
    }

    public function general(){
            $data = [
                'announcement' => $this->announce->findAll(),
            ];
            return view ('general', $data);
        }
    
    public function feedback(){
        $acc = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
        $data = [
            'sfeed' => $this->feedback->where('account_id',$acc)->first(),
        ];
            return view ('feedback', $data);
        }
    
        public function sendfeedback()  {
            $session = session();
            $id = $_POST['id'];
            $data = [
                'rating' => $this->request->getPost('rating'),
                'comment' => $this->request->getPost('comment'),   
                'account_id' => $this->acc->select('id')->where('username', $_SESSION['username'])->first(), 
            ];
            if($id != null) {
                $res = $this->feedback->set($data)->where('id', $id)->update();
                if($res) {
                    $session->setFlashdata('msg','Feedback Sent Successfully.');             
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                } 
            } else {
            $res = $this->feedback->save($data);
                if($res) {
                    $session->setFlashdata('msg','Feedback Sent Successfully.');             
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }   
            }
            return redirect()->to('feedback');
        }
    

    public function notification(){
        $data = [
            'notif' => $this->notification->findAll(),
        ];

            return view ('notification', $data);
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

    public function apply_st() {
            $session = session();
            $valid_id = $this->request->getFile('valid_id');
            $card = $this->request->getFile('card');
            $birth_cert = $this->request->getFile('birth_cert');
            $fullname = $this->request->getVar('fullname');
            $acc = $this->acc->select('id')->where('username', $_SESSION['username'])->first();
    
                //birth
                $test1 = $valid_id->move(PUBLIC_PATH.'\\account\\'.$acc['id'].'\\');
                $name1 = $valid_id->getClientPath();
                $path1 = '/account/'.$acc['id'].'/'.$name1;
                //report
                $test2 = $card->move(PUBLIC_PATH.'\\account\\'.$acc['id'].'\\');
                $name2 = $card->getClientPath();
                $path2 = '/account/'.$acc['id'].'/'.$name2;
                //moral
                $test3 = $birth_cert->move(PUBLIC_PATH.'\\account\\'.$acc['id'].'\\');
                $name3 = $birth_cert->getClientPath();
                $path3 = '/account/'.$acc['id'].'/'.$name3;

    
                $data = [
                    'fullname' => $fullname,
                    'valid_id' => $path1,
                    'card' => $path2,
                    'birth_cert' => $path3,
                    'type' => 'STUDENT',
                    'account_id' => $acc,
                ];
                    $res = $this->app->save($data);
                    if($res) {
                        $session->setFlashdata('msg','Saved Successfully.');             
                        return redirect()->to('applyConfirm');
                    } else {
                        $session->setFlashdata('msg','Something went wrong. Please try again later.');
                    }
                

            return redirect()->to('applyStudent');
        
    }

    public function apply_pr() {
        $session = session();
        $valid_id = $this->request->getFile('valid_id');
        $birth_cert = $this->request->getFile('birth_cert');
        $fullname = $this->request->getVar('fullname');
        $acc = $this->acc->select('id')->where('username', $_SESSION['username'])->first();

            //birth
            $test1 = $valid_id->move(PUBLIC_PATH.'\\account\\'.$acc['id'].'\\');
            $name1 = $valid_id->getClientPath();
            $path1 = '/account/'.$acc['id'].'/'.$name1;
            //moral
            $test3 = $birth_cert->move(PUBLIC_PATH.'\\account\\'.$acc['id'].'\\');
            $name3 = $birth_cert->getClientPath();
            $path3 = '/account/'.$acc['id'].'/'.$name3;


            $data = [
                'fullname' => $fullname,
                'valid_id' => $path1,
                'card' => '',
                'birth_cert' => $path3,
                'type' => 'PARENT',
                'account_id' => $acc,
            ];
                $res = $this->app->save($data);
                if($res) {
                    $session->setFlashdata('msg','Saved Successfully.');             
                    return redirect()->to('applyConfirm');
                } else {
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                }
            

        return redirect()->to('applyParent');
    
}
}
