<?php
  require_once 'database/connector.php';
  $id = $_GET["id"];
  $sql = "SELECT * FROM material WHERE mat_id = $id";
  $query = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($query);

  $sql2 = "SELECT * FROM supplier";
  $query2 = mysqli_query($conn, $sql2);
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
            <h4 style="font-weight: bold;">Edit Form</h4> <br/>
            <form class="form-horizontal" action="action/material_edit.php?id=<?php echo $id;?>" method="post">
            <div class="form-group">
            <label for="mat_name" class="col-sm-2 control-label">ชื่อวัตถุดิบ</label>
            <div class="col-sm-10">
            <input type="id" class="form-control" id="mat_name" name="mat_name" value="<?php echo $row["mat_name"]; ?>" placeholder="ชื่อวัตถุดิบ">
            </div>
            </div>
            <div class="form-group">
            <label for="price" class="col-sm-2 control-label">ราคาวัตถุดิบ</label>
            <div class="col-sm-10">
            <input type="id" class="form-control" id="price" name="price" value="<?php echo $row["price"]; ?>" placeholder="ราคาวัตถุดิบ">
            </div>
            </div>
            <div class="form-group">
            <label for="sup_id" class="col-sm-2 control-label">รหัสผู้ผลิต</label>
            <div class="col-sm-7">
              <select class="form-control" name="sup_id" >
                <?php
                  while ($row2 = mysqli_fetch_array($query2)) {
                    echo '<option value="'.$row2["sup_id"].'">'.$row2["sup_name"].'</option>';
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
