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
            <form class="form-horizontal" action="action/material_add.php" method="post">
            <div class="form-group">
            <label for="mat_name" class="col-sm-2 control-label">ชื่อวัตถุดิบ</label>
            <div class="col-sm-10">
            <input type="id" class="form-control" id="mat_name" name="mat_name" placeholder="ชื่อวัตถุดิบ">
            </div>
            </div>
            <div class="form-group">
            <label for="sup_id" class="col-sm-2 control-label">รหัสผู้ผลิต</label>
            <div class="col-sm-10">
            <input type="detail" class="form-control" id="sup_id" name="sup_id" placeholder="รหัสผู้ผลิต">
            </div>
            </div>


        <button type="submit" class="btn btn-success">Save</button>
        <a href="material.php" class="btn btn-danger">Cancel</a>

      </form>
      </center>

</body>
</html>
