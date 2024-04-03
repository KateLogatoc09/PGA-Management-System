<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;
use SimpleSoftwareIO\QrCode\Generator;
use App\Controllers\BaseController;

class Attendance extends BaseController
{
    private $acc, $att;

    public function __construct() {
        $this->acc = new \App\Models\AccountModel();
        $this->att  = new \App\Models\AttendanceModel();
    }

    public function simple_qr() {
        $input = $this->request->getVar('id');
        $qrcode = new Generator;
        $session = session();
        $session->setFlashdata('qr', $qrcode->size(120)->generate($input));
        return redirect()->to('qr-generator');
    }

    public function time_in() {
        date_default_timezone_set('Asia/Singapore');

        $data = [
            'student_id' => $this->request->getVar('sid'),
            'type' => 'IN',
            'time' => date("Y-m-d H:i:s"),
        ];

        $this->att->save($data);
        return redirect()->to('attendance_in');
        
    }

    public function attendance_in()
    {
        $data = [
            'attendance' => $this->att->select('*')->where('type', 'IN')->FindAll(),
        ];
        return view('attendancein', $data);
    }
}
