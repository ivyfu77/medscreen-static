<?php
header('Content-Type: application/json');
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'PHPMailerAutoload.php';

//Get data send by ajax
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
//$mail->Host = 'smtp.gmail.com';
// use
$mail->Host = gethostbyname('ssl://mx1.sitehost.co.nz');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 465;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'ssl';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "webmaster@medscreen.co.nz";

//Password to use for SMTP authentication
$mail->Password = "XwWy2e4x8N";

//Set who the message is to be sent from
$mail->setFrom("webmaster@medscreen.co.nz", "medscreen.co.nz");

//Set an alternative reply-to address
$mail->addReplyTo($email, $name);

//Set who the message is to be sent to
$mail->addAddress('admin@medscreen.co.nz', 'Admin'); 

//Set the subject line
$mail->Subject = 'Message From MedScreen.co.nz';

//convert HTML into a basic plain-text alternative body
$mail->msgHTML('<h4>Name: </h4>'.$name.'<br>'.'<h4>Email: </h4>'.$email.'<br>'.'<h4>Message: </h4>'.$message);

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';


//send the message, check for errors
if (!$mail->send()) { 
	$result = array('status'=>"error", 'message'=>"Mailer Error: ".$mail->ErrorInfo);//
	echo json_encode($result);
} else {
	$result = array('status'=>"success", 'message'=>"Message sent.");
	echo json_encode($result);
}
