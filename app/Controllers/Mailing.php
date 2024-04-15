<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;
use NotificationAPI\NotificationAPI;
use App\Controllers\BaseController;

class Mailing extends BaseController
{
    private $acc;

    public function __construct() {
        $this->acc = new \App\Models\AccountModel();
    }

    public function ask() {
      $sender = $this->request->getVar('sender');
      $message = $this->request->getVar('message');

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
                  'refreshToken' => '1//0gEXq5M_HNKxPCgYIARAAGBASNwF-L9IrD7uHL_3rMFWrJKDq-DZn2c6gLrKOVZ3vGTASBmFWQJvq_ErmjVqbC-2NfKFOWOPee7I',
                  'userName' => 'developers.pga@gmail.com',
              ]
          )
      );

      //sender information

      //receiver email address and name
      $mail->addAddress('developers.pga@gmail.com'); 

      $mail->isHTML(true);

      $mail->Subject = 'Ask Now';
      $mail->Body    = '<h2><b>From: '.$sender.'</b></h2><hr><h3>'.$message.'</h3>';
              
      // Send mail   
      if (!$mail->send()) {
          $mail->smtpClose();
          $session->setFlashdata('msg','Something went wrong. Please try again later.');
          return redirect()->to('/');
      } else {
          $mail->smtpClose();
          $session->setFlashdata('msg','Sent Successfully.');
          return redirect()->to('/');
      }

  }

  public function notif() {
    $notificationapi = new NotificationAPI(
      '6ksflc9io74p8j88pudf5vsu37', // clientId
      '2k2noebls72uuop9n1qqd31e91d0c6he1d3m17c3e7d5c2h2mbh' // clientSecret
    );
    
    $notificationapi->send([
      "notificationId" => "new_comment",
      "user" => [
        "id" => "developers.pga@gmail.com",
        "email" => "developers.pga@gmail.com",
        "number" => "09760654360" // Replace with your phone number
      ],
      "mergeTags" => [
        "comment" => "Build something great  =>)",
        "commentId" => "commentId-1234-abcd-wxyz"
      ]
    ]);
  }

}
