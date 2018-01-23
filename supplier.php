<?php
  require_once 'database/connector.php';
  $sql = "SELECT * FROM supplier ";
  $search = isset($_GET["search"]) ? $_GET["search"] : "";
  $wh = "";
  if ($search != "") {
    $wh .= " and supplier.sup_name like '%$search%'";
  }
    $sql .= " WHERE supplier.status = 1".$wh;
    $sql .= " ORDER BY supplier.sup_id DESC";
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
    <label for="sup_name">ชื่อตัวแทนจำหน่าย</label>
    <input type="text" name="search" class="form-control" id="sup_name" placeholder="ชื่อตัวแทนจำหน่าย" value="<?=$search;?>">
  </div>
  <button type="submit" class="btn btn-info">ค้นหา</button>
  <a href="addsupplier.php" class="btn btn-success">เพิ่ม</a>
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
      ชื่อตัวแทนจำหน่าย
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
      Action
    </td>
  </tr>

  <?php
    $count = 1;
    while ($row = mysqli_fetch_array($query)) {
      echo '<tr>';
      echo '<td align="center">'.$count.'</td>';
      echo '<td>'.$row["sup_name"].'</td>';
      echo '<td>'.$row["sup_address"].'</td>';
      echo '<td align="right">'.$row["sup_tel"].'</td>';
      echo '<td align="right">'.$row["sup_fax"].'</td>';
      $id = $row["sup_id"];
      if ($_SESSION["login_super_admin"] == 1) {
      echo '<td align="center">
                <a href="editsupplier.php?id='.$id.'" class="btn btn-default btn-sm">แก้ไข</a>

                <button type="button" onclick="$(\'#sup_id\').val('.$row["sup_id"].');$(\'#modal_sup_id\').val(\''.$row["sup_id"].'\');
                $(\'#modal_sup_name\').val(\''.$row["sup_name"].'\');$(\'#modal_sup_address\').val(\''.$row["sup_address"].'\');
                $(\'#modal_sup_tel\').val(\''.$row["sup_tel"].'\');$(\'#modal_sup_fax\').val(\''.$row["sup_fax"].'\');
                $(\'#modal_email\').val(\''.$row["email"].'\')"
                " class="btn btn-default open-AddBookDialog btn-sm" data-toggle="modal" data-target="#myModal">รายละเอียด</button>

                </td>';
                ;
          } else {
          echo '<td align="center">
                <a href="editsupplier.php?id='.$id.'" class="btn btn-default btn-sm">แก้ไข</a>

                <button type="button" onclick="$(\'#sup_id\').val('.$row["sup_id"].');$(\'#modal_sup_id\').val(\''.$row["sup_id"].'\');
                $(\'#modal_sup_name\').val(\''.$row["sup_name"].'\');$(\'#modal_sup_address\').val(\''.$row["sup_address"].'\');
                $(\'#modal_sup_tel\').val(\''.$row["sup_tel"].'\');$(\'#modal_sup_fax\').val(\''.$row["sup_fax"].'\');
                $(\'#modal_email\').val(\''.$row["email"].'\')"
                " class="btn btn-default open-AddBookDialog btn-sm" data-toggle="modal" data-target="#myModal">รายละเอียด</button>';
          }
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
        <h4 class="modal-title" id="myModalLabel">รายละเอียดข้อมูลตัวแทนจำหน่าย</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="formModal" action="" method="post">
          <div class="form-group">
            <label for="sup_id" class="col-sm-2 control-label">รหัสตัวแทนจำหน่าย</label>
          <div class="col-sm-4">
            <input type="detail" class="form-control" readonly id="modal_sup_id" name="sup_id" value="" placeholder="รหัสผู้ผลิต">
          </div>
          </div>
          <div class="form-group">
            <label for="sup_name" class="col-sm-2 control-label">ชื่อตัวแทนจำหน่าย</label>
          <div class="col-sm-10">
            <input type="detail" class="form-control" readonly id="modal_sup_name" name="sup_name" value="" placeholder="ชื่อผู้ผลิต">
          </div>
          </div>
          <div class="form-group">
            <label for="sup_address" class="col-sm-2 control-label">ที่อยู่</label>
          <div class="col-sm-10">
            <textarea  type="detail" class="form-control" style="resize: none;" rows="3" readonly id="modal_sup_address" name="sup_address" value="" placeholder="ที่อยู่">
            </textarea>
          </div>
          </div>
          <div class="form-group">
            <label for="sup_tel" class="col-sm-2 control-label">เบอร์โทร</label>
          <div class="col-sm-7">
            <input type="detail" class="form-control" readonly id="modal_sup_tel" name="sup_tel" value="" placeholder="เบอร์โทร">
          </div>
          </div>
          <div class="form-group">
            <label for="sup_fax" class="col-sm-2 control-label">เบอร์แฟ๊กซ์</label>
          <div class="col-sm-7">
            <input type="detail" class="form-control" readonly id="modal_sup_fax" name="sup_fax" value="" placeholder="เบอร์แฟ๊กซ์">
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
          <button type="button" class="btn btn-warning" data-dismiss="modal">ปิด</button>
        </div>
      </form>
    </div>
  </div>
