<?php
  require_once 'database/connector.php';
  $sql = "SELECT * FROM purchase_order as po
    left join supplier as su on su.sup_id = po.sup_id
    left join po_status as pos on po.status = pos.status_id
    Group By po_id ";

  $query = mysqli_query($conn, $sql);
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
      เลขที่เอกสาร
    </td>
    <td align='center'>
      ชื่อบริษัทผู้ผลิต
    </td>
    <td align='center'>
      วันที่สั่งซื้อวัตถุดิบ
    </td>
    <td align='center'>
      สถานะ
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
      echo '<td align="center">'.$row["po_id"].'</td>';
      echo '<td align="center">'.$row["sup_name"].'</td>';
      echo '<td>'.$row["date_time"].'</td>';
      echo '<td>'.$row["status_name"].'</td>';
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
