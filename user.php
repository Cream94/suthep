<?php
  require_once 'database/connector.php';
  $adminid = $_GET["asminid"];

  $sql = "SELECT * FROM admin WHERE super_admin = 0 ";
  $search = isset($_GET["search"]) ? $_GET["search"] : "";
  if ($search != "") {
    $sql .= " and (admin.admin_name like '%$search%')";
  }
    $sql .= " and admin.status = 1 ";  //การลบข้อมูลแต่ใน database ยังอยู่
    $sql .= " ORDER BY admin.admin_id DESC";
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
  window.location.href ="action/user_delete.php?admin_id=" + id;

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
    <label for="admin_name">ชื่อผู้ใช้</label>
    <input type="text" name="search" class="form-control" id="admin_name" placeholder="admin" value="<?=$search;?>">
  </div>
  <button type="submit" class="btn btn-info">Search</button>
  <a href="adduser.php" class="btn btn-success">Add</a>
  <a href="admin_print.php?adminid=<?=$adminid;?>" target="_blank" class="btn btn-warning">Report</a>
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
      รหัสผูู้ใช้
    </td>
    <td align='center'>
      ชื่อผู้ใช้
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
      echo '<td align="center">'.$row["admin_id"].'</td>';
      echo '<td>'.$row["admin_name"].'</td>';
      echo '<td>'.$row["admin_address"].'</td>';
      echo '<td align="right">'.$row["admin_tel"].'</td>';
      echo '<td align="right">'.$row["admin_fax"].'</td>';
      echo '<td>'.$row["email"].'</td>';
      echo '<td align="center">-</td>';
      $id = $row["admin_id"];
      echo '<td align="center">
                <a href="edituser.php?id='.$id.'" class="btn btn-default btn-sm">Edit</a>

                <button type="button" onclick="$(\'#admin_id\').val('.$row["admin_id"].');$(\'#modal_admin_id\').val(\''.$row["admin_id"].'\');
                $(\'#modal_admin_name\').val(\''.$row["admin_name"].'\');$(\'#modal_admin_address\').val(\''.$row["admin_address"].'\');
                $(\'#modal_admin_tel\').val(\''.$row["admin_tel"].'\');$(\'#modal_admin_fax\').val(\''.$row["admin_fax"].'\');
                $(\'#modal_email\').val(\''.$row["email"].'\')"
                " class="btn btn-default open-AddBookDialog btn-sm" data-toggle="modal" data-target="#myModal">Detail</button>

                <button type="button" class="btn btn-danger btn-sm" onclick="func_delete(\''.$row["admin_id"].'\');" >Cencal</button> </td>';
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
        <form class="form-horizontal" id="formModal" action="" method="post">
          <div class="form-group">
            <label for="admin_id" class="col-sm-2 control-label">รหัสผู้ใช้</label>
          <div class="col-sm-4">
            <input type="detail" class="form-control" readonly id="modal_admin_id" name="admin_id" value="" placeholder="รหัสผู้ใช้">
          </div>
          </div>
          <div class="form-group">
            <label for="admin_name" class="col-sm-2 control-label">ชื่อผู้ใช้</label>
          <div class="col-sm-10">
            <input type="detail" class="form-control" readonly id="modal_admin_name" name="admin_name" value="" placeholder="ชื่อผู้ใช้">
          </div>
          </div>
          <div class="form-group">
            <label for="admin_address" class="col-sm-2 control-label">ที่อยู่</label>
          <div class="col-sm-10">
            <input type="detail" class="form-control" readonly id="modal_admin_address" name="admin_address" value="" placeholder="ที่อยู่">
          </div>
          </div>
          <div class="form-group">
            <label for="admin_tel" class="col-sm-2 control-label">เบอร์โทร</label>
          <div class="col-sm-7">
            <input type="detail" class="form-control" readonly id="modal_admin_tel" name="admin_tel" value="" placeholder="เบอร์โทร">
          </div>
          </div>
          <div class="form-group">
            <label for="admin_fax" class="col-sm-2 control-label">เบอร์แฟ๊กซ์</label>
          <div class="col-sm-7">
            <input type="detail" class="form-control" readonly id="modal_admin_fax" name="admin_fax" value="" placeholder="เบอร์แฟ๊กซ์">
          </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">อีเมล์</label>
          <div class="col-sm-10">
            <input type="detail" class="form-control" readonly id="modal_email" name="email" value="" placeholder="อีเมล์">
          </div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
