<?php
/**
 * Created by PhpStorm.
 * User: a-19-k
 * Date: 8/8/18
 * Time: 2:13 PM
 */


  require_once('../class/class.phpmailer.php');

if (isset($_POST["submit"])) {
    $name = $_POST['name'];

    $bodyContent = "hello ".$name;
    $mail = new PHPMailer;
    $mail->CharSet = "UTF-8";
    $mail->IsSMTP();                                //Sets Mailer to send message using SMTP
    $mail->Host = 'smtp.gmail.com';        //Sets the SMTP hosts of your Email hosting, this for Godaddy
    $mail->Port = '587';                                //Sets the default SMTP server port
    $mail->SMTPAuth = true;                            //Sets SMTP authentication. Utilizes the Username and Password variables
    $mail->Username = 'username@gmail.com';                    //Sets SMTP username
    $mail->Password = 'password';                    //Sets SMTP password
    $mail->SMTPSecure = 'tls';                            //Sets connection prefix. Options are "", "ssl" or "tls"
    $mail->From = "from@gmail.com";                    //Sets the From email address for the message
    $mail->FromName = 'From Name';                //Sets the From name of the message
    $mail->AddAddress("address@gmail.com", "Name");        //Adds a "To" address
    $mail->AddCC("cc@gmail.com ", "CC Name");    //Adds a "Cc" address
    $mail->AddCC("cc1@gmail.com", "CC1 Name");    //Adds a "Cc" address
    $mail->WordWrap = 50;                            //Sets word wrapping on the body of the message to a given number of characters
    $mail->Hostname = 'localhost.localdomain';       //to send unlimited emails from localhost
    $mail->IsHTML(true);                            //Sets message type to HTML if you want to send message with html tags
    $mail->Subject = "Subject";                //Sets the Subject of the message
    $mail->Body = $bodyContent;                //An HTML or plain text message body
    if ($mail->Send())                                //Send an Email. Return true on success or false on error
    {
        echo "<SCRIPT type='text/javascript'>
			alert('Contact Form Successfully Submitted!');
			window.location.replace('thanks.php');</SCRIPT>";
    } else {
        echo "<SCRIPT type='text/javascript'>
			alert('Your form could not be sent. Please try again later.');
            window.location.replace('thanks.php');</SCRIPT>";
//			header("Refresh:0");
    }
}
?>