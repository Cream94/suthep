<?php
  require_once 'database/connector.php';
  $prodid = $_GET["prodid"];

  $sql = "SELECT *, product.price as pprice FROM product, material WHERE product.material_id = material.mat_id group by product.prod_id";
  $search = isset($_GET["search"]) ? $_GET["search"] : "";
  if ($search != "") {
    $sql .= " WHERE product.prod_id like '%$search%'";
  }
  $sql .= " ORDER By product.id DESC";  //เมื่อ add ข้อมูลแล้วจะขึ้นบนสุดของ table
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
          <h4><b>รายงานข้อมูลชิ้นงานต้นแบบ</b></h4>
        </div><br/>
      </div>

      <div class="col-md-12 col-xs-12 border" style="margin-top: 10px">
        <div>
          <table class="table table-bordered">
            <thead>
              <th style="text-align: center">ลำดับ</th>
              <th style="text-align: center">รูปชิ้นงานต้นแบบ</th>
              <th style="text-align: center">รหัสชิ้นงานต้นแบบ</th>
              <th style="text-align: center">รายละเอียด</th>
              <th style="text-align: center">ราคา</th>
              <th style="text-align: center">น้ำหนัก</th>
              <th style="text-align: center">วัตถุดิบที่ใช้</th>
              <th style="text-align: center">จำนวนวัตถุดิบ</th>
            </thead>
          </div>
      </div>
      <tbody>

          <?php
            $count = 1;
            while ($row = mysqli_fetch_array($query)) {
              echo '<tr>';
              echo '<td align="center">'.$count.'</td>';
              echo '<td align="center"><img src="image/'.$row["prod_id"].'.jpg" width="50px" height="50px"></td>';
              echo '<td align="center">'.$row["prod_id"].'</td>';
              echo '<td>'.$row["prod_detail"].'</td>';
              echo '<td align="right">'.$row["pprice"].'</td>';
              echo '<td align="right">'.$row["weight"].'</td>';
              echo '<td>'.$row["mat_name"].'</td>';
              echo '<td align="right">'.$row["material_number"].'</td>';

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
