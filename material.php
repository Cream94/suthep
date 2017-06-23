<?php
  require_once 'database/connector.php';
  $sql = "SELECT * FROM material, supplier WHERE material.sup_id = supplier.sup_id";
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
  <a href="addmaterial.php" class="btn btn-success">Add</a>
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
      ชื่อบริษัท
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
        echo '<td>'.$row["sup_name"].'</td>';
        echo '<td>'.$row["sup_address"].'</td>';
        echo '<td>'.$row["sup_tel"].'</td>';
        echo '<td>'.$row["sup_fax"].'</td>';
        echo '<td>'.$row["email"].'</td>';
        $id = $row["mat_id"];
        echo '<td align="center"><a href="editmaterial.php?id='.$id.'" class="btn btn-default btn-sm">Edit</a>
                  <button type="button" class="btn btn-default btn-sm">Detail</button>
                  <button type="button" class="btn btn-danger btn-sm">Delete</button> </td>';
        echo '</tr>';
        $count++; // $count = $count + 1;
      }
    ?>



</table>
</body>
</html>
