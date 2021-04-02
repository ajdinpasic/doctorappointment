<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILe__)."/../../vendor/autoload.php";
require_once dirname(__FILe__)."/../config.php";



class SMTPclient {

  private $mailer;

  public function __construct() {

  $transport = (new Swift_SmtpTransport(Config::SMTP_HOST,Config::SMTP_PORT,Config::SMTP_ENCRYPTION))
    ->setUsername(Config::SMTP_USER)
    ->setPassword(Config::SMTP_PASSWORD);

  $this->mailer = new Swift_Mailer($transport);

}

public function send_token_for_registrationDoctor($doctor) {
  $message = (new Swift_Message('Confirmation of your account'))
    ->setFrom(['doctorappointment12345@gmail.com' => 'doctorappointment'])
    ->setTo([$doctor["doctor_email"]])
    ->setBody('Confirm your account by clicking the URL: http://localhost/doctorappointment/api/doctors/confirm/'.$doctor["token"]);


  $this->mailer->send($message);
}
public function send_token_for_registrationPatient($patient) {
  $message = (new Swift_Message('Confirmation of your account'))
    ->setFrom(['doctorappointment12345@gmail.com' => 'doctorappointment'])
    ->setTo([$patient["patient_email"]])
    ->setBody('Confirm your account by clicking the URL: http://localhost/doctorappointment/api/patients/confirm/'.$patient["token"]);


  $this->mailer->send($message);
}




}
 ?>
