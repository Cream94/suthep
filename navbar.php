<?php
session_start();
if (!isset($_SESSION["login_id"])) {
    echo "<script> location.href='index.php'; </script>";
    exit;
}

 ?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
        <img alt="Brand" src="">
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> User Management <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php
              if ($_SESSION["login_super_admin"] == 1) {
                echo '<li><a href="admin.php">Super Admin</a></li>';
              }
            ?>
            <li><a href="user.php">User</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Assets Management <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="product.php">Product</a></li>
            <li><a href="customer.php">Customer</a></li>
            <li><a href="supplier.php">Supplier</a></li>
            <li><a href="material.php">Material</a></li>
            <li><a href="stock.php">Stock</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PO & SO <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="purchase_order.php">Purchase Order</a></li>
            <li><a href="sale_order.php">Sale Order</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="account.php">Account</a></li>
          </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Logout <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php">logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
