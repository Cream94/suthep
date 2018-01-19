<?php
  require_once 'database/connector.php';

  $sql ="SELECT * FROM vat";
  $query = mysqli_query($conn, $sql);

  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
  <title>Suthep</title>
  <?php include 'header.php' ?>

</head>
<body>
  <?php include 'navbar.php' ?>
<center>
  <div class="row">
    <div class="col-md-6 col-md-offset-3 jumbotron well">
      <h4 style="font-weight: bold;" align="center">เพิ่มภาษีมูลค่าเพิ่ม</h4> <br/>
        <div class="form-group">
          <form class="form-horizontal" action="action/vat_add.php" method="post">
          <div class="form-group">
          <label for="mat_name" class="col-sm-3 control-label">ภาษีมูลค่าเพิ่ม (%)</label>
          <div class="col-sm-5">
          <input type="id" class="form-control" id="vat" name="vat" placeholder="ภาษีมูลค่าเพิ่ม" >
          </div>
          </div>

        <button type="submit" class="btn btn-success">บันทึก</button>
        <a href="vat.php" class="btn btn-danger">ยกเลิก</a>
        </div>
  </div>

</form>
</body>
</html>
