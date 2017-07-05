<?php
  require_once 'database/connector.php';
  $sql = "SELECT * FROM purchase_order as po
    left join supplier as su on su.sup_name = po.sup_id
    left join material as m on m.mat_id = s.mat_name
    left join material as m on po.mat_id = m.price
    ";

  $query = mysqli_query($conn, $sql);
  $sql2 = "SELECT * FROM purchase_order ";
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
  window.location.href ="action/purchase_order_delete.php?po_id=" + id;

}

</script>
</head>
<body>
  <?php include 'navbar.php' ?>
    <div class="container-fluid">
  <center>
  <div class="row">
<form class="form-inline">
  <div class="form-group">
    <label for="sup_id">ชื่อบริษัท</label>
    <input type="text" class="form-control" id="sup_id" placeholder="ชื่อบริษัท">
  </div>
  <button type="submit" class="btn btn-info">Search</button>
  <a href="addpurchase_order.php" class="btn btn-success">Add</a>
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
      ชื่อบริษัทผู้ผลิต
    </td>
    <td align='center'>
      ชื่อวัตถุดิบ
    </td>
    <td align='center'>
      ราคาวัตถุดิบ/ชิ้น
    </td>
    <td align='center'>
      จำนวน
    </td>
    <td align='center'>
      วันที่สั่งซื้อวัตถุดิบ
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
      echo '<td align="center">'.$row["sup_name"].'</td>';
      echo '<td>'.$row["mat_name"].'</td>';
      echo '<td>'.$row["price"].'</td>';
      echo '<td>'.$row["number"].'</td>';
      echo '<td>'.$row["date_time"].'</td>';
      $id = $row["po_id"];
      echo '<td align="center"><a href="editpurchase_order.php?id='.$id.'" class="btn btn-default btn-sm">Edit</a>
                <button type="button" class="btn btn-default btn-sm">Detail</button>
                <button type="button" class="btn btn-danger btn-sm" onclick="func_delete(\''.$row["po_id"].'\');" >Delete</button> </td>';

      echo '</tr>';
      $count++; // $count = $count + 1;
    }
  ?>


</table>
</body>
</html>
