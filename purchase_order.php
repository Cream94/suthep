<?php
  require_once 'database/connector.php';
  $sql = "SELECT * FROM purchase_order as po
    left join supplier as su on su.sup_id = po.sup_id
    left join po_status as pos on po.status = pos.status_id
    ";
    $wh = "";

    $search = isset($_GET["search"]) ? $_GET["search"] : "";
    if ($search != "") {
      $wh .= " and po.po_id like '%$search%' or su.sup_name like '%$search%'";
    }
    $sql .= " WHERE po.status_update = 1".$wh;
    $sql .= " Group By po.po_id ORDER BY po.po_id DESC";

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

function updateStatus() {
  var po_id = $('#po_id').val();
  var status = $('#list_status').val();
  $.ajax({
    url: "action/updatepo_status.php?po_id=" + po_id,
    type: "post",
    data: {
      "status_id" : status
    },
    success: function() {
      window.location = "purchase_order.php";
    }
  })
}


</script>
</head>
<body>
  <?php include 'navbar.php' ?>
    <div class="container-fluid">
  <center>
  <div class="row">
<form class="form-inline" method="get" action="purchase_order.php">
  <div class="form-group">
    <label for="sup_id">ชื่อบริษัท/เลขที่เอกสาร</label>
    <input type="text" name="search" class="form-control" id="sup_id" placeholder="ชื่อบริษัท/เลขที่เอกสาร" value="<?=$search;?>">
  </div>
  <button type="submit" class="btn btn-info">ค้นหา</button>
  <a href="addpurchase_order.php" class="btn btn-success">เพิ่ม</a>
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
      ชื่อบริษัทตัวแทนจำหน่าย
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
      if ($_SESSION["login_super_admin"] == 1) {
      echo '<td align="center">
                <button type="button" onclick="$(\'#po_id\').val('.$row["po_id"].');$(\'#modal_sup_name\').val(\''.$row["sup_name"].'\');
                $(\'#modal_date_time\').val(\''.$row["date_time"].'\');$(\'#status_name\').val(\''.$row["status_name"].'\')"
                class="btn btn-default open-AddBookDialog btn-sm" data-toggle="modal" data-target="#myModal">แก้ไข</button>

                <a href="/suthep/purchase_order_invoice.php?poid='.$id.'" target="" type="button" class="btn btn-default btn-sm">รายละเอียด</a>
                </td>';
      } else {
        echo '<td align="center">
                  <button type="button" onclick="$(\'#po_id\').val('.$row["po_id"].');$(\'#modal_sup_name\').val(\''.$row["sup_name"].'\');
                  $(\'#modal_date_time\').val(\''.$row["date_time"].'\');$(\'#status_name\').val(\''.$row["status_name"].'\')"
                  class="btn btn-default open-AddBookDialog btn-sm" data-toggle="modal" data-target="#myModal">แก้ไข</button>

                  <a href="/suthep/purchase_order_invoice.php?poid='.$id.'" target="" type="button" class="btn btn-default btn-sm">รายละเอียด</a>'
        ;
      }
      echo '</tr>';
      $count++; // $count = $count + 1;
    }
  ?>


</table>
<input type="hidden" id="po_id">
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
            <label for="sup_name" class="col-sm-3 control-label">ชื่อบริษัทตัวแทนจำหน่าย</label>
          <div class="col-sm-9">
            <input type="detail" class="form-control" readonly id="modal_sup_name" name="sup_name" value="" placeholder="ชื่อบริษัทผู้ผลิต">
          </div>
          </div>
          <div class="form-group">
            <label for="date_time" class="col-sm-3 control-label">วันที่สั่งซื้อวัตถุดิบ</label>
          <div class="col-sm-5">
            <input type="detail" class="form-control" readonly id="modal_date_time" name="date_time" value="" placeholder="วันที่สั่งซื้อวัตถุดิบ">
          </div>
          </div>
          <div class="form-group">
            <label for="status_name" class="col-sm-3 control-label">สถานะ</label>

            <div class="col-sm-7">
              <input type="text" class="form-control" readonly id="status_name" name="status_name" placeholder="สถานะ">
            </div>
          </div>
          <div class="form-group">
            <label for="status_name" class="col-sm-3 control-label">แก้ไขสถานะ</label>
            <div class="col-sm-7">
              <select class="form-control" id ="list_status">
                <?php
                  $sqlstatus = "SELECT * FROM po_status";
                  $querystatus = mysqli_query($conn, $sqlstatus);
                  while ($row = mysqli_fetch_array($querystatus)){
                    echo "<option value='". $row["status_id"] ."'>" . $row["status_name"] . "</option>";
                  }
                 ?>
              </select>
            </div>
            <a class="btn btn-default" id ="btnupdate_status" onclick="updateStatus();">
              ยืนยัน
            </a>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">ปิด</button>
        </div>
      </form>
    </div>
  </div>
