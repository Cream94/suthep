<?php
  require_once 'database/connector.php';
  $adminid = $_GET["adminid"];

  $sql = "SELECT * FROM admin ";
  $query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Suthep</title>
<?php include 'header.php' ?>
</head>
<body>
    <div class="container-fluid">
      <div class="col-md-12 col-xs-12" >
        <div class="form-group" align="center">
          <h3>บริษัท สุเทพ การหล่อ จำกัด</h3>
          <h4><b>รายงานข้อมูลผู้ใช้</b></h4>
        </div><br/>
      </div>

      <div class="col-md-12 col-xs-12 border" style="margin-top: 10px">
        <div>
          <table class="table table-bordered">
            <thead>
              <th style="text-align: center">ลำดับ</th>
              <th style="text-align: center">ชื่อผู้ใช้งาน</th>
              <th style="text-align: center">ที่อยู่</th>
              <th style="text-align: center">เบอร์โทร</th>
              <th style="text-align: center">เบอร์แฟ๊กซ์</th>
              <th style="text-align: center">อีเมล์</th>
              <th style="text-align: center">สถานะ: super admin=1 : admin=0</th>
            </thead>
          </div>
      </div>
      <tbody>

          <?php
            $count = 1;
            while ($row = mysqli_fetch_array($query)) {
              echo '<tr>';
              echo '<td align="center">'.$count.'</td>';
              echo '<td>'.$row["admin_name"].'</td>';
              echo '<td>'.$row["admin_address"].'</td>';
              echo '<td align="right">'.$row["admin_tel"].'</td>';
              echo '<td align="right">'.$row["admin_fax"].'</td>';
              echo '<td>'.$row["email"].'</td>';
              echo '<td align="center">'.$row["super_admin"].'</td>';

              echo '</tr>';
      $count++; // $count = $count + 1;
    }
  ?>

  </tbody>
  </table>
</body>

<script>
  $(document).ready(function(){
    window.print();
  })
</script>


</html>
