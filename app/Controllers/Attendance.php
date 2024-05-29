<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;
use App\Controllers\BaseController;

class Attendance extends BaseController
{
    private $acc, $att, $config, $encrypter;

    public function __construct() {
        $this->config    = new \Config\Encryption();  
        $this->encrypter = \Config\Services::encrypter($this->config);
        $this->acc = new \App\Models\AccountModel();
        $this->att  = new \App\Models\AttendanceModel();
    }

    public function time_in() {
        date_default_timezone_set('Asia/Singapore');
        $session = session();

        if (ctype_xdigit($this->request->getVar('sid')) && strlen($this->request->getVar('sid')) % 2 == 0) {
            if(preg_match('/^MCC[0-9]{4}\-[0-9]{4}/',$this->encrypter->decrypt(hex2bin($this->request->getVar('sid'))))) {
            $data = [
                'idnumb' => $this->encrypter->decrypt(hex2bin($this->request->getVar('sid'))),
                'type' => 'IN',
                'time' => date("Y-m-d H:i:s"),
            ];

            $this->att->save($data);
            } else {
                $session->setFlashdata('msg','Invalid ID.');
            }
        } else {
            $session->setFlashdata('msg','Invalid ID.');
        }
        return redirect()->to('attendance_in');
        
    }

    public function time_out() {
        date_default_timezone_set('Asia/Singapore');

        $session = session();

        
        if (ctype_xdigit($this->request->getVar('sid')) && strlen($this->request->getVar('sid')) % 2 == 0) {
            if(preg_match('/^MCC[0-9]{4}\-[0-9]{4}/',$this->encrypter->decrypt(hex2bin($this->request->getVar('sid'))))) {
            $data = [
                'idnumb' => $this->encrypter->decrypt(hex2bin($this->request->getVar('sid'))),
                'type' => 'OUT',
                'time' => date("Y-m-d H:i:s"),
            ];

            $this->att->save($data);
            } else {
                $session->setFlashdata('msg','Invalid ID.');
            }
        } else {
            $session->setFlashdata('msg','Invalid ID.');
        }
        return redirect()->to('attendance_out');
        
    }

    public function attendance_in()
    {
        $data = [
            'attendance' => $this->att->select('*')->where('type', 'IN')->FindAll(),
        ];
        return view('attendancein', $data);
    }

    public function attendance_out()
    {
        $data = [
            'attendance' => $this->att->select('*')->where('type', 'OUT')->FindAll(),
        ];
        return view('attendanceout', $data);
    }
}
