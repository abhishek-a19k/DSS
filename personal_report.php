<?php
$page_title = 'Personal Report';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);

$all_users = find_all('users');
//$all_used_by= find_used_by('sales');
$all_products=find_all('products');
?>


<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-md-6">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="panel">

            <div class="panel-body">
                <form class="clearfix" method="post" action="personal_report_process.php">
                 <div class="input-group">
                <select class="form-control" name="username">
                    <option value="">Select user</option>
                    <?php  foreach ($all_users as $user): ?>
                        <option value="<?php echo $user['username'] ?>">
                            <?php echo $user['username'] ?></option>
                    <?php endforeach; ?>
                </select>


                </div>
                    <br>
<!--                    <div class="input-group">-->
<!--                        <select class="form-control" name="username">-->
<!--                            <option value="">Select user</option>-->
<!--                            --><?php // foreach ($all_used_by as $user): ?>
<!--                                <option value="--><?php //echo $user['username'] ?><!--">-->
<!--                                    --><?php //echo $user['username'] ?><!--</option>-->
<!--                            --><?php //endforeach; ?>
<!--                        </select>-->
<!--                    </div>-->

                    <div class="form-group">
                        <button type="submit" name="generate_report" class="btn btn-primary">Generate Report</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>
<?php include_once('layouts/footer.php'); ?>



</div>