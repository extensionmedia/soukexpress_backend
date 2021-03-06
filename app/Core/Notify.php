<?php

require_once($_SESSION['CORE'].'Mail.php');

class Notify{
	// construct
	public function __construct($subject = null , $msg = null){
		
		$mail = new Mail;
		$values = [
					"to"		=>	"elmeftouhi@gmail.com",
					"message" 	=>	($msg == null)? "null": $msg,
					"subject" 	=>	($subject == null)? "null": $subject
		];
		
		return $mail->send($values);
	}
	
}