<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('admin.php', false);}
?>


<?php include_once('layouts/header.php'); ?>
<div class="login-page" style="background-color:powderblue">
    <div class="text-center">
    <!--   //<h1>Welcome</h1>-->
        <img src="libs/images/logo.png" alt="Deerwalk Siphal School" width="250" height="90">

       <p>Sign in to Sifal Inventory</p>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="auth.php" class="clearfix">
        <div class="form-group">
              <label for="username" class="control-label">Username</label>
              <input type="name" class="form-control" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="Password" class="control-label">Password</label>
            <input type="password" name= "password" class="form-control" placeholder="password">
        </div>

          <div class="">
              <a  href="forgotPassword.php" class="btn btn-info pull-left">Forgot password</a>

          </div>
        <div class="form-group">
                <button type="submit" class="btn btn-info  pull-right">Login</button>
        </div>
      </form>

</div>
<?php include_once('layouts/footer.php'); ?>
