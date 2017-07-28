<?php
  require_once 'database/connector.php';

  $sql = "SELECT * FROM sale_order as so
    left join customer as c on c.cust_id = so.cust_id group By so.cust_id";

  $query = mysqli_query($conn, $sql);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Suthep</title>
<?php include 'header.php' ?>
<script type="text/javascript">

function updateDeposit() {
  var cust_id = $('#cust_id').val();
  var deposit = $('#list_deposit').val();
  $.ajax({
    url: "action/update_payment.php?cust_id=" + cust_id,
    type: "post",
    data: {
      "deposit" : deposit
    },
    success: function() {
      window.location = "payment.php";
    }
  })
}

</script>
</head>
<body>
  <?php include 'navbar.php' ?>
  <div class="container-fluid">

  <form class="form-inline"  method="get">
    <h4 align='center' style="font-weight: bold;" >การชำระเงิน</h4> <br/>
  </form>

  <table class="table table-striped table-bordered">
    <tr  class="warning" style="font-weight: bold;">
      <td align='center'>
        ลำดับ
      </td>
      <td align='center'>
        ชื่อบริษัท/ชื่อลูกค้า
      </td>
      <td align='center'>
        สถานะค้างชำระ/รายการ
      </td>
      <td align='center'>
        Action
      </td>
    </tr>

    <?php
      $count = 1;
      while ($row = mysqli_fetch_array($query)) {
        $id = $row["cust_id"];
        $sqlDeposit = "SELECT count(so_id) as count FROM sale_order WHERE deposit = 1 and cust_id = $id group by so_id";
        $query1 = mysqli_query($conn, $sqlDeposit);
        $numRow = mysqli_num_rows($query1);
        if ($numRow > 0) {
          echo '<tr style="background: pink">';
        } else {
          echo '<tr>';
        }

        echo '<td align="center">'.$count.'</td>';
        echo '<td align="center">'.$row["cust_name"].'</td>';
        echo '<td align="center">ค้างชำระ '.$numRow.' รายการ</td>';

        echo '<td align="center">
                  <button type="button" onclick="$(\'#cust_id\').val('.$row["cust_id"].');$(\'#modal_cust_name\').val(\''.$row["cust_name"].'\');
                  ;$(\'#deposit\').val(\''.$row["deposit"].'\')"
                  " class="btn btn-default open-AddBookDialog btn-sm" data-toggle="modal" data-target="#myModal">Edit</button>

                  <a href="http://localhost/suthep/bill_invoice.php?custid='.$id.'" target="_blank" type="button" class="btn btn-info btn-sm">Detail</a>
                  </td>';

        echo '</tr>';
        $count++; // $count = $count + 1;
      }
    ?>


  </table>
</div>
<input type="hidden" id="cust_id">
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
            <label for="cust_name" class="col-sm-3 control-label">ชื่อลูกค้า</label>
          <div class="col-sm-9">
            <input type="detail" class="form-control" readonly id="modal_cust_name" name="cust_name" value="" placeholder="ชื่อลูกค้า">
          </div>
          </div>
          <div class="form-group">
            <label for="deposit" class="col-sm-3 control-label">แก้ไขสถานะ</label>
            <div class="col-sm-7">
              <select class="form-control" id ="list_deposit">
                <option value="1">ยังไม่ได้ชำระ</option>
                <option value="0">ชำระเรียบร้อยแล้ว</option>
              </select>
            </div>
            <a class="btn btn-default" id ="btnupdate_deposit" onclick="updateDeposit();">
              update
            </a>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </form>
  </div>
</div>
</div>

<div class="col-md-12" style="margin-top: 10px">
  <center>
    <a href="sale_order.php" class="btn btn-danger">Black</a>
  </center>
</div>
