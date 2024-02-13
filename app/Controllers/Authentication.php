<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;
use App\Controllers\BaseController;
use App\Models\AccountModel;

class Authentication extends BaseController
{
    private $acc;
    public function __construct()
    {
        $this->acc = new AccountModel();
  
    }

    public function is_password_strong($password)
    {
        if (preg_match('#[0-9]#', $password) && preg_match('#[a-zA-Z]#', $password)) {
            return TRUE;
        }
        return FALSE;
    }


    public function Logout() {
        $random = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ", 60)), 0, 60);
        $newToken = $random;
        $session = session();

        if(isset($_SESSION['token'])) {
            $this->acc->set('token', sha1($newToken))->where('token', sha1($_SESSION['token']))->update();
        }

        session_destroy();
        return redirect()->to('login');
    }

    public function LoginAuth() {

        $random = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ", 60)), 0, 60);
        $newToken = $random;

        $session = session();
        $user = $this->request->getVar('email-username');
        $password = $this->request->getVar('password');

        $data1 = $this->acc->where('username', $user)->first();
        $data2 = $this->acc->where('email', $user)->first();

        if($data1){
            $pass = $data1['password'];
            $authenticatePassword = password_verify($password, $pass);
                
            if($authenticatePassword){
                if($data1['status'] == 'ACTIVE') {
                    $res = $this->acc->set(['token' => sha1($newToken), 'activity' => date("Y-m-d H:i:s")])->where('username', $user)->update();
                    if($res) {
                        $ses_data = [
                            'username' => $data1['username'],
                            'role' => $data1['role'],
                            'token' => $newToken,
                            'isLoggedin' => true,
                        ];
                        $session->set($ses_data);

                        $session->setFlashdata('msg','Logged-in Successfully.');

                        if($_SESSION['role'] == 'STUDENT'){
                            return redirect()->to('/student');
                        }
                        else if($_SESSION['role'] == 'TEACHER'){
                            return redirect()->to('/teacher');
                        }
                        else if($_SESSION['role'] == 'LIBRARIAN'){
                            return redirect()->to('/librarian');
                        }
                        else{
                            return redirect()->to('/admins');
                        }
                    } else {
                        $session->setFlashdata('msg','Something went wrong. Please try again later.');
                        return redirect()->to('login');
                    }
                } else if($data1['status'] == 'VERIFIED') {
                    $res = $this->acc->set(['token'=> sha1($newToken), 'status' => 'ACTIVE','activity' => date("Y-m-d H:i:s")])->where('username', $user)->update();
                    if($res) {
                        $ses_data = [
                            'username' => $data1['username'],
                            'role' => $data1['role'],
                            'token' => $newToken,
                            'isLoggedin' => true,
                        ];
                        $session->set($ses_data);

                        $session->setFlashdata('msg','Logged-in Successfully.');

                        if($_SESSION['role'] == 'STUDENT'){
                            return redirect()->to('/student');
                        }
                        else if($_SESSION['role'] == 'TEACHER'){
                            return redirect()->to('/teacher');
                        }
                        else if($_SESSION['role'] == 'LIBRARIAN'){
                            return redirect()->to('/librarian');
                        }
                        else{
                            return redirect()->to('/admins');
                        }
                    } else {
                        $session->setFlashdata('msg','Something went wrong. Please try again later.');
                        return redirect()->to('login');
                    }
                } else if($data1['status'] == 'UNVERIFIED' || $data1['status'] == 'INACTIVE') {
                    $session->setFlashdata('msg','Verify your account first before log-in.');
                    return redirect()->to('verify');
                } else if($data1['status'] == 'PENDING') {
                    $session->setFlashdata('msg','Your account is under review. Please provide us any additional details and information for a quick confirmation of your account.');
                    return redirect()->to('contact');
                } else if($data1['status'] == 'SUSPENDED') {
                    $session->setFlashdata('msg','Your account is suspended for'.$data1['suspension'].'. Contact us for any additional details.');
                    return redirect()->to('contact');
                } else {
                    $session->setFlashdata('msg','Your account is permanently banned. Contact us for any additional details.');
                    return redirect()->to('contact');
                }

            }else{
                $session->setFlashdata('msg','Password is incorrect.');
                return redirect()->to('login');
            }

        } else if($data2) {

            $pass = $data2['password'];
            $authenticatePassword = password_verify($password, $pass);
                
            if($authenticatePassword){
                if($data2['status'] == 'ACTIVE') {
                    $res = $this->acc->set(['token' => sha1($newToken), 'activity' => date("Y-m-d H:i:s")])->where('email', $user)->update();
                    if($res) {
                        $ses_data = [
                            'username' => $data2['username'],
                            'role' => $data2['role'],
                            'token' => $newToken,
                            'isLoggedin' => true,
                        ];
                        $session->set($ses_data);

                        $session->setFlashdata('msg','Logged-in Successfully.');

                        if($_SESSION['role'] == 'STUDENT'){
                            return redirect()->to('/student');
                        }
                        else if($_SESSION['role'] == 'TEACHER'){
                            return redirect()->to('/teacher');
                        }
                        else if($_SESSION['role'] == 'LIBRIRIAN'){
                            return redirect()->to('/librarian');
                        }
                        else{
                            return redirect()->to('/admins');
                        }
                    } else {
                        $session->setFlashdata('msg','Something went wrong. Please try again later.');
                        return redirect()->to('login');
                    }
                } else if($data2['status'] == 'VERIFIED') {
                    $res = $this->acc->set(['token' => sha1($newToken), 'status' => 'ACTIVE', 'activity' => date("Y-m-d H:i:s")])->where('email', $user)->update();
                    if($res) {
                        $ses_data = [
                            'username' => $data2['username'],
                            'role' => $data2['role'],
                            'token' => $newToken,
                            'isLoggedin' => true,
                        ];
                        $session->set($ses_data);

                        $session->setFlashdata('msg','Logged-in Successfully.');

                        if($_SESSION['role'] == 'STUDENT'){
                            return redirect()->to('/student');
                        }
                        else if($_SESSION['role'] == 'TEACHER'){
                            return redirect()->to('/teacher');
                        }
                        else if($_SESSION['role'] == 'LIBRIRIAN'){
                            return redirect()->to('/librarian');
                        }
                        else{
                            return redirect()->to('/admins');
                        }
                    } else {
                        $session->setFlashdata('msg','Something went wrong. Please try again later.');
                        return redirect()->to('login');
                    }
                } else if($data2['status'] == 'UNVERIFIED' || $data2['status'] == 'INACTIVE') {
                    $session->setFlashdata('msg','Verify your account first before log-in.');
                    return redirect()->to('verify');
                } else if($data2['status'] == 'PENDING') {
                    $session->setFlashdata('msg','Your account is under review. Please provide us any additional details and information for a quick confirmation of your account.');
                    return redirect()->to('contact');
                } else if($data2['status'] == 'SUSPENDED') {
                    $session->setFlashdata('msg','Your account is suspended for'.$data2['suspension'].'. Contact us for any additional details.');
                    return redirect()->to('contact');
                } else {
                    $session->setFlashdata('msg','Your account is permanently banned. Contact us for any additional details.');
                    return redirect()->to('contact');
                }
            } else {
                $session->setFlashdata('msg','Password is incorrect.');
                return redirect()->to('login');
            }
        } else {
            $session->setFlashdata('msg','User does not exist.');
            return redirect()->to('login');
        };
    }

