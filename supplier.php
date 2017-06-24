<?php
  require_once 'database/connector.php';
  $sql = "SELECT * FROM supplier";
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
  window.location.href ="action/supplier_delete.php?sup_id=" + id;

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
    <label for="sup_name">ชื่อผู้ผลิต</label>
    <input type="text" class="form-control" id="sup_name" placeholder="supplier">
  </div>
  <button type="submit" class="btn btn-info">Search</button>
  <a href="addsupplier.php" class="btn btn-success">Add</a>
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
      รหัสผู้ผลิต
    </td>
    <td align='center'>
      ชื่อผู้ผลิต
    </td>
    <td align='center'>
      ที่อยู่
    </td>
    <td align='center'>
      เบอร์โทร
    </td>
    <td align='center'>
      เบอร์แฟ๊กซ์
    </td>
    <td align='center'>
      E-mail
    </td>
    <td align='center'>
      หมายเหตุ
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
      echo '<td align="center">'.$row["sup_id"].'</td>';
      echo '<td>'.$row["sup_name"].'</td>';
      echo '<td>'.$row["sup_address"].'</td>';
      echo '<td>'.$row["sup_tel"].'</td>';
      echo '<td>'.$row["sup_fax"].'</td>';
      echo '<td>'.$row["email"].'</td>';
      echo '<td align="center">-</td>';
      $id = $row["sup_id"];
      echo '<td align="center"><a href="editsupplier.php?id='.$id.'" class="btn btn-default btn-sm">Edit</a>
                <button type="button" class="btn btn-default btn-sm">Detail</button>
                <button type="button" class="btn btn-danger btn-sm" onclick="func_delete(\''.$row["sup_id"].'\');" >Delete</button> </td>';
      echo '</tr>';
      $count++; // $count = $count + 1;
    }
  ?>

</table>
</body>
</html>
