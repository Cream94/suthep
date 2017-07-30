<?php
require_once 'database/connector.php';
$soid = $_GET["soid"];

$sql1 = "SELECT * FROM sale_order as so
  left join customer as c on c.cust_id = so.cust_id
  left join admin as ad on ad.admin_id = so.admin_id
  left join product as p on p.prod_id = so.prod_id WHERE so.so_id = $soid group by so.prod_id";

$sql2 = "SELECT * FROM sale_order as so
  left join customer as c on c.cust_id = so.cust_id
  left join admin as ad on ad.admin_id = so.admin_id
  left join product as p on p.prod_id = so.prod_id WHERE so.so_id = $soid group by so.prod_id";

$query = mysqli_query($conn, $sql1);
$query2 = mysqli_query($conn, $sql2);
$customer = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Suthep</title>
<?php include 'header.php' ?>
<style>
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
            <h4><b>ใบส่งสินค้า</b></h4>
          </div>
      </div>
      <div class="col-md-4 col-md-offset-8">
          <table class="table table-bordered">
            <tr>
              <td align="center">สำเนาใบกำกับภาษี/ใบส่งของ</td>
            </tr>
          </table>
      </div>
      <div class="col-md-12" style="margin-top: 1px">
        <div class="col-md-6">
          <div class="col-md-12  border-box">
            <div class="col-md-3">
              นามลูกค้า
            </div>
            <div class="col-md-9">
              <?=$customer["cust_name"];?>
            </div>
            <div class="col-md-3">
              ที่อยู่
            </div>
            <div class="col-md-9">
              <?=$customer["cust_address"];?>
            </div>
            <div class="col-md-3">
              เลขที่ผู้เสีภาษี
            </div>
            <div class="col-md-9">
              <?=$customer["tax_id"];?>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="col-md-12  border-box">
            <div class="col-md-3">
              เลขที่
            </div>
            <div class="col-md-9">
              <?=$customer["so_id"];?>
            </div>
            <div class="col-md-3">
              วันที่
            </div>
            <div class="col-md-9">
              <?php
                $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $customer["date_time"]);
                $newDateString = $myDateTime->format('d F Y');
                echo $newDateString;
               ?>
            </div>
            <div class="col-md-3">
              กำหนดชำระเงิน
            </div>
            <div class="col-md-9">
              7 วัน
            </div>
            <div class="col-md-3">
              ครบกำหนด
            </div>
            <div class="col-md-9">
              <?php

                $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $customer["date_time"])->modify('+7 day');
                $newDateString = $myDateTime->format('d F Y');
                echo $newDateString;
               ?>
            </div>
          </div>
        </div>
        <div class="col-md-12 border" style="margin-top: 10px">
          <div>
            <table class="table table-bordered">
              <thead>
                <th style="text-align: center">ลำดับ</th>
                <th style="text-align: center">รหัสสินค้า</th>
                <th style="text-align: center">รายละเอียด</th>
                <th style="text-align: center">จำนวน</th>
                <th style="text-align: center">นน./ชิ้น</th>
                <th style="text-align: center">นน.รวม</th>
                <th style="text-align: center">หน่วยละ</th>
                <th style="text-align: center">จำนวนเงิน</th>
              </thead>
              <tbody>
                <?php
                  $count = 1;
                  $total = 0;
                  while ($row = mysqli_fetch_array($query2)) {
                    echo "<tr>";
                    echo "<td align='center'>$count</td>";
                    echo "<td>".$row["prod_id"]."</td>";
                    echo "<td>".$row["prod_detail"]."</td>";
                    echo "<td align='right'>".$row["number"]."</td>";
                    echo "<td align='right'>".$row["weight"]."</td>";
                    echo "<td align='right'>".number_format($row["number"] * $row["weight"], 2)."</td>";
                    echo "<td align='right'>".$row["price"]."</td>";
                    echo "<td align='right'>".number_format(($row["number"] * $row["weight"])* $row["price"], 2)."</td>";
                    $total += (($row["number"] * $row["weight"])* $row["price"]);
                    echo "</tr>";
                    $count++;
                  }
                ?>
                <tr>
                  <td colspan="7" align="right"><strong>รวมเงิน</strong></td>
                  <td align='right'><?=number_format($total, 2);?></td>
                </tr>
                <tr>
                  <td colspan="7" align="right"><strong>ภาษีมูลเพิ่ม7%</strong></td>
                  <td align='right'><?php echo number_format($total*7/100, 2) ?></td>
                </tr>
                <tr>
                  <td colspan="7" align="right"><strong>ยอมรวมสุทธิ</strong></td>
                  <td align='right'>
                    <?php
                    $vat = $total * 7 / 100;
                    $net = $total + $vat;
                    echo number_format($net, 2);
                    ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-12" style="margin-top: 8px">
          <div class="col-md-3">
            <div class="col-md-12  border-box">
              <div class="col-md-12">
                ผู้รับสินค้า...............................
              </div>
              <div class="col-md-12">
                วันที่...................................
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="col-md-12  border-box">
              <div class="col-md-12">
                ผู้ส่งสินค้า...............................
              </div>
              <div class="col-md-12">
                วันที่...................................
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="col-md-12  border-box">
              <div class="col-md-12">
                ผู้รับเงิน.................................
              </div>
              <div class="col-md-12">
                วันที่...................................
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="col-md-12  border-box">
              <div class="col-md-12">
                ผู้อนุมัติ.................................
              </div>
              <div class="col-md-12">
                วันที่...................................
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12" style="margin-top: 10px">
          <center>
            <a href="sale_order.php" class="btn btn-danger">Back</a>
          </center>
        </div>

</body>
</html>
