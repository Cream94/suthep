<?php
  require_once 'database/connector.php';
  $sql = "SELECT * FROM supplier";
  $querysupplier = mysqli_query($conn, $sql);

?>

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
            <label for="unit" class="col-sm-2 control-label">หน่วยนับ</label>
            <div class="col-sm-10">
            <input type="unit" class="form-control" id="unit" name="unit" placeholder="หน่วยนับ">
            </div>
            </div>
            <div class="form-group">
            <label for="price" class="col-sm-2 control-label">ราคาวัตถุดิบ</label>
            <div class="col-sm-10">
            <input type="id" class="form-control" id="price" name="price" placeholder="ราคาวัตถุดิบ">
            </div>
            </div>
            <div class="form-group">
            <label for="sup_id" class="col-sm-2 control-label">บริษัทผู้ผลิต</label>
            <div class="col-sm-7">
              <select class="form-control" name="sup_id" >
                <?php
                  while ($row = mysqli_fetch_array($querysupplier)) {
                    echo '<option value="'.$row["sup_id"].'">'.$row["sup_name"].'</option>';
                  }

                 ?>
              </select>
            </div>
            </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="material.php" class="btn btn-danger">Cancel</a>

      </form>
      </center>

</body>
</html>
