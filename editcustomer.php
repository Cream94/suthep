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


                  <script type="text/javascript">

                      function Checkpassword(){
                        var pass =  $("#password").val();
                        if(isNaN(pass))
                          {
                            var val_check = chk_string(pass);
                            if (val_check==true) {
                                alert('กรุณาระบุ ตัวอักษรภาษาอังกฤษ และ ตัวเลข');
                                $("#password").val("");
                                $("#password").focus();
                              return false;
                            }else {
                              return true;
                            }
                          }else{
                            alert('กรุณาระบุ ตัวอักษรภาษาอังกฤษ และ ตัวเลข');
                              $("#password").val("");
                              $("#password").focus();
                             return false;
                          }
                      }
                      function chk_string(str) {
                        return /^[a-zA-Z()]+$/.test(str);
                      }


                    function KeyCode(objId)
                    {
                      if (event.keyCode >= 48 && event.keyCode<=57 || event.keyCode>=65 && event.keyCode<=90 || event.keyCode>=97 && event.keyCode<=122)
                      {
                        return true;
                      }
                      else {
                        alert("password ต้องประกอบไปด้วย เลข 0-9 ตัวอักษร A-Z และ a-z");
                        return false;
                      }
                    }
                  </script>

      <center>
        <div class="row">
          <div class="col-md-6 col-md-offset-3 jumbotron well">
            <h4 style="font-weight: bold;">Edit Form</h4> <br/>
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
            <div class="form-group">
            <label for="username" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
            <input type="weight" class="form-control" id="username" name="username" value="<?php echo $row["username"]; ?>" placeholder="username" >
            </div>
            </div>
            <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" value="<?php echo $row["password"]; ?>" placeholder="password" minlength="8" required onKeyPress="return KeyCode(password)" data-regex="^[a-z0-9_-]{6,18}$">
            </div>
            </div>

        <input type="submit" name="Save" class="btn btn-success" value="Save" onclick="return Checkpassword();">
        <a href="customer.php" class="btn btn-danger">Cancel</a>

      </form>
      </center>

</body>
</html>
