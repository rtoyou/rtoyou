<?php
class EmailUtil {

	public static function sendVerificationMail($email,$link) {
		$message	=	file_get_contents('verification.html',true);
		$message	=	strtr( $message,array('{{verification_link}}'=> $link));
		return CMailer::phpMail($email, 'verification Mail', $message);
	}
	public static function sendForgotPasswordMail($name,$email,$link) {
		$message	=	file_get_contents('forgotpass.html',true);
		$fname = explode(" ",$name);
		$message	=	strtr( $message,array('{{name}}'=>$fname[0],'{{reset_passlink}}'=> $link));
		return CMailer::phpMail($email, 'Reset your Password', $message);
	}
    public static function sendContactEmail($email,$message,$name) {
       // $message	=	file_get_contents('forgotpass.html',true);
       // $message	=	strtr( $message,array('{resetpass_link}'=> $link));
        $message = "Name: ".$name."Email:".$email."\r\n"." Contact Message :".$message;
        $email1 = 'support@rtoyou.com';
        $email2 = 'ggprashant007@gmail.com';
        $email3 = 'inzyislam@gmail.com';

        CMailer::phpMail($email1, 'New Contact Message received', $message);
        CMailer::phpMail($email2, 'New Contact Message received', $message);
        CMailer::phpMail($email3, 'New Contact Message received', $message);
    }

}
