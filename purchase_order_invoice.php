<?php
require_once 'database/connector.php';
$poid = $_GET["poid"];

$sql1 = "SELECT * FROM purchase_order as po
    left join supplier as su on su.sup_id = po.sup_id
    left join admin as ad on ad.admin_id = po.admin_id
    left join material as m on m.mat_id = po.mat_id WHERE po.po_id = $poid";

$sql2 = "SELECT * FROM purchase_order as po
    left join supplier as su on su.sup_id = po.sup_id
    left join admin as ad on ad.admin_id = po.admin_id
    left join material as m on m.mat_id = po.mat_id WHERE po.po_id = $poid";

$query1 = mysqli_query($conn, $sql1);
$query2 = mysqli_query($conn, $sql2);
$supplier = mysqli_fetch_assoc($query2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Suthep</title>
<?php include 'header.php' ?>
<style>
  html, body {
    min-height: 800px;
  }
  .border-box {
    border: 1px solid #000;
    padding: 4px;
    border-radius: 4px;
  }
  .border {
    border: 1px solid #000;
    border-radius: 4px;
    padding-left: 0px;
    padding-right: 0px;
  }
</style>
</head>
<body>
  <?php include 'navbar.php' ?>
  <div class="container">
      <div class="col-md-12" >
        <div class="col-md-1" >
          <img alt="Brand" src="logosuthep.png" width="220%" height="220%">
        </div>
        <div class="col-md-11" >
          <div class="form-group" align="center">
            <h3>บริษัท สุเทพ การหล่อ จำกัด</h3>
            <h5>9/2 หมู่ 2 ถ.พุทธมณฑลสาย 4 ต.กระทุ่มล้ม อ.สามพราน จ.นครปฐม 73220 <br/>
                โทร.02-12345678 แฟ๊กซ์.02-12345678
            </h5><br/>
            <h4><b>ใบสั่งซื้อ</b></h4>
          </div>
      </div>
      <div class="col-md-4 col-md-offset-8">
          <table class="table table-bordered">
            <tr>
              <td style="width: 40%" align="center">เลขที่เอกสาร</td>
              <td style="width: 60%"><?=$supplier["po_id"];?></td>
            </tr>
            <tr>
              <td style="width: 40%" align="center">วันที่เอกสาร</td>
              <td style="width: 60%">
                <?php
                  $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $supplier["date_time"]);
                  $newDateString = $myDateTime->format('d F Y');
                  echo $newDateString;
               ?>
             </td>
            </tr>
          </table>
      </div>
      <div class="col-md-12">
        <div class="col-md-6">
            <div class="col-md-4">
              <strong>รหัสผู้ขาย</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$supplier["sup_id"];?>
            </div>
            <div class="col-md-8">
              <strong>ชื่อผู้ติดต่อ</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$supplier["admin_name"];?>
            </div>
        </div>
      </div>
      <div class="col-md-12" style="margin-top: 10px">
        <div class="col-md-6">
          <div class="col-md-12  border-box">
            <div class="col-md-2">
              ชื่อผู้ขาย
            </div>
            <div class="col-md-10">
              <?=$supplier["sup_name"];?>
            </div>
            <div class="col-md-2">
              ที่อยู่
            </div>
            <div class="col-md-10">
              <?=$supplier["sup_address"];?>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="col-md-12  border-box">
            <div class="col-md-3">
              วันที่อนุมัติขอซื้อ
            </div>
            <div class="col-md-9">
              <?php
                $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $supplier["date_time"]);
                $newDateString = $myDateTime->format('d F Y');
                echo $newDateString;
             ?>
            </div>
            <div class="col-md-3">
              วันกำหนดส่ง
            </div>
            <div class="col-md-9">
              -
            </div>
            <div class="col-md-3">
              จำนวนวันเครดิต
            </div>
            <div class="col-md-9">
              7 วัน
            </div>
            <div class="col-md-3">
              เงื่อนไขการชำระ
            </div>
            <div class="col-md-9">
              ทุกวันจันทร์-ศุกร์
            </div>
          </div>
        </div>
        <div class="col-md-12 border" style="margin-top: 10px">
          <div>
            <table class="table table-bordered">
              <thead>
                <th style="text-align: center">ลำดับ</th>
                <th style="text-align: center">รายการ</th>
                <th style="text-align: center">จำนวน</th>
                <th style="text-align: center">หน่วยนับ</th>
                <th style="text-align: center">ราคา/หน่วย</th>
                <th style="text-align: center">จำนวนเงิน</th>
              </thead>
              <tbody>
                <?php
                  $count = 1;
                  $total = 0;
                  while ($row = mysqli_fetch_array($query1)) {
                    echo "<tr>";
                    echo "<td align='center'>$count</td>";
                    echo "<td>".$row["mat_name"]."</td>";
                    echo "<td align='right'>".$row["number"]."</td>";
                    echo "<td align='center'>".$row["unit"]."</td>";
                    echo "<td align='right'>".number_format($row["price"], 2)."</td>";
                    echo "<td align='right'>".number_format($row["number"] * $row["price"], 2)."</td>";
                    $total += ($row["number"] * $row["price"]);
                    echo "</tr>";
                    $count++;
                  }
                ?>
                <tr>
                  <td colspan="5" align="right"><strong>ราคาสุทธิ</strong></td>
                  <td align='right'><?=number_format($total, 2);?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
          <div class="col-md-12  border-box" style="margin-top: 3px">
            <div class="col-md-6">
            <h6>
              <strong><div class="col-md-12">
                เงื่อนไขอื่นๆ
              </strong></div>
              <div class="col-md-12">
                (1)โปรดระบุเลขที่ใบสั่งซื้อข้างต้น ใบในสั่งของทุกฉบับ
              </div>
              <div class="col-md-12">
                (2)การวางบิลและการรับเช็คเป็นไปตามกำหนดเวลาที่บริษัทกำหนดไว้
              </div>
              <div class="col-md-12">
                (3)ในการวางบิลเพื่อเรียกเก็บ ให้แนบสำเนาใบสั่งซื้อมาด้วย
              </div>
            </h6>
          </div>
            <div class="col-md-3" style="border-left : 1px solid black">
              <div class="col-md-12">
                ผู้จัดทำ
              </div>
              <br/><hr>
            </div>
            <div class="col-md-3"  style="border-left : 1px solid black">
              <div class="col-md-12">
                ในนาม
              </div>
              <br/><hr>
              <div class="col-md-12">
                ผู้มีอำนาจลงนาม
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12" style="margin-top: 10px">
        <center>
          <a href="purchase_order.php" class="btn btn-danger">Black</a>
        </center>
      </div>


  </div>
</body>
</html>
