<?php
  require_once 'database/connector.php';
  $id = $_GET["id"];
  $sql = "SELECT * FROM stock as s
          inner join material as m on s.mat_id = m.mat_id
        WHERE stock_id = $id";
  $query = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($query);
//print_r($row);exit();
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
  <?php include 'navbar.php';
  $admin_id = $_SESSION["login_id"]; ?>
    <div class="container-fluid">

      <center>
        <div class="row">
          <div class="col-md-6 col-md-offset-3 jumbotron well">
            <h4 style="font-weight: bold;">Edit Form</h4> <br/>
            <form class="form-horizontal" action="action/stock_edit.php?id=<?php echo $id;?>" method="post">
              <input type="hidden" id="mat_id" name="mat_id" value="<?php echo $row['mat_id']?>">
              <input type="hidden" id="admin_id" name="admin_id" value="<?php echo $admin_id;?>">
              <div class="form-group">
              <label for="mat_name" class="col-sm-2 control-label">ชื่อวัตถุดิบ</label>
              <div class="col-sm-10">
              <input type="detail" class="form-control" id="mat_name" name="mat_name" value="<?php echo $row['mat_name']?>" placeholder="ชื่อวัตถุดิบ">
              </div>
              </div>
              <div class="form-group">
              <label for="number" class="col-sm-2 control-label">จำนวน</label>
              <div class="col-sm-10">
              <input type="text" class="form-control" id="number" max="<?php echo $row['number']?>" name="number" value="<?php echo $row['number']?>" placeholder="จำนวน">
              </div>
              </div>
              <div class="form-group">
              <label for="sup_id" class="col-sm-2 control-label">ชื่อผู้ผลิต</label>
              <div class="col-sm-7">
                <select class="form-control" name="sup_id" >
                  <?php

                    while ($row2 = mysqli_fetch_array($query2)) {
                      if ($row2["sup_id"]==$row["sup_id"]) {
                        echo '<option value="'.$row2["sup_id"].'" selected>'.$row2["sup_name"].'</option>';
                      }else {
                        echo '<option value="'.$row2["sup_id"].'">'.$row2["sup_name"].'</option>';
                      }

                    }

                   ?>
                </select>
              </div>
              </div>

              <div class="form-group">
              <label for="status" class="col-sm-2 control-label">สถานะวัตถุดิบ</label>
              <div class="col-sm-10" align="left">
              <label class="radio-inline">
                <input type="radio" name="status" id="inlineRadio1" value="1" checked> เพิ่มวัตถุดิบ
              </label>
              <label class="radio-inline">
                <input type="radio" name="status" id="inlineRadio2" value="2">  เบิกไปใช้งาน
              </label>
              <label class="radio-inline">
                <input type="radio" name="status" id="inlineRadio3" value="3" > เสื่อมสภาพ, หาย
              </label>
            </div>
            </div>
            <div class="form-group">
            <label for="detail" class="col-sm-2 control-label">รายละเอียด</label>
            <div class="col-sm-10">
              <textarea class="form-control " style="resize: none;" rows="3" name="detail" value="<?=$row['mat_name']!=""?$row['mat_name']:"-";?>" placeholder="รายละเอียด"></textarea>

            </div>
            </div>


        <button type="submit" class="btn btn-success">Save</button>
        <a href="stock.php" class="btn btn-danger">Cancel</a>

      </form>
      </center>

</body>
</html>
