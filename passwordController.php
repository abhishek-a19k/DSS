<?php

/**
 * Created by IntelliJ IDEA.
 * User: user
 * Date: 1/9/2018
 * Time: 1:36 PM
 */

include 'includes/functions.php';
include 'includes/sql.php';



if (isset($_POST["submit"])) {

    $date = make_date();
    $password = sha1(sha1($date));
    updatePassword($_POST['email'], $password);

    if(sendForgetPasswordMail($_POST['email'], sha1($date))){
        header("Location: index.php");
    } else{
        echo "Error";
    }
}


?>
