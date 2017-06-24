<?php
  require_once 'database/connector.php';
  $id = $_GET["id"];
  $sql = "SELECT * FROM admin WHERE admin_id = $id";
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
            <form class="form-horizontal" action="action/user_edit.php?id=<?php echo $id;?>" method="post">
            <div class="form-group">
            <label for="admin_name" class="col-sm-2 control-label">ชื่อผู้ดูแล</label>
            <div class="col-sm-10">
            <input type="id" class="form-control" id="admin_name" name="admin_name" value="<?php echo $row["admin_name"]; ?>" placeholder="ชื่อผู้ดูแล">
            </div>
            </div>
            <div class="form-group">
            <label for="admin_address" class="col-sm-2 control-label">ที่อยู่</label>
            <div class="col-sm-10">
            <input type="detail" class="form-control" id="admin_address" name="admin_address" value="<?php echo $row["admin_address"]; ?>" placeholder="ที่อยู่">
            </div>
            </div>
            <div class="form-group">
            <label for="admin_tel" class="col-sm-2 control-label">เบอร์โทร</label>
            <div class="col-sm-10">
            <input type="price" class="form-control" id="admin_tel" name="admin_tel" value="<?php echo $row["admin_tel"]; ?>" placeholder="เบอร์โทร">
            </div>
            </div>
            <div class="form-group">
            <label for="admin_fax" class="col-sm-2 control-label">เบอร์แฟ๊กซ์</label>
            <div class="col-sm-10">
            <input type="weight" class="form-control" id="admin_fax" name="admin_fax" value="<?php echo $row["admin_fax"]; ?>" placeholder="เบอร์แฟ๊กซ์">
            </div>
            </div>
            <div class="form-group">
            <label for="email" class="col-sm-2 control-label">อีเมล์</label>
            <div class="col-sm-10">
            <input type="weight" class="form-control" id="weight" name="email" value="<?php echo $row["email"]; ?>" placeholder="E-mail">
            </div>
            </div>
            <div class="form-group">
            <label for="username" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
            <input type="weight" class="form-control" id="username" name="username" value="<?php echo $row["username"]; ?>" placeholder="username">
            </div>
            </div>
            <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" value="<?php echo $row["password"]; ?>" placeholder="password">
            </div>
            </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="user.php" class="btn btn-danger">Cancel</a>

      </form>
      </center>

</body>
</html>
