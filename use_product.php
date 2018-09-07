<?php
/**
 * Created by PhpStorm.
 * User: a-19-k
 * Date: 4/10/18
 * Time: 7:03 PM
 */
?>

<?php
  $page_title = 'Use Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php

  if(isset($_POST['use_product'])){

    $req_fields = array('s_id','quantity','date');
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$_POST['s_id']);
          $s_used_by = $db->escape((string)$_POST['used_by']);
          $s_qty     = $db->escape((int)$_POST['quantity']);
          $s_name     = $db->escape((string)$_POST['username']);
          $date      = $db->escape($_POST['date']);
          $s_date    = strftime("%Y-%m-%d", time());

          $sql  = "INSERT INTO sales(";
          $sql .= " product_id,username,used_by,qty,date";
          $sql .= ") VALUES (";
          $sql .= "'{$p_id}','{$s_name}','{$s_used_by}','{$s_qty}','{$s_date}' ";
          $sql .= ")";

                if($db->query($sql)){
                  update_product_qty($s_qty,$p_id);

                    $product_name= find_by_id('products',$p_id)['name'];
                    $email = find_email_by_username($s_used_by)['email'];


                    if(sendMail($email, $s_used_by, $product_name, $s_qty, $s_date)) {
                        $session->msg('s',"Product used and mail sent.");
                    } else {
                        $session->msg('s',"Product used but mail not sent.");
                    }

                    redirect('use_product.php', false);
                } else {
                  $session->msg('d',' Sorry failed to use!');
                  redirect('use_product.php', false);
                }

        } else {
           $session->msg("d", $errors);
           redirect('use_product.php',false);
        }


  }

   // sendForgetPasswordMail($email);

?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
     <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary">Find It</button>
            </span>
            <input type="text" id="sug_input" class="form-control" name="title"  placeholder="Search for product name">
         </div>
         <div id="result" class="list-group"></div>
        </div>
    </form>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Use Edit</span>
       </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="use_product.php">
         <table class="table table-bordered">
           <thead>
            <th> Item </th>
            <th>Total quantity left</th>
            <th> Used by</th>
            <th> Qty </th>
            <th> Date</th>
            <th> Action</th>

           </thead>
             <tbody  id="product_info"> </tbody>
             <?php $user = current_user(); ?>
             <input type="hidden" name="username" value="<?php echo $user['username']; ?>">
         </table>
       </form>
      </div>
    </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>
