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
      <div class="col-md-12  col-xs-12" >
        <div class="col-md-1 col-xs-1" >
          <img alt="Brand" src="logosuthep.png" width="220%" height="220%">
        </div>
        <div class="col-md-11 col-xs-11" >
          <div class="form-group" align="center">
            <h3>บริษัท สุเทพ การหล่อ จำกัด</h3>
            <h5>9/2 หมู่ 2 ถ.พุทธมณฑลสาย 4 ต.กระทุ่มล้ม อ.สามพราน จ.นครปฐม 73220 <br/>
                โทร.02-12345678 แฟ๊กซ์.02-12345678
            </h5><br/>
            <h4><b>ใบเสร็จรับเงิน</b></h4>
          </div>
      </div>

      <div class="col-md-12 col-xs-12" style="margin-top: 1px">
        <div class="col-md-6 col-xs-6">
          <div class="col-md-12 col-xs-12  border-box">
            <div class="col-md-3 col-xs-3">
              นามผู้ซื้อ
            </div>
            <div class="col-md-9 col-xs-9">
              <?=$customer["cust_name"];?>
            </div>
            <div class="col-md-3 col-xs-3">
              ที่อยู่
            </div>
            <div class="col-md-9 col-xs-9">
              <?=$customer["cust_address"];?>
            </div>
            <div class="col-md-3 col-xs-3">
              เลขที่ผู้เสียภาษี
            </div>
            <div class="col-md-9 col-xs-9">
              <?=$customer["tax_id"];?>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xs-6">
          <div class="col-md-12 col-xs-12  border-box">
            <div class="col-md-3 col-xs-3">
              เลขที่
            </div>
            <div class="col-md-9 col-xs-9">
              <?=$customer["so_id"];?>
            </div>
            <div class="col-md-3 col-xs-3">
              วันที่
            </div>
            <div class="col-md-9 col-xs-9">
              <?php
                $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $customer["date_time"]);
                $newDateString = $myDateTime->format('d F Y');
                echo $newDateString;
               ?>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-xs-12 border" style="margin-top: 10px">
          <div>
            <table class="table table-bordered">
              <thead>
                <th style="text-align: center; width: 10%">ลำดับที่</th>
                <th style="text-align: center">รายการ</th>
                <th style="text-align: center">จำนวนเงิน</th>
              </thead>
              <tbody>
                <?php
                  $total = 0;
                  while ($row = mysqli_fetch_array($query2)) {
                    $total += (($row["number"] * $row["weight"])* $row["price"]);
                  }
                ?>
                <tr>
                  <td>
                    1
                  </td>
                  <td>
                    รับเงินค้างชำระส่วนที่เหลือของเอกสารสั่งซื้อเลขที่ <?php echo $soid; ?>
                  </td>
                  <td align="right">
                    <?php
                    echo number_format($total * (50/100), 2);
                    ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" align="right"><strong>รวมเงิน</strong></td>
                  <td align='right'><?=number_format($total * (50/100), 2);?></td>
                </tr>
                <tr>
                  <td colspan="2" align="right"><strong>ภาษีมูลเพิ่ม7%</strong></td>
                  <td align='right'><?php echo number_format(($total * (50/100)) *7/100, 2) ?></td>
                </tr>
                <tr>

                  <td  colspan="2" align="right"><strong>ยอมรวมสุทธิ</strong></td>
                  <td align='right'>
                    <?php
                    $vat =($total * (50/100)) *7/100;
                    $net = ($total * (50/100)) + $vat;
                    echo number_format($net, 2);
                    ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="3" align="center"><script>document.write(ArabicNumberToText('<?=number_format($net, 2);?>'));</script></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-12 col-xs-12" style="margin-top: 8px">
          <div class="col-md-6 col-xs-6">
            <div class="col-md-12  col-xs-12 border-box">
              <br/><hr>
              <div class="col-md-12 col-xs-12" align="center">
                ผู้รับเงิน
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xs-6">
            <div class="col-md-12  col-xs-12 border-box">
              <div class="col-md-12 col-xs-12">
                ชำระโดย
              </div>
              <div class="col-md-12 col-xs-12" align="center">
                <label class="radio-inline">
                  <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox1" value="option1"> เงินสด
                  </label>
                  <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox2" value="option2"> เงินเชื่อ
                  </label>
                </div>
            <div class="col-md-12 col-xs-12">
                ธนาคาร..........................................................
            </div>
            <div class="col-md-12 col-xs-12">
                เลขที่.......................วันที่...............................
            </div>
            <div class="col-md-12 col-xs-12">
                ผู้รับเงิน..........................................................
            </div>
          </div>
        </div>

      </body>

          <script>
            $(document).ready(function(){
              window.print();
            })
          </script>
      </html>
