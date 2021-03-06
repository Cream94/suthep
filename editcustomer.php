<?php
  require_once 'database/connector.php';
  $id = $_GET["id"];
  $sql = "SELECT * FROM customer WHERE cust_id = $id";
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
            <h4 style="font-weight: bold;">แก้ไขข้อมูลลูกค้า</h4> <br/>
            <form class="form-horizontal" action="action/customer_edit.php?id=<?php echo $id;?>" method="post">
            <div class="form-group">
            <label for="cust_name" class="col-sm-2 control-label">ชื่อลูกค้า</label>
            <div class="col-sm-10">
            <input type="id" class="form-control" id="prod_id" name="cust_name" value="<?php echo $row["cust_name"]; ?>" placeholder="ชื่อลูกค้า">
            </div>
            </div>
            <div class="form-group">
            <label for="cust_address" class="col-sm-2 control-label">ที่อยู่</label>
            <div class="col-sm-10">
            <input type="detail" class="form-control" id="prod_detail" name="cust_address" value="<?php echo $row["cust_address"]; ?>" placeholder="ที่อยู่">
            </div>
            </div>
            <div class="form-group">
            <label for="cust_tel" class="col-sm-2 control-label">เบอร์โทร</label>
            <div class="col-sm-10">
            <input type="number" class="form-control" id="price" name="cust_tel" value="<?php echo $row["cust_tel"]; ?>" placeholder="เบอร์โทร">
            </div>
            </div>
            <div class="form-group">
            <label for="cust_fax" class="col-sm-2 control-label">เบอร์แฟ๊กซ์</label>
            <div class="col-sm-10">
            <input type="number" class="form-control" id="weight" name="cust_fax" value="<?php echo $row["cust_fax"]; ?>" placeholder="เบอร์แฟ๊กซ์">
            </div>
            </div>
            <div class="form-group">
            <label for="email" class="col-sm-2 control-label">อีเมล์</label>
            <div class="col-sm-10">
            <input type="weight" class="form-control" id="weight" name="email" value="<?php echo $row["email"]; ?>" placeholder="E-mail">
            </div>
            </div>

        <input type="submit" name="Save" class="btn btn-success" value="บันทึก" >
        <a href="customer.php" class="btn btn-danger">ยกเลิก</a>

      </form>
      </center>

</body>
</html>
