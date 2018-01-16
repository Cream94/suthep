<?php
session_start();
session_destroy();
?>

<html lang="en">
<title>Suthep</title>
<?php include 'header.php' ?>
</head>
  <body>
    <br/>
    <br/>
    <br/>
        <div class="row">
          <div class="col-md-4 col-md-offset-4 jumbotron well">

                <form class="form-inline" action="email_send.php" method="post">
                  <div>
                    <h4 style="font-weight: bold;"> กรุณากรอกบัญชีผู้ใช้ของคุณ </h4>
                  </div>
                  <hr>
                  <form class="navbar-form navbar-left" role="email" >
                    <div class="form-group">
                      <input type="text" name="email" class="form-control" placeholder="email">
                    </div>
                    <input type="submit" class="btn btn-success">
                  </form>
                  <hr>
                  <div>
                    <h5> ยืนยันบัญชีผู้ใช้งานของคุณด้วยอีเมล์ </h5>
            </form>
          </div>
        </div>

  </body>
</html>
