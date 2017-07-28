<?php
  require_once 'database/connector.php';
  $id = $_GET["id"];
  $sql = "SELECT * FROM product WHERE prod_id = '$id'";
  $query = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($query);
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
            <form class="form-horizontal" action="action/product_edit.php?id=<?php echo $id;?>" method="post">
              <div class="form-group">
                <label for="pic" class="col-sm-2 control-label">รูปสินค้า</label>
                <input type="file" id="exampleInputFile" name="image">
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
            <input type="price" class="form-control" id="price" name="price" value="<?php echo $row["price"]; ?>" placeholder="ราคา">
            </div>
            </div>
            <div class="form-group">
            <label for="weight" class="col-sm-2 control-label">น้ำหนัก/กก.</label>
            <div class="col-sm-10">
            <input type="weight" class="form-control" id="weight" name="weight" value="<?php echo $row["weight"]; ?>" placeholder="น้ำหนัก">
            </div>
            </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="product.php" class="btn btn-danger">Cancel</a>

      </form>
      </center>

</body>
</html>
