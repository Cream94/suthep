<?php
  require_once 'database/connector.php';
  $sql = "SELECT * FROM stock as s
    left join material as m on m.mat_id = s.mat_id
    left join supplier as su on m.sup_id = su.sup_id
";
  $query = mysqli_query($conn, $sql);
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

        ?>
        <td align="center">
<button type="button" data-id="<?=$row["mat_id"];?>" class="btn open-AddBookDialog btn-primary btn-lg" data-toggle="modal" data-target="#myModal" name="Edit"></button>

        <?php
        echo '<a href="editstock.php?id='.$id.'" class="btn btn-default btn-sm">Edit</a>
                  <button type="button" class="btn btn-default btn-sm">Detail</button>
                  <button type="button" class="btn btn-danger btn-sm">Delete</button> </td>';
        echo '</tr>';
        $count++; // $count = $count + 1;
      }
    ?>



</table>
</body>
</html>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
