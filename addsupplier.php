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
            <form class="form-horizontal" action="action/supplier_add.php" method="post">
            <div class="form-group">
            <label for="sup_name" class="col-sm-2 control-label">ชื่อผู้ผลิต</label>
            <div class="col-sm-10">
            <input type="id" class="form-control" id="sup_name" name="sup_name" placeholder="ชื่อผู้ผลิต">
            </div>
            </div>
            <div class="form-group">
            <label for="sup_address" class="col-sm-2 control-label">ที่อยู่</label>
            <div class="col-sm-10">
            <input type="detail" class="form-control" id="sup_address" name="sup_address" placeholder="ที่อยู่">
            </div>
            </div>
            <div class="form-group">
            <label for="sup_tel" class="col-sm-2 control-label">เบอร์โทร</label>
            <div class="col-sm-10">
            <input type="number" class="form-control" id="sup_tel" name="sup_tel" placeholder="เบอร์โทร">
            </div>
            </div>
            <div class="form-group">
            <label for="sup_fax" class="col-sm-2 control-label">เบอร์แฟ๊กซ์</label>
            <div class="col-sm-10">
            <input type="number" class="form-control" id="sup_fax" name="sup_fax" placeholder="เบอร์แฟ๊กซ์">
            </div>
            </div>
            <div class="form-group">
            <label for="email" class="col-sm-2 control-label">อีเมล์</label>
            <div class="col-sm-10">
            <input type="weight" class="form-control" id="weight" name="email" placeholder="E-mail">
            </div>
            </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="supplier.php" class="btn btn-danger">Cancel</a>

      </form>
      </center>

</body>
</html>
