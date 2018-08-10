<?php
/**
 * Created by PhpStorm.
 * User: a-19-k
 * Date: 5/7/18
 * Time: 8:58 PM
 */
?>
<?php

require_once('includes/load.php');

?>

<?php include("layouts/header.php"); ?>




<div class="login-page">
    <div class="text-center">
        <h3> Enter</h3>
        <p>email to recover your password</p>
    </div>
    <?php echo display_msg($msg); ?>
    <form method="post" action="auth.php" class="clearfix">
        <div class="form-group">
            <label for="username" class="control-label">Username</label>
            <input type="name" class="form-control" name="username" placeholder="Username">
        </div>

        <div >
            <a  href="forgotPassword.php" class="btn btn-info pull-left">Forgot password</a>

        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-info  pull-right">Login</button>
        </div>
    </form>
</div>


<!--

<?php
if(isset($_POST['generatetoken'])) {
    $cstrong = True;
    $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
    $email = $_POST['email'];

    $sql = "SELECT id FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0) {
        $r = mysqli_fetch_assoc($result);
        $uId = $r['id'];

        $sqlI = "INSERT INTO password_token (token, user_id) VALUES ('$token', '$uId');";
        $resultR = mysqli_query($conn, $sqlI);

        $sqlR = "SELECT token FROM password_token WHERE user_id='$uId'";
        $resultR = mysqli_query($conn, $sqlR);

        $rR = mysqli_fetch_assoc($resultR);
        $ur = $rR['token']; ?>

        <div class="container" style="margin-top: 2%; margin-bottom: -10%;">
            <div class="container">
                <h4 class="display-5 text-center">Copy Token Below and Paste to Reset Your Password</h4>
                <p class="text-center"><?php echo "$ur"; ?></p>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4" style="padding-top: 3%; padding-bottom: 3%; background-color:#edeeef; margin-top:15%;">
                    <form action="forgot_password.php" method="post">
                        <div class="form-group">
                            <label for="InputToken">Token</label>
                            <input type="text" name="token" class="form-control" id="InputToken" aria-describedby="tokenHelp" required>
                        </div>
                        <div class="form-group">
                            <label for="InputNewPassword">New Password</label>
                            <input type="password" name="newpassword" class="form-control" id="InputNewPassword" aria-describedby="passwordHelp" required>
                        </div>
                        <div class="form-group">
                            <label for="InputNewPasswordRepeat">Repeat New Password</label>
                            <input type="password" name="newpasswordrepeat" class="form-control" id="InputNewPasswordRepeat" aria-describedby="newpasswordHelp" required>
                        </div><br><hr>
                        <div style="padding-top:2%;">
                            <button type="submit" name="resetpassword" class="btn btn-primary btn-block">Reset Password</button>
                        </div>
                    </form><br><hr>
                    <a class="nav-link" href="login.php">Back to Login</a>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>

        <?php

    } else {
        header("Location: forgot_password.php?EmailNotFound");
        exit();
    }
} elseif(isset($_POST['resetpassword'])) {
    $token = mysqli_real_escape_string($conn, $_POST['token']);
    $newpassword = mysqli_real_escape_string($conn, $_POST['newpassword']);
    $newpasswordrepeat = mysqli_real_escape_string($conn, $_POST['newpasswordrepeat']);

    if ($newpassword == $newpasswordrepeat) {
        $sql = "SELECT user_id FROM password_token WHERE token='$token'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck == 1) {
            $r = mysqli_fetch_assoc($result);
            $u_Id = $r['user_id'];

            $hashedPassword = password_hash($newpassword, PASSWORD_DEFAULT);
            $sqlR = "UPDATE users SET password = '$hashedPassword' WHERE id='$u_Id'";
            $resultR = mysqli_query($conn, $sqlR);

            $sqlR = "DELETE FROM users WHERE id='$u_Id' AND token='$token'";
            $resultR = mysqli_query($conn, $sqlR);

            header("Location: login.php?Reset=success");
            exit();
        } else {
            header("Location: forgot_password.php?TokenInvalid");
            exit();
        }
    } else {
        header("Location: forgot_password.php?PasswordDonotMatch");
        exit();
    }
} else { ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4" style="padding-top: 3%; padding-bottom: 3%; background-color:#edeeef; margin-top:15%;">
                <form action="forgot_password.php" method="post">
                    <div class="form-group">
                        <label for="InputEmial">Email</label>
                        <input type="email" name="email" class="form-control" id="InputEmial" aria-describedby="emailHelp" required>
                    </div><br><hr>
                    <div style="padding-top:2%;">
                        <button type="submit" name="generatetoken" class="btn btn-primary btn-block">Generate Token</button>
                    </div>
                </form><br><hr>
                <a class="nav-link" href="login.php">Back to Login</a>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div> <?php
}
?>
-->

<?php include_once('layouts/footer.php'); ?>