<?php
   define('CC_FB_SENDMAIL_EOL',"\r\n");
   define('CC_FB_TO_EMAIL', 'eduardoesquer@playauvas.com');
   //define('CC_FB_TO_EMAIL', 'lucks17@gmail.com');
   define('CC_FB_RESULTS_REDIRECT', 'http://www.playauvas.com/contact-thanks.html');
   define('CC_FB_FAIL_REDIRECT',  'http://www.playauvas.com/contact.html');
   
$name       = $_POST['name'];
$email	    = $_POST['email'];

if(!isset($_POST["phone"]) ||($_POST["phone"]==''))
{
	$phone ='.';
}
else
{
	$phone      = $_POST['phone'];
}

if(!isset($_POST["country"]) ||($_POST["country"]==''))
{
	$country ='.';
}
else
{
	$country    = $_POST['country'];
}

if(!isset($_POST["reference"]) ||($_POST["reference"]==''))
{
	$reference ='.';
}
else
{
	$reference  = $_POST['reference'];
}

if(!isset($_POST["interest"]) ||($_POST["interest"]==''))
{
	$interest ='.';
}
else
{
	$interest  = $_POST['interest'];
}


$message    = $_POST['message'];

$titulo = "Contacto";
$to = CC_FB_TO_EMAIL;
$subject = $titulo;
//Main body
$msg = "Name: $name\n\n";
$msg .= "E-mail: $email\n\n";
$msg .= "Phone: $phone\n\n";
$msg .= "Country: $country\n\n";
$msg .= "How do you hear about Us : $reference\n\n";
$msg .= "Interested In: $interest\n\n";
$msg .= "Message:$message\n\n"; 

  
$headers = 'Reply-To: '.$email.CC_FB_SENDMAIL_EOL.'Return-Path: '.$email.CC_FB_SENDMAIL_EOL.'MIME-Version: 1.0'.CC_FB_SENDMAIL_EOL.' Content-Type: text/plain; charset=utf-8'.CC_FB_SENDMAIL_EOL.'Content-Transfer-Encoding: 7bit'.CC_FB_SENDMAIL_EOL; 
 $mail_sent = mail($to, $subject, $msg,$headers."FROM: Contacto <contacto@playauvas.com>\n");

	if($mail_sent)
	{

		

			header('Location: ' . CC_FB_RESULTS_REDIRECT);


	}else {
		header('Location: ' . CC_FB_FAIL_REDIRECT);
	}
	exit;

 
?>