<?php
  require_once 'database/connector.php';
  $id = $_GET["id"];
  $sql = "SELECT *, product.price as prod_price FROM product, material WHERE prod_id = '$id' group by product.prod_id";
  $query = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($query);

  $sqlMat = "SELECT * FROM material";
  $queryMat = mysqli_query($conn, $sqlMat);


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
            <form class="form-horizontal" action="action/product_edit.php?id=<?php echo $id;?>" method="post"  enctype="multipart/form-data">
              <div class="form-group">
                <label for="pic" class="col-sm-2 control-label">รูปสินค้า</label>
                <input type="file" id="exampleInputFile" name="image" accept="image/jpeg">
                <label style="color: red">* .jpg เท่านั้น</label>
              </div>
            <div class="form-group">
            <label for="prod_id" class="col-sm-2 control-label">รหัสสินค้า</label>
            <div class="col-sm-10">
            <input type="id" class="form-control" id="prod_id" name="prod_id" value="<?php echo $row["prod_id"]; ?>" placeholder="รหัสสินค้า">
            </div>
            </div>
            <div class="form-group">
            <label for="prod_detail" class="col-sm-2 control-label">รายละเอียด</label>
            <div class="col-sm-10">
            <input type="detail" class="form-control" id="prod_detail" name="prod_detail" value="<?php echo $row["prod_detail"]; ?>" placeholder="รายละเอียด">
            </div>
            </div>
            <div class="form-group">
            <label for="price" class="col-sm-2 control-label">ราคา/ชิ้น</label>
            <div class="col-sm-10">
            <input type="number" class="form-control" id="price" name="price" value="<?php echo $row["prod_price"]; ?>" placeholder="ราคา">
            </div>
            </div>
            <div class="form-group">
            <label for="weight" class="col-sm-2 control-label">น้ำหนัก/กก.</label>
            <div class="col-sm-10">
            <input type="weight" class="form-control" id="weight" name="weight" value="<?php echo $row["weight"]; ?>" placeholder="น้ำหนัก">
            </div>
            </div>
            <div class="form-group">
            <label for="material_id" class="col-sm-2 control-label">วัตถุดิบที่ใช้</label>
            <div class="col-sm-7">
              <select class="form-control" name="material_id" >
                <?php
                  while ($row1 = mysqli_fetch_array($queryMat)) {
                    echo '<option value="'.$row1["mat_id"].'">'.$row1["mat_name"].'</option>';
                  }

                 ?>
              </select>
            </div>
            </div>
            <div class="form-group">
            <label for="material_number" class="col-sm-2 control-label">จำนวนที่ใข้</label>
            <div class="col-sm-7">
            <input type="material_number" class="form-control" id="material_number" name="material_number" value="<?php echo $row["material_number"]; ?>" placeholder="จำนวนที่ใข้">
            </div>
            </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="product.php" class="btn btn-danger">Cancel</a>

      </form>
      </center>

</body>
</html>
