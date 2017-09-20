<?php
require_once 'database/connector.php';
$custid = $_GET["custid"];

$sqlDeposit = "SELECT *, count(so.so_id) as count, sum((so.number * prod.weight) * prod.price) as total FROM sale_order so, product prod WHERE deposit = 1
              and cust_id = $custid and so.prod_id = prod.prod_id group by so_id";

$sql1 = "SELECT * FROM sale_order as so
  left join customer as c on c.cust_id = so.cust_id
  left join admin as ad on ad.admin_id = so.admin_id WHERE so.cust_id = $custid ";

$query = mysqli_query($conn, $sql1);
$query2 = mysqli_query($conn, $sqlDeposit);
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
            <h4><b>ใบเสร็จรับเงิน</b></h4>
          </div>
      </div>
      <div class="col-md-4 col-md-offset-8">
          <table class="table table-bordered">
            <tr>
              <td align="center">สำเนาใบกำกับภาษี/ใบเสร็จรับเงิน</td>
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
          </div>
        </div>
        <div class="col-md-12 border" style="margin-top: 10px">
          <div>
            <table class="table table-bordered">
              <thead>
                <th style="text-align: center">ลำดับ</th>
                <th style="text-align: center">รายการ</th>
                <th style="text-align: center">จำนวนเงิน</th>
                <th style="text-align: center">จำนวนเงินมัดจำ</th>
                <th style="text-align: center">ยอดคงค้าง</th>
                <th style="text-align: center">ภาษี 7%</th>
                <th style="text-align: center">ยอดชำระ</th>
              <tbody>
                <?php
                $count = 1;
                $net = 0;
                while ($row = mysqli_fetch_array($query2)) {
                  echo '<tr>';
                  echo "<td align='center'>$count</td>";
                  echo '<td>เอกสารเลขที่ '.$row["so_id"].'</td>';
                  echo '<td align="right">'.number_format($row["total"], 2).'</td>';
                  echo '<td align="right">'.number_format($row["deposit_money"], 2).'</td>';
                  echo '<td align="right">'.number_format(($row["total"])-$row["deposit_money"], 2).'</td>';
                  echo '<td align="right">'.number_format(($row["total"])*7/100, 2).'</td>';
                  echo '<td align="right">'.number_format(($row["total"])-$row["deposit_money"] + (($row["total"])*7/100), 2).'</td>';
                  $net += ($row["total"])-$row["deposit_money"] + (($row["total"])*7/100);
                  echo '</tr>';
                  $count++;
                }
                 ?>

                <tr>
                  <td colspan="5" align="center"><script>document.write(ArabicNumberToText('<?=number_format($net, 2);?>'));</script></td>
                  <td align="right"><strong>ยอมรวมสุทธิ</strong></td>
                  <td align='right'>
                    <?php
                    echo number_format($net, 2);
                    ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-12" style="margin-top: 8px">
          <div class="col-md-4">
            <div class="col-md-12  border-box">
              <div class="col-md-12">
                ในนาม
              </div>
              <br/><hr>
              <div class="col-md-12" align="center">
                ผู้มีอำนาจลงนาม
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="col-md-12  border-box">
              <div class="col-md-12"><br/>
                จัดเตรียมโดย..............................................
              </div>
              <div class="col-md-12"><br/>
                ตรวจสอบโดย..............................................
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="col-md-12  border-box">
              <div class="col-md-12">
                ชำระโดย
              </div>
              <div class="col-md-12" align="center">
                <label class="radio-inline">
                  <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox1" value="option1"> เงินสด
                  </label>
                  <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox2" value="option2"> เงินเชื่อ
                  </label>
                </div>
            <div class="col-md-12">
                ธนาคาร..........................................................
            </div>
            <div class="col-md-12">
                เลขที่.......................วันที่...............................
            </div>
            <div class="col-md-12">
                ผู้รับเงิน..........................................................
            </div>
          </div>
        </div>
        <div class="col-md-12" style="margin-top: 10px">
          <center>
            <a href="payment.php" class="btn btn-danger">Back</a>
            <a href="payment_print.php?custid=<?=$custid;?>" target="_blank" class="btn btn-warning">Print</a>
          </center>
        </div>

      </body>
      </html>
