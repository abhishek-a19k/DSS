<?php
/**
 * Created by PhpStorm.
 * User: a-19-k
 * Date: 4/7/18
 * Time: 9:15 PM
 */



  $page_title = 'All Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
  $products = join_product_table();
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-md-12">
        <?php echo display_msg($msg); ?>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <div class="pull-right">
                    <a href="use_product.php" class="btn btn-primary">Use Item</a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>

                        <th> Product Title </th>
                        <th class="text-center" style="width: 10%;"> Categorie </th>
                        <th class="text-center" style="width: 10%;"> Instock </th>
                        <th class="text-center" style="width: 10%;"> Product Added </th>
                        <!--<th class="text-center" style="width: 100px;"> Actions </th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $product):?>
                        <tr>
                            <td class="text-center"><?php echo count_id();?></td>

                            <td> <?php echo remove_junk($product['name']); ?></td>
                            <td class="text-center"> <?php echo  remove_junk($product['categorie']); ?></td>
                            <td class="text-center"> <?php echo remove_junk($product['quantity']); ?></td>
                            <td class="text-center"> <?php echo read_date($product['date']); ?></td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>
