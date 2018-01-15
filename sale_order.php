<?php
  require_once 'database/connector.php';
  $sql = "SELECT * FROM sale_order ";
  $query = mysqli_query($conn, $sql);

  $sql2 = "SELECT *, sum(so.number) as total FROM sale_order as so
    left join customer as c on c.cust_id = so.cust_id
    left join so_status as sos on so.status = sos.status_id";

  $search = isset($_GET["search"]) ? $_GET["search"] : "";
  $wh = "";
  if ($search != "") {
    $wh .= " and so.so_id like '%$search%' or c.cust_name like '%$search%'";
  }
  $sql2 .= " WHERE so.status_update = 1 ".$wh;
  $sql2 .= " group by so.so_id ORDER BY so.so_id DESC";

  $query2 = mysqli_query($conn, $sql2);

  $productPerDay = 20;
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

function updateStatus() {
  var so_id = $('#so_id').val();
  var status = $('#list_status').val();
  $.ajax({
    url: "action/updateso_status.php?so_id=" + so_id,
    type: "post",
    data: {
      "status_id" : status
    },
    success: function() {
      window.location = "sale_order.php";
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
<form class="form-inline"  method="get" action="sale_order.php">
  <div class="form-group">
    <label for="cust_name">ชื่อบริษัท/เลขที่ใบสั่งสินค้า</label>
    <input type="text" name="search" class="form-control" id="cust_name" placeholder="ชื่อบริษัท/เลขที่ใบสั่งสินค้า" value="<?=$search;?>">
  </div>
  <button type="submit" class="btn btn-info">ค้นหา</button>
  <a href="addsale_order.php" class="btn btn-success">เพิ่ม</a>

  

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
      ชื่อบริษัท/ชื่อลูกค้า
    </td>
    <td align='center'>
      วันที่สั่งซื้อสินค้า
    </td>
    <td align='center'>
      จำนวนวันในการผลิต
    </td>
    <td align='center'>
      วันที่ครบกำหนดส่งสินค้า
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
    while ($row = mysqli_fetch_array($query2)) {
      echo '<tr>';
      echo '<td align="center">'.$count.'</td>';
      echo '<td align="center">'.$row["so_id"].'</td>';
      echo '<td align="center">'.$row["cust_name"].'</td>';

      $orderDate = DateTime::createFromFormat('Y-m-d H:i:s', $row["date_time"]);
      $orderDateString = $orderDate->format('d F Y');
      echo '<td>'.$orderDateString.'</td>';

      $longDay = "+1 day";
      $totalNumber = $row["total"];
      $dayWork = ceil($totalNumber / $productPerDay);
      $dayWork += 2;
      $longDay = "+".$dayWork." day";

      echo "<td align='center'>$dayWork วัน</td>";
      $sendDate = DateTime::createFromFormat('Y-m-d H:i:s', $row["date_time"])->modify($longDay);
      $newDateString = $sendDate->format('d F Y');
      echo '<td>'.$newDateString.'</td>';

      echo '<td>'.$row["status_name"].'</td>';
      $id = $row["so_id"];
      $deposit = $row["deposit"];
      $sostatus = $row["status"];

      if ($deposit == 0){
      echo '<td align="center">
                  <button type="button" onclick="$(\'#so_id\').val('.$row["so_id"].');$(\'#modal_cust_name\').val(\''.$row["cust_name"].'\');
                  $(\'#modal_date_time\').val(\''.$row["date_time"].'\');$(\'#status_name\').val(\''.$row["status_name"].'\')"
                  " class="btn btn-default open-AddBookDialog btn-sm" data-toggle="modal" data-target="#myModal">แก้ไข</button>

                  <a href="/suthep/money_invoice.php?soid='.$id.'" target="" type="button" class="btn btn-default btn-sm">รายละเอียด</a>'
                ;
              }
      else if ($deposit == 1){

                echo '<td align="center">
                            <button type="button" onclick="$(\'#so_id\').val('.$row["so_id"].');$(\'#modal_cust_name\').val(\''.$row["cust_name"].'\');
                            $(\'#modal_date_time\').val(\''.$row["date_time"].'\');$(\'#status_name\').val(\''.$row["status_name"].'\')"
                            " class="btn btn-default open-AddBookDialog btn-sm" data-toggle="modal" data-target="#myModal">แก้ไข</button>

                            <a href="/suthep/deposit_invoice.php?soid='.$id.'" target="" type="button" class="btn btn-default btn-sm">ใบเสร็จรับเงินค่ามัดจำ</a>
                            <a href="/suthep/deposit_product_invoice.php?soid='.$id.'" target="" type="button" class="btn btn-default btn-sm">ใบส่งสินค้า</a>
                            <a href="/suthep/deposit_bill_invoice.php?soid='.$id.'" target="" type="button" class="btn btn-default btn-sm">ใบเสร็จรับเงิน</a>';
      } else if ($deposit == 2){

                echo '<td align="center">
                            <button type="button" onclick="$(\'#so_id\').val('.$row["so_id"].');$(\'#modal_cust_name\').val(\''.$row["cust_name"].'\');
                            $(\'#modal_date_time\').val(\''.$row["date_time"].'\');$(\'#status_name\').val(\''.$row["status_name"].'\')"
                            " class="btn btn-default open-AddBookDialog btn-sm" data-toggle="modal" data-target="#myModal">แก้ไข</button>

                            <a href="/suthep/sale_order_invoice.php?soid='.$id.'" target="" type="button" class="btn btn-default btn-sm">ใบเสนอราคา</a>
                            <a href="/suthep/max_product_invoice.php?soid='.$id.'" target="" type="button" class="btn btn-default btn-sm">ใบส่งสินค้า</a>
                            <a href="/suthep/max_bill_invoice.php?soid='.$id.'" target="" type="button" class="btn btn-default btn-sm">ใบเสร็จรับเงิน</a>';
      }

      echo '</tr>';
      $count++; // $count = $count + 1;
    }
  ?>


</table>
<input type="hidden" id="so_id">
</body>
</html>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูลการสั่งผลิตสินค้า</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="formModal" action="" method="post">
          <div class="form-group">
            <label for="cust_name" class="col-sm-3 control-label">ชื่อลูกค้า</label>
          <div class="col-sm-9">
            <input type="detail" class="form-control" readonly id="modal_cust_name" name="cust_name" value="" placeholder="ชื่อลูกค้า">
          </div>
          </div>
          <div class="form-group">
            <label for="date_time" class="col-sm-3 control-label">วันที่สั่งผลิตสินค้า</label>
          <div class="col-sm-5">
            <input type="detail" class="form-control" readonly id="modal_date_time" name="date_time" value="" placeholder="วันที่สั่งซื้อสินค้า">
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
                  $sqlstatus = "SELECT * FROM so_status";
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
