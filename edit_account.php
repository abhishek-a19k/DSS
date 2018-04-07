<?php
  $page_title = 'Edit Account';
  require_once('includes/load.php');
   page_require_level(3);
?>

<?php
 //update user other info
  if(isset($_POST['update'])){
    $req_fields = array('name','username' );
    validate_fields($req_fields);
    if(empty($errors)){
             $id = (int)$_SESSION['user_id'];
           $name = remove_junk($db->escape($_POST['name']));
       $username = remove_junk($db->escape($_POST['username']));
            $sql = "UPDATE users SET name ='{$name}', username ='{$username}' WHERE id='{$id}'";
    $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Acount updated ");
            redirect('edit_account.php', false);
          } else {
            $session->msg('d',' Sorry failed to updated!');
            redirect('edit_account.php', false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('edit_account.php',false);
    }
  }
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>

  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <span class="glyphicon glyphicon-edit"></span>
        <span>Edit My Account</span>
      </div>
      <div class="panel-body">
          <form method="post" action="edit_account.php?id=<?php echo (int)$user['id'];?>" class="clearfix">
            <div class="form-group">
                  <label for="name" class="control-label">Name</label>
                  <input type="name" class="form-control" name="name" value="<?php echo remove_junk(ucwords($user['name'])); ?>">
            </div>
            <div class="form-group">
                  <label for="username" class="control-label">Username</label>
                  <input type="text" class="form-control" name="username" value="<?php echo remove_junk(ucwords($user['username'])); ?>">
            </div>
            <div class="form-group clearfix">
                    <a href="change_password.php" title="change password" class="btn btn-danger pull-right">Change Password</a>
                    <button type="submit" name="update" class="btn btn-info">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>


<?php include_once('layouts/footer.php'); ?>
