<!DOCTYPE html>
<html lang="en">
<head>
<title>Suthep</title>
<?php include 'header.php' ?>
</head>
<body>
  <?php include 'navbar.php' ?>
    <div class="container-fluid">

      <center>

        <div class="row">
          <div class="col-md-6 col-md-offset-3 jumbotron well">
            <h4 style="font-weight: bold;">Add Form</h4> <br/>
            <form class="form-horizontal" action="action/customer_add.php" method="post">
            <div class="form-group">
            <label for="cust_name" class="col-sm-2 control-label">ชื่อลูกค้า</label>
            <div class="col-sm-10">
            <input type="id" class="form-control" id="prod_id" name="cust_name" placeholder="ชื่อลูกค้า">
            </div>
            </div>
            <div class="form-group">
            <label for="cust_address" class="col-sm-2 control-label">ที่อยู่</label>
            <div class="col-sm-10">
            <input type="detail" class="form-control" id="prod_detail" name="cust_address" placeholder="ที่อยู่">
            </div>
            </div>
            <div class="form-group">
            <label for="cust_tel" class="col-sm-2 control-label">เบอร์โทร</label>
            <div class="col-sm-10">
            <input type="number" class="form-control" id="price" name="cust_tel" placeholder="เบอร์โทร">
            </div>
            </div>
            <div class="form-group">
            <label for="cust_fax" class="col-sm-2 control-label">เบอร์แฟ๊กซ์</label>
            <div class="col-sm-10">
            <input type="number" class="form-control" id="weight" name="cust_fax" placeholder="เบอร์แฟ๊กซ์">
            </div>
            </div>
            <div class="form-group">
            <label for="email" class="col-sm-2 control-label">อีเมล์</label>
            <div class="col-sm-10">
            <input type="weight" class="form-control" id="weight" name="email" placeholder="E-mail">
            </div>
            </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="customer.php" class="btn btn-danger">Cancel</a>

      </form>
      </center>

</body>
</html>
