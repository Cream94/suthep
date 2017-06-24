<?php
  require_once 'database/connector.php';
  $sql = "SELECT * FROM supplier";
  $querysmaterial = mysqli_query($conn, $sql);
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
            <form class="form-horizontal" action="action/stock_add.php" method="post">
              <div class="form-group">
              <label for="sup_id" class="col-sm-2 control-label">ชื่อผู้ผลิต</label>
              <div class="col-sm-7">
                <select class="form-control" name="sup_id" >
                  <?php
                    while ($row = mysqli_fetch_array($querysmaterial)) {
                      echo '<option value="'.$row["sup_id"].'">'.$row["sup_name"].'</option>';
                    }

                   ?>
                </select>
              </div>
              </div>
            <div class="form-group">
            <label for="number" class="col-sm-2 control-label">จำนวน</label>
            <div class="col-sm-10">
            <input type="detail" class="form-control" id="number" name="number" placeholder="จำนวน">
            </div>
            </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="stock.php" class="btn btn-danger">Cancel</a>

      </form>
      </center>

</body>
</html>
