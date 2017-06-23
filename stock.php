<?php
  require_once 'database/connector.php';
  $sql = "SELECT * FROM `stock` , supplier, material WHERE stock.mat_id = material.mat_id and material.sup_id = supplier.sup_id";
  $query = mysqli_query($conn, $sql);
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
<form class="form-inline">
  <div class="form-group">
    <label for="mat_name">ชื่อวัตถุดิบ</label>
    <input type="text" class="form-control" id="mat_name" placeholder="material">
  </div>
  <button type="submit" class="btn btn-info">Search</button>
  <a href="addstock.php" class="btn btn-success">Add</a>
</form>
</center>

  <label>
  </label>
<table class="table table-striped table-bordered">
  <tr  class="warning">
    <td align='center'>
      ลำดับ
    </td>
    <td align='center'>
      รหัสวัตถุดิบ
    </td>
    <td align='center'>
      ชื่อวัตถุดิบ
    </td>
    <td align='center'>
      จำนวน
    </td>
    <td align='center'>
      บริษัทผู้ผลิต
    </td>
    <td align='center'>
      อัพเดตล่าสุด
    </td>
    <td align='center'>
      Action
    </td>
  </tr>

    <?php
      $count = 1;
      while ($row = mysqli_fetch_array($query)) {
        echo '<tr>';
        echo '<td align="center">'.$count.'</td>';
        echo '<td align="center">'.$row["mat_id"].'</td>';
        echo '<td>'.$row["mat_name"].'</td>';
        echo '<td>'.$row["number"].'</td>';
        echo '<td>'.$row["sup_name"].'</td>';
        echo '<td>'.$row["date_time"].'</td>';
        $id = $row["stock_id"];
        echo '<td align="center"><a href="editstock.php?id='.$id.'" class="btn btn-default btn-sm">Edit</a>
                  <button type="button" class="btn btn-default btn-sm">Detail</button>
                  <button type="button" class="btn btn-danger btn-sm">Delete</button> </td>';
        echo '</tr>';
        $count++; // $count = $count + 1;
      }
    ?>



</table>
</body>
</html>