    public function Register() {
        $random = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ", 60)), 0, 60);
        $Token = $random;

        $session = session();
        helper(['form']);
        $rules =[
            'username' => 'required|min_length[6]|max_length[100]|is_unique[accounts.username]',
            'email' => 'valid_email|is_unique[accounts.email]',
            'password' =>'required|min_length[8]|max_length[50]|',
            'cpassword' => 'matches[password]',
        ];
            if($this->validate($rules)){

            $data =[
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getVar('role'),
            'status' => 'UNVERIFIED',
            'token' => sha1($Token),
            ];

            $this->acc->save($data);

            $session->setFlashdata('msg', 'Please verify your account before log-in.');
            return redirect()->to('verify');
        }else{

            $data['validation'] = $this->validator;
            $session->setFlashdata('validator', $this->validator->getErrors());
            return redirect()->to('reg');
        };
    }

    //VERIFICATION
    public function sending() {

        $shuffle = substr(str_shuffle(str_repeat("0123456789", 6)), 0, 6);
        $code = $shuffle;

        $session = session();

        $user = $this->request->getVar('email');
        $check = $this->acc->where('email', $user)->first();
        if($check){
            if($check['status'] == 'UNVERIFIED' || $check['status'] == 'INACTIVE') {
                $mail = new PHPMailer();
        $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;
                $mail->AuthType = 'XOAUTH2';

                $provider = new Google(
                    [
                        'clientId' => '80579387547-1nvlh9celk9oath3ud4c5cng70e85eoa.apps.googleusercontent.com',
                        'clientSecret' => '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',
                    ]
                );

                $mail->setOAuth(
                    new OAuth(
                        [
                            'provider' => $provider,
                            'clientId' => '80579387547-1nvlh9celk9oath3ud4c5cng70e85eoa.apps.googleusercontent.com',
                            'clientSecret' => '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',
                            'refreshToken' => '1//0e81PK8YLhTUECgYIARAAGA4SNwF-L9IrnZji3Qh3a4qdrjZnSsZUbh7HbplDDGo1mn4KiQUIcXydcSQzbSUDKz233CVLOUqRVGA',
                            'userName' => 'developers.pga@gmail.com',
                        ]
                    )
                );

                //sender information
                $mail->setFrom('developers.pga@gmail.com', 'PGA developers');

                //receiver email address and name
                $mail->addAddress($user); 

                $mail->isHTML(true);

                $mail->Subject = 'Verify your account.';
                $mail->Body    = 'Your verification code is '.$code.'.';
                
                // Send mail   
                if (!$mail->send()) {
                    $mail->smtpClose();
                    $session->setFlashdata('msg','Something went wrong. Please try again later.');
                    return redirect()->to('/verify');
                } else {
                    $mail->smtpClose();
                    $ses_data = [
                        'verifier' => $user,
                        'code' => sha1($code),
                    ];
                    $session->set($ses_data);
                    return redirect()->to('/verifying');
                }
            } else if($check['status'] == 'ACTIVE' || $check['status'] == 'PENDING') {
                $session->setFlashdata('msg','Account has already been verified.');
                return redirect()->to('login');
            } else {
                $session->setFlashdata('msg','Account might have been suspended or permanently banned.');
                return redirect()->to('login');
            }

        } else {
            $session->setFlashdata('msg','User does not exist.');
            return redirect()->to('login');
        } 

    }

