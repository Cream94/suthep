<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Suthep</title>
<?php include 'header.php' ?>
</head>
<body>
  <br/>
  <br/>
  <br/>
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <form class="form-horizontal" action="action/login.php" method="post">
            <div class="row">
            <div class="col-sm-offset-4 col-sm-4">
                <img alt="Brand" src="logosuthep.png" width="120%" height="120%">
            </div>
            <div class="col-xs-12">
                  <h3 align="center">สุเทพ การหล่อ ยินดีต้อนรับ</h3>
            </div>
          </div><br/>
              <div class="form-group">
              <label for="username" class="col-sm-2 control-label">Username</label>
              <div class="col-sm-10">
              <input type="text" class="form-control" id="username" name="username" placeholder="Username" required >
              </div>
              </div>
              <div class="form-group">
              <label for="password" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required >
              </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12" align="right">
                      <li role="presentation" ><a href="recall_password.php">ลืมรหัสผ่าน</a></li>
                </div>
              </div>
              <div class="form-group">
              <div class="col-xs-12" align="center">
              <input type="submit" name="Login" class="btn btn-success" value="Login">
              </div>
              </div>
          </form>
        </div>
      </div>
    </div>
</body>
</html>
