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
    private $acc;

    public function __construct() {
        $this->acc = new \App\Models\AccountModel();
    }

    public function simple_qr() {
        $input = $this->request->getVar('id');
        $qrcode = new Generator;
        $session = session();
        $session->setFlashdata('qr', $qrcode->size(120)->generate($input));
        return redirect()->to('qr-generator');
    }
}
