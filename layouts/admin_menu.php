
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<ul>
  <li>
    <a href="admin.php">
      <i class="glyphicon glyphicon-home"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-user"></i>
      <span>User Management</span>
    </a>
    <ul class="nav submenu">
      <li><a href="group.php">Manage Groups</a> </li>
      <li><a href="users.php">Manage Users</a> </li>
   </ul>
  </li>
  <li>
    <a href="categorie.php" >
      <i class="glyphicon glyphicon-indent-left"></i>
      <span>Categories</span>
    </a>
  </li>
  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-large"></i>
      <span>Products</span>
    </a>
    <ul class="nav submenu">
       <li><a href="product.php">Manage products</a> </li>
       <li><a href="add_product.php">Add product</a> </li>
   </ul>
  </li>

    <li>
        <a href=" sales.php" class="submenu-toggle">
            <i class="glyphicon glyphicon-th-list"></i>
            <span>History</span>
        </a>

    </li>

    <li>
        <a href="#" class="submenu-toggle">
            <i class="glyphicon glyphicon-signal"></i>
            <span>Use Report</span>
        </a>
        <ul class="nav submenu">
            <li><a href="sales_report.php">Use by dates </a></li>
            <li><a href="personal_report.php">Personal Report </a></li>
            <li><a href="product_report.php">Product Report </a></li>
            <li><a href="monthly_sales.php">Monthly uses</a></li>
            <li><a href="daily_sales.php">Daily uses</a> </li>
        </ul>
    </li>


<!--
    <ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-bell" style="font-size:18px;"></span></a>
        <ul class="dropdown-menu notify-icons"></ul>
    </li>

-->





        <ul class="dropdown-menu"></ul>

        </li>
    </ul>

</ul>




<script>

    $(document).ready(function(){

// updating the view with notifications using ajax

        function load_unseen_notification(view = '')

        {

            $.ajax({

                url:"notification/fetch.php",
                method:"POST",
                data:{view:view},
                dataType:"json",
                success:function(data)

                {

                    $('.notify-icons').html(data.notification);

                    if(data.unseen_notification > 0)
                    {
                        $('.count').html(data.unseen_notification);
                    }

                }

            });

        }

        load_unseen_notification();

// submit form and get new records

        $('#comment_form').on('submit', function(event){
            event.preventDefault();

            if($('#subject').val() != '' && $('#comment').val() != '')

            {

                var form_data = $(this).serialize();

                $.ajax({

                    url:"notification/insert.php",
                    method:"POST",
                    data:form_data,
                    success:function(data)

                    {

                        $('#comment_form')[0].reset();
                        load_unseen_notification();

                    }

                });

            }

            else

            {
                alert("Both Fields are Required");
            }

        });

// load new notifications

        $(document).on('click', '.dropdown-toggle', function(){

            $('.count').html('');

            load_unseen_notification('yes');

        });

        setInterval(function(){

            load_unseen_notification();;

        }, 5000);

    });

</script>