    public function resend() {
        $shuffle = substr(str_shuffle(str_repeat("0123456789", 6)), 0, 6);
        $code = $shuffle;

        $session = session();

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->AuthType = 'XOAUTH2';

        $provider = new Google(
            [
                'clientId' => '80579387547-1nvlh9celk9oath3ud4c5cng70e85eoa.apps.googleusercontent.com',
                'clientSecret' => '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',
            ]
        );

        $mail->setOAuth(
            new OAuth(
                [
                    'provider' => $provider,
                    'clientId' => '80579387547-1nvlh9celk9oath3ud4c5cng70e85eoa.apps.googleusercontent.com',
                    'clientSecret' => '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',
                    'refreshToken' => '1//0e81PK8YLhTUECgYIARAAGA4SNwF-L9IrnZji3Qh3a4qdrjZnSsZUbh7HbplDDGo1mn4KiQUIcXydcSQzbSUDKz233CVLOUqRVGA',
                    'userName' => 'developers.pga@gmail.com',
                ]
            )
        );

        //sender information
        $mail->setFrom('developers.pga@gmail.com', 'PGA developers');

        //receiver email address and name
        $mail->addAddress($_SESSION['verifier']); 

        $mail->isHTML(true);

        $mail->Subject = 'Verify your account.';
        $mail->Body    = 'Your verification code is '.$code.'.';
                
        // Send mail   
        if (!$mail->send()) {
            $mail->smtpClose();
            $session->setFlashdata('msg','Something went wrong. Please try again later.');
            if(isset($_SESSION['verifier'])) {
                return redirect()->to('verify');
            } else {
                return redirect()->to('forgot');
            }
        } else {
            $mail->smtpClose();
            $ses_data = [
                'code' => sha1($code),
            ];
            $session->set($ses_data);

            if(isset($_SESSION['verifier'])) {
                return redirect()->to('verifying');
            } else {
                return redirect()->to('recovering');
            }
        }

    }

    public function checking() {
        $session = session();
        $code = $this->request->getVar('code');
        if(sha1($code) == $_SESSION['code']) {
            if(isset($_SESSION['verifier'])) {
                $role = $this->acc->select('role')->where('email', $_SESSION['verifier'])->first();
                if($role == 'INSTRUCTOR' || $role == 'PERSONNEL') {
                    $res = $this->acc->set('status', 'PENDING')->where('email', $_SESSION['verifier'])->update();
                    if($res) {
                        $session->remove(['verifier', 'code']);
                        $session->setFlashdata('msg','Your email was verified successfully. However, further verification are required to gain access to your account. Contact us for more details.');
                        return redirect()->to('contact');
                    } else {
                        $session->setFlashdata('msg','Something went wrong. Please try again later.');
                        return redirect()->to('verify');
                    }
                } else {
                    $res = $this->acc->set('status', 'VERIFIED')->where('email', $_SESSION['verifier'])->update();
                    if($res) {
                        $session->remove(['verifier', 'code']);
                        $session->setFlashdata('msg','Your account was verified successfully.');
                        return redirect()->to('login');
                    } else {
                        $session->setFlashdata('msg','Something went wrong. Please try again later.');
                        return redirect()->to('verify');
                    }
                }
            } else {
                $session->setFlashdata('msg','Create your new password.');
                $session->set(['once' => sha1('2024P#SSR/C')]);
                return redirect()->to('password');
            }
        } else {
            $session->setFlashdata('msg','Wrong Verification Code.');
            if(isset($_SESSION['verifier'])) {
                return redirect()->to('verifying');
            } else {
                return redirect()->to('recovering');
            }
        }
    }
}
