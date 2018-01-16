<?php
  require_once 'database/connector.php';
  $sql = "SELECT * FROM product, material group by material.mat_name";
  $query = mysqli_query($conn, $sql);

  $sqlCustomer = "SELECT * FROM customer";
  $query2 = mysqli_query($conn, $sqlCustomer);

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
            <h4 style="font-weight: bold;">เพิ่มชิ้นงานต้นแบบ</h4> <br/>
            <form class="form-horizontal" action="action/product_add.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="pic" class="col-sm-2 control-label">รูปชิ้นงาน</label>
                <input type="file" id="exampleInputFile" name="image">
              </div>
            <div class="form-group">
            <label for="prod_id" class="col-sm-2 control-label">รหัสชิ้นงาน</label>
            <div class="col-sm-10">
            <input type="id" class="form-control" id="prod_id" name="prod_id" placeholder="รหัสสินค้า">
            </div>
            </div>
            <div class="form-group">
            <label for="prod_detail" class="col-sm-2 control-label">รายละเอียด</label>
            <div class="col-sm-10">
            <input type="detail" class="form-control" id="prod_detail" name="prod_detail" placeholder="รายละเอียดสินค้า">
            </div>
            </div>
            <div class="form-group">
            <label for="price" class="col-sm-2 control-label">ราคา/ชิ้น</label>
            <div class="col-sm-10">
            <input type="number" class="form-control" id="price" name="price" placeholder="ราคา">
            </div>
            </div>
            <div class="form-group">
            <label for="weight" class="col-sm-2 control-label">น้ำหนัก/กก.</label>
            <div class="col-sm-10">
            <input type="weight" class="form-control" id="weight" name="weight" placeholder="น้ำหนัก">
            </div>
            </div>
            <div class="form-group">
            <label for="material_id" class="col-sm-2 control-label">วัตถุดิบที่ใช้</label>
            <div class="col-sm-7">
              <select class="form-control" name="material_id" >
                <?php
                  while ($row = mysqli_fetch_array($query)) {
                    echo '<option value="'.$row["mat_id"].'">'.$row["mat_name"].'</option>';
                  }

                 ?>
              </select>
            </div>
            </div>
            <div class="form-group">
            <label for="material_number" class="col-sm-2 control-label">จำนวนที่ใข้</label>
            <div class="col-sm-7">
            <input type="material_number" class="form-control" id="material_number" name="material_number" placeholder="จำนวนที่ใข้">
            </div>
            </div>
            <div class="form-group">
            <label for="owner" class="col-sm-2 control-label">บริษัทลูกค้า</label>
            <div class="col-sm-7">
              <select class="form-control" name="owner" >
                <?php
                  while ($row = mysqli_fetch_array($query2)) {
                    echo '<option value="'.$row["cust_id"].'">'.$row["cust_name"].'</option>';
                  }

                 ?>
              </select>
            </div>
            </div>

        <button type="submit" class="btn btn-success">บันทึก</button>
        <a href="product.php" class="btn btn-danger">ยกเลิก</a>

      </form>
      </center>

</body>
</html>
