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
    <form method="post" action="passwordController.php" class="clearfix">
        <div class="form-group">
            <label for="email" class="control-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email">
        </div>

        <div class="form-group" >
            <button type="submit" id="submit" name="submit" class="btn btn-info pull-left">Submit</button>

        </div>


        <div class="btn btn-info pull-right">
            <a  href="index.php" class="">Back</a>

        </div>

        <!--<div class="form-group">

          <button  a href="index.php" class="btn btn-info  pull-right">Back</button> </a>
        </div>-->
    </form>
</div>



<?php include_once('layouts/footer.php'); ?>