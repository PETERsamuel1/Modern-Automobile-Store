<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
	/**
	* 
	*/
	class Email
	{
		
		function __construct()
		{
			include_once("../database/db.php");

			$db = new Database();
			$this->con = $db->connect();

			/*$response = array( 
		    'status' => 0, 
		    'message' => 'Form submission failed, please try again.' 
			);*/
		}

		public function sendMail($useremail,$subject,$message){

			require '../mail/autoload.php';

			$mail = new PHPMailer(true);                             
		    try {
		        //Server settings
		        $mail->isSMTP();                                     
		        $mail->Host = 'smtp.gmail.com';                      
		        $mail->SMTPAuth = true;                               
		        $mail->Username = 'petersamuelsam6@gmail.com';     
		        $mail->Password = '0703861887';                    
		        $mail->SMTPOptions = array(
		            'ssl' => array(
		            'verify_peer' => false,
		            'verify_peer_name' => false,
		            'allow_self_signed' => true
		            )
		        );                         
		        $mail->SMTPSecure = 'ssl';                           
		        $mail->Port = 465;                                   

		        $mail->setFrom($useremail);
		        
		        //Recipients
		        $mail->addAddress('petersamuelsam6@gmail.com');
		        //$mail->addAddress($useremail);               
		        $mail->addReplyTo($useremail);
		       
		        //Content
		        $mail->isHTML(true);                                  
		        $mail->Subject = $subject;
		        $mail->Body    = $message;

		        $mail->send();

		        //$response['status'] = 1; 
	            //$response['message'] = 'Message was sent successfully';
	            return ["status"=>1,"message"=>"Message was sent successfully."];
		     
		    } 
		    catch (Exception $e) {
		        $error = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;

		        //$response['message'] = 'An Error occured while sending your message';
		        return ["status"=>0,"message"=>"An Error occured while sending your message.".$mail->ErrorInfo];
		    }
		}

	}

?>