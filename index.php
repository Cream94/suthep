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
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <form class="form-horizontal" action="action/login.php" method="post">
              <div class="form-group">
              <label for="username" class="col-sm-2 control-label">Username</label>
              <div class="col-sm-10">
              <input type="text" class="form-control" id="username" name="username" placeholder="Username">
              </div>
              </div>
              <div class="form-group">
              <label for="password" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
              </div>
              </div>
              <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Remember me
                </label>
              </div>
              </div>
              </div>
              <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-success">Login</button>
              </div>
              </div>
          </form>
        </div>
      </div>
    </div>
</body>
</html>
