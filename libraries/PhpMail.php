<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PhpMail{
    
    public function send_mail($mailbody)
    {
    //  echo APPPATH;exit;
        require_once APPPATH.'third_party/class.phpmailer.php';
        
    
   $from_address = "dev.spryox@gmail.com";
   $from_name = "no-reply@meddistant.com";
   $alt_body = "To view the message, please use an HTML compatible email viewer!";
   $email_subject = 'Verify Email';

   $mail = new PHPMailer();
   $email = "tushar.spryox@gmail.com";

    // $mail->IsSMTP();
    $mail->SMTPDebug  = 1;
    $mail->SMTPAuth   = false;
    $mail->Host       = "smtp.gmail.com";
    $mail->Port       = "587";
    $mail->Username   = "dev.spryox@gmail.com";
    $mail->Password   = "Spryoxr0cks&*^";
    $mail->SMTPSecure = "tls";

   

 // print_r($mail);exit;
   $mail->SetFrom($from_address, $from_name);
  

   $mail->AddAddress($email);

   $mail->Subject = $email_subject;
   $mail->AltBody = $alt_body; // optional, comment out and test
   $mail->MsgHTML($mailbody);
   if(!$mail->Send())
   {
       echo "Error in sending mail";exit;
   }
   else
   {
        // echo "Mail sent successfully";exit;
   }
    }
}

?>