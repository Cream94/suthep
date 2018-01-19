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
      <form class="form-inline"  method="get" action="action/update_vat.php">
      <h4 style="font-weight: bold;" align="center">การตั่งค่าภาษีมูลค่าเพิ่ม</h4> <br/><br/>
        <div class="form-group">
          <a href="addvat.php" class="btn btn-info">เพิ่มภาษีมูลค่า</a>
        </div>
      <br/><br/><br/>
        <div class="form-group">
        <label for="id" class="col-sm-7 control-label">ภาษีมูลค่าเพิ่ม (%)</label>
        <div class="col-sm-5">
          <select class="form-control" name="id" >
            <?php
              while ($row = mysqli_fetch_array($query)) {
                echo '<option value="'.$row["id"].'">'.$row["vat"].'</option>';
              }

             ?>
          </select>
        </div>

    </div>
    <button type="submit" class="btn btn-success">บันทึก</button>
    </form>
  </div>




</body>
</html>
