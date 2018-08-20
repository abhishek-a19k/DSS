<?php
 $errors = array();

 /*--------------------------------------------------------------*/
 /* Function for Remove escapes special
 /* characters in a string for use in an SQL statement
 /*--------------------------------------------------------------*/
function real_escape($str){
  global $con;
  $escape = mysqli_real_escape_string($con,$str);
  return $escape;
}
/*--------------------------------------------------------------*/
/* Function for Remove html characters
/*--------------------------------------------------------------*/
function remove_junk($str){
  $str = nl2br($str);
  $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
  return $str;
}
/*--------------------------------------------------------------*/
/* Function to get quantity and compare in instock
/*--------------------------------------------------------------*/


function get_count($str){
    $str = nl2br($str);
    $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
    return $str;
}


/*--------------------------------------------------------------*/
/* Function for Uppercase first character
/*--------------------------------------------------------------*/
function first_character($str){
  $val = str_replace('-'," ",$str);
  $val = ucfirst($val);
  return $val;
}
/*--------------------------------------------------------------*/
/* Function for Checking input fields not empty
/*--------------------------------------------------------------*/
function validate_fields($var){
  global $errors;
  foreach ($var as $field) {
    $val = remove_junk($_POST[$field]);
    if(isset($val) && $val==''){
      $errors = $field ." can't be blank.";
      return $errors;
    }
  }
}
/*--------------------------------------------------------------*/
/* Function for Display Session Message
   Ex echo displayt_msg($message);
/*--------------------------------------------------------------*/
function display_msg($msg =''){
   $output = array();
   if(!empty($msg)) {
      foreach ($msg as $key => $value) {
         $output  = "<div class=\"alert alert-{$key}\">";
         $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
         $output .= remove_junk(first_character($value));
         $output .= "</div>";
      }
      return $output;
   } else {
     return "" ;
   }
}
/*--------------------------------------------------------------*/
/* Function for redirect
/*--------------------------------------------------------------*/
function redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
      header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}
/*--------------------------------------------------------------*/
/* Function for find out total saleing price, buying price and profit
/*--------------------------------------------------------------*/
function total_price($totals){
   $sum = 0;
   $sub = 0;
   foreach($totals as $total ){
     $sum += $total['total_saleing_price'];
     $sub += $total['total_buying_price'];
     $profit = $sum - $sub;
   }
   return array($sum,$profit);
}
/*--------------------------------------------------------------*/
/* Function for Readable date time
/*--------------------------------------------------------------*/
function read_date($str){
     if($str)
      return date('F j, Y, g:i:s a', strtotime($str));
     else
      return null;
  }
/*--------------------------------------------------------------*/
/* Function for  Readable Make date time
/*--------------------------------------------------------------*/
function make_date(){
  return strftime("%Y-%m-%d %H:%M:%S", time());
}
/*--------------------------------------------------------------*/
/* Function for  Readable date time
/*--------------------------------------------------------------*/
function count_id(){
  static $count = 1;
  return $count++;
}
/*--------------------------------------------------------------*/
/* Function for Creating random string
/*--------------------------------------------------------------*/
function randString($length = 5)
{
  $str='';
  $cha = "0123456789abcdefghijklmnopqrstuvwxyz";

  for($x=0; $x<$length; $x++)
   $str .= $cha[mt_rand(0,strlen($cha))];
  return $str;
}



?>




<?php

require_once("libs/phpmailer/class.phpmailer.php");
require_once("libs/phpmailer/class.smtp.php");
require ("libs/phpmailer/PHPMailerAutoload.php");

function sendForgetPasswordMail($email, $password){


    $mailer = new PHPMailer();
    $mailer->IsSMTP();
    $mailer->SMTPSecure = 'tls';
    $mailer->Host = 'smtp.gmail.com';
    $mailer->SMPTDebug = 2;
    $mailer->Port = 587;
    $mailer->Username = 'abhishek.kadariya@deerwalk.edu.np';
    $mailer->Password = 'thedoctor';
    $mailer->SMTPAuth = true;
    $mailer->From = 'abhishek.kadariya@deerwalk.edu.np';
    $mailer->FromName = "DSS Inventory Admin";
    $mailer->Subject = 'Your password has been changed';
    $mailer->isHTML(true);
    $mailer->Body =
        '<p> Your You new password is <b>'. $password .' </b. </p>'.
        '<p>Best Regards,<br> DSS Inventory Admin</p>';
    $mailer->AddReplyTo( 'abhishek.kadariya@deerwalk.edu.np', 'DSS Inventory Admin' );
    $mailer->AddAddress($email);

    $mailer->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    if($mailer->Send()){
        return 1;
    } else {
        return 0;
    }
}


    /*--------------------------------------------------------------*/
    /* Function for sending email notification for user about their usage
    /*--------------------------------------------------------------*/



function sendMail($email, $s_used_by , $product_name, $s_qty, $date ){


    $mailer = new PHPMailer();
    $mailer->IsSMTP();
    $mailer->SMTPSecure = 'tls';
    $mailer->Host = 'smtp.gmail.com';
    $mailer->SMPTDebug = 2;
    $mailer->Port = 587;
    $mailer->Username = 'abhishek.kadariya@deerwalk.edu.np';
    $mailer->Password = 'thedoctor';
    $mailer->SMTPAuth = true;
    $mailer->From = 'abhishek.kadariya@deerwalk.edu.np';
    $mailer->FromName = "DSS Inventory Admin";
    $mailer->Subject = 'Used Item';
    $mailer->isHTML(true);
    $mailer->Body =
        '<p> Hello ' . $s_used_by .',</br>'.
        'You have used '. $s_qty . ' ' . $product_name . ' as on '. $date . '. <br></p>'.
        '<p>Best Regards,<br> DSS Inventory Admin</p>';
    $mailer->AddReplyTo( 'abhishek.kadariya@deerwalk.edu.np', 'DSS Inventory Admin' );
    $mailer->AddAddress($email);

    $mailer->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    if($mailer->Send()){
        return 1;
    } else {
        return 0;
    }
}


?>