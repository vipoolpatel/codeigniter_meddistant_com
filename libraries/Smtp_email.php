<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Smtp_email{



     public function send($from, $name,$toEmail, $cc, $subject,$msg){
     
	
// 		 $config = array (
// 				 'mailtype' => 'html',
// 				 'charset'  => 'utf-8',
// 				 'priority' => '1'
// 		 );
        
        $this->load->library('email');
        
        $this->email->initialize(array(
          'protocol' => 'smtp',
          'smtp_host' => 'smtp.sendgrid.net',
          'smtp_user' => 'masachusa12345',
          'smtp_pass' => 'masachusa123456',
          'smtp_port' => 587,
          'crlf' => "\r\n",
          'newline' => "\r\n"
        ));
        
        $this->email->from('your@example.com', 'Your Name');
        $this->email->to($toEmail);
        // $this->email->cc('another@another-example.com');
        // $this->email->bcc('them@their-example.com');
        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');
        $this->email->send();
echo $this->email->print_debugger();
// 		 $config = array (
// 				 'protocol' => 'smtp',
//                   'smtp_host' => 'smtp.sendgrid.net',
//                   'smtp_user' => 'masachusa12345',
//                   'smtp_pass' => 'masachusa123456',
//                   'smtp_port' => 587,
//                   'crlf' => "\r\n",
//                   'newline' => "\r\n"
// 		 );




//         $ci =& get_instance();
//         $ci->load->library('email');
//       	$ci->email->initialize($config);
// 		$ci->email->from('support@meddistant.com',$name);
// 		if($cc) {
// 			$ci->email->cc($cc);
// 		}

// 		$ci->email->to($toEmail);//to address here
// 		$ci->email->subject($subject);
//         $ci->email->message($msg);
//         $ci->email->send();
//         echo $this->email->print_debugger();exit;
// 		if(){
// 			return true;
// 		}else{
// 		    return false;
//         }


	}
    public function send_attach_mail($from,$name,$toEmail,$subject,$msg,$filename)
    {
        $config = array (
				 'protocol' => 'smtp',
                  'smtp_host' => 'smtp.sendgrid.net',
                  'smtp_user' => 'ravail123',
                  'smtp_pass' => 'ravail12345678',
                  'smtp_port' => 587,
                  'crlf' => "\r\n",
                  'newline' => "\r\n"
		 );

        $ci =& get_instance();
        $ci->load->library('email');
      	$ci->email->initialize($config);
		$ci->email->from('support@meddistant.com',$name);
		$ci->email->to($toEmail);//to address here
		$ci->email->subject($subject);
        $ci->email->message($msg);
        $ci->email->attach($filename);
		if($ci->email->send())
			return true;
		else
		    show_error($ci->email->print_debugger());



    }



	//============================================================================================



}
