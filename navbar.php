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
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> การจัดการผู้ใช้งาน <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php
              if ($_SESSION["login_super_admin"] == 1) {
                echo '<li><a href="admin.php">ผู้ดูแล</a></li>';
              }
            ?>
            <li><a href="user.php">พนักงาน</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> การจัดการข้อมูล <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="product.php">ชิ้นงานต้นแบบ</a></li>
            <li><a href="customer.php">ลูกค้า</a></li>
            <li><a href="supplier.php">ตัวแทนจำหน่าย</a></li>
            <li><a href="material.php">วัตถุดิบ</a></li>
            <li><a href="stock.php">คลังวัตถุดิบ</a></li>
            <li><a href="vat.php">การตั่งค่าภาษี</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">สั่งซื้อ & สั่งผลิต <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="purchase_order.php">สั่งซื้อวัตถุดิบ</a></li>
            <li><a href="sale_order.php">สั่งผลิตงาน</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="account.php">บัญชี</a></li>
          </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ออกจากระบบ <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php">ออกจากระบบ</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
