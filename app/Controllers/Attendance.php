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
    private $acc, $att;

    public function __construct() {
        $this->acc = new \App\Models\AccountModel();
        $this->att  = new \App\Models\AttendanceModel();
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

    public function time_out() {
        date_default_timezone_set('Asia/Singapore');

        $data = [
            'student_id' => $this->request->getVar('sid'),
            'type' => 'OUT',
            'time' => date("Y-m-d H:i:s"),
        ];

        $this->att->save($data);
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
