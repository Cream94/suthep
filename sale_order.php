<?php
  require_once 'database/connector.php';
  $sql = "SELECT * FROM sale_order ";

  $query = mysqli_query($conn, $sql);
  $sql2 = "SELECT * FROM sale_order ";
  $query2 = mysqli_query($conn, $sql2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Suthep</title>
<?php include 'header.php' ?>
<script type="text/javascript">
function func_delete(id) {

  if(!confirm('Are you sure?')){
    e.preventDefault();
    return false;
  }
  window.location.href ="action/sale_order_delete.php?so_id=" + id;

}

</script>
</head>
<body>
  <?php include 'navbar.php' ?>
    <div class="container-fluid">
  <center>
  <div class="row">
<form class="form-inline"  method="get" action="sele_order.php">
  <div class="form-group">
    <label for="cust_name">ชื่อบริษัท/ชื่อลูกค้า</label>
    <input type="text" class="form-control" id="cust_name" placeholder="ชื่อบริษัท/ชื่อลูกค้า">
  </div>
  <button type="submit" class="btn btn-info">Search</button>
  <a href="addsale_order.php" class="btn btn-success">Add</a>
</form>
</center>

  <label>
  </label>
<table class="table table-striped table-bordered">
  <tr  class="warning" style="font-weight: bold;">
    <td align='center'>
      ลำดับ
    </td>
    <td align='center'>
      ชื่อบริษัท/ชื่อลูกค้า
    </td>
    <td align='center'>
      ชื่อสินค้า
    </td>
    <td align='center'>
      ราคาสินค้า/ชิ้น
    </td>
    <td align='center'>
      จำนวน
    </td>
    <td align='center'>
      วันที่สั่งซื้อสินค้า
    </td>
    <td align='center'>
      Action
    </td>
  </tr>

  <?php
    $count = 1;
    while ($row = mysqli_fetch_array($query2)) {
      echo '<tr>';
      echo '<td align="center">'.$count.'</td>';
      echo '<td align="center">'.$row["cust_name"].'</td>';
      echo '<td>'.$row["prod_name"].'</td>';
      echo '<td align="right">'.$row["price"].'</td>';
      echo '<td align="right">'.$row["number"].'</td>';
      echo '<td>'.$row["date_time"].'</td>';
      $id = $row["so_id"];
      echo '<td align="center"><a href="editsale_order.php?id='.$id.'" class="btn btn-default btn-sm">Edit</a>
                <button type="button" class="btn btn-default btn-sm">Detail</button>
                <button type="button" class="btn btn-danger btn-sm" onclick="func_delete(\''.$row["so_id"].'\');" >Delete</button> </td>';

      echo '</tr>';
      $count++; // $count = $count + 1;
    }
  ?>


</table>
</body>
</html>
