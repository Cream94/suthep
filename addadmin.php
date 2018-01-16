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
            <h4 style="font-weight: bold;">เพิ่มผู้ดูแล</h4> <br/>
            <form class="form-horizontal" action="action/admin_add.php" method="post">
            <div class="form-group">
            <label for="admin_name" class="col-sm-2 control-label">ชื่อผู้ดูแล</label>
            <div class="col-sm-10">
            <input type="id" class="form-control" id="admin_name" name="admin_name" placeholder="ชื่อผู้ดูแล">
            </div>
            </div>
            <div class="form-group">
            <label for="admin_address" class="col-sm-2 control-label">ที่อยู่</label>
            <div class="col-sm-10">
            <input type="detail" class="form-control" id="admin_address" name="admin_address" placeholder="ที่อยู่">
            </div>
            </div>
            <div class="form-group">
            <label for="admin_tel" class="col-sm-2 control-label">เบอร์โทร</label>
            <div class="col-sm-10">
            <input type="number" class="form-control" id="admin_tel" name="admin_tel" placeholder="เบอร์โทร">
            </div>
            </div>
            <div class="form-group">
            <label for="admin_fax" class="col-sm-2 control-label">เบอร์แฟ๊กซ์</label>
            <div class="col-sm-10">
            <input type="number" class="form-control" id="admin_fax" name="admin_fax" placeholder="เบอร์แฟ๊กซ์">
            </div>
            </div>
            <div class="form-group">
            <label for="email" class="col-sm-2 control-label">อีเมล์</label>
            <div class="col-sm-10">
            <input type="weight" class="form-control" id="weight" name="email" placeholder="E-mail">
            </div>
            </div>
            <div class="form-group">
            <label for="super_admin" class="col-sm-2 control-label">ผู้ดูแล</label>
            <div class="col-sm-10" align="left">
            <label class="radio-inline">
              <input type="radio" name="super_admin" id="inlineRadio1" value="1"> Yes
            </label>
            <label class="radio-inline">
              <input type="radio" name="super_admin" id="inlineRadio2" value="0" checked> No
            </label>
          </div>
          </div>

        <button type="submit" class="btn btn-success">บันทึก</button>
        <a href="admin.php" class="btn btn-danger">ยกเลิก</a>

      </form>
      </center>

</body>
</html>
