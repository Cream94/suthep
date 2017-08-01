<?php
  require_once 'database/connector.php';
  $prodid = $_GET["prodid"];

  $sql = "SELECT * FROM material as m
  left join supplier as s on s.sup_id = m.sup_id ";
  $search = isset($_GET["search"]) ? $_GET["search"] : "";
  if ($search != "") {
    $sql .= " WHERE m.mat_name like '%$search%' or s.sup_name like '%$search%'";
  }
  $sql .= " order by mat_id DESC";

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
          <h4><b>รายงานข้อมูลวัตถุดิบ</b></h4>
        </div><br/>
      </div>

      <div class="col-md-12 col-xs-12 border" style="margin-top: 10px">
        <div>
          <table class="table table-bordered">
            <thead>
              <th style="text-align: center">ลำดับ</th>
              <th style="text-align: center">ชื่อวัตถุดิบ</th>
              <th style="text-align: center">ราคา</th>
              <th style="text-align: center">หน่วยนับ</th>
              <th style="text-align: center">ชื่อบริษัทผู้ผลิต</th>
              <th style="text-align: center">ที่อยู่</th>
              <th style="text-align: center">เบอร์โทร</th>
            </thead>
          </div>
      </div>
      <tbody>

          <?php
            $count = 1;
            while ($row = mysqli_fetch_array($query)) {
              echo '<tr>';
              echo '<td align="center">'.$count.'</td>';
              echo '<td>'.$row["mat_name"].'</td>';
              echo '<td align="right">'.$row["price"].'</td>';
              echo '<td>'.$row["unit"].'</td>';
              echo '<td>'.$row["sup_name"].'</td>';
              echo '<td>'.$row["sup_address"].'</td>';
              echo '<td>'.$row["sup_tel"].'</td>';

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
