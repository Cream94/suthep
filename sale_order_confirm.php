<?php
require_once 'database/connector.php';
$custID = $_POST["cust_id"];
$prodID = $_POST["prod_id"];
$prodDetail = $_POST["prod_detail"];
$numbers = $_POST["number"];
$prices = $_POST["price"];
$prodName = $_POST["name"];
$deposit = $_POST["deposit"];

$sqlCust = "SELECT * FROM customer WHERE cust_id = " . $custID[0];
$queryCust = mysqli_query($conn, $sqlCust);
$rowCustomer = mysqli_fetch_assoc($queryCust);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Suthep</title>
<?php include 'header.php' ?>
<style>
  tr:hover td {
    background: #E1F5FE
  }
</style>
</head>
<body>
  <?php include 'navbar.php' ?>
  <div class="container">
    <form action="action/sale_order_save.php" method="post">
      <input type="hidden" name="deposit" value="<?php  echo $deposit; ?>">
    <div class="col-md-12" align="center">
      <h1><?=$rowCustomer["cust_name"]; ?></h1>
      <h4><?=$rowCustomer["cust_address"]; ?></h4>
    </div>
    <div class="col-md-12" align="left">
      <h5>รายการสินค้า</h5>
    </div>
    <div class="col-md-12">
      <table class="table table-striped table-hover">
        <thead>
          <th>ลำดับ</th>
          <th>รหัสสินค้า</th>
          <th>รายละเอียด</th>
          <th style="width: 50px">จำนวน</th>
          <th>ราคา/ชิ้น</th>
          <th>ราคารวม</th>
        </thead>
        <tbody>
          <?php
            $totalNet = 0;
            for ($i=0; $i < sizeof($custID); $i++) {
              echo "<tr>";
              echo '<td>'.($i + 1).'</td>';
              echo '<td>'.$prodName[$i].'</td>';
              echo '<td>'.$prodDetail[$i].'</td>';
              echo '<td style="display: none"><input name="prod_id[]" type="text" value="'.$prodID[$i].'"></td>';
              echo '<td style="display: none"><input name="cust_id[]" type="text" value="'.$custID[$i].'"></td>';
              echo '<td><input name="number[]" min="1" type="number" onchange="calculate('.$i.', this);" value="'.$numbers[$i].'"></td>';
              echo '<td><input style="display: none" id="label-price-'.$i.'" value="'.$prices[$i].'">';
              echo '<td">'.$prices[$i].'</td>';
              echo '<td class="total-price" id="label-total-'.$i.'">'.number_format(($numbers[$i] * $prices[$i]), 2).'</td>';
              echo "</tr>";
              $totalNet += (int)($numbers[$i] * $prices[$i]);
            }
          ?>
          <tr>
            <td colspan="5" align="right"><strong>ราคาสุทธิ</strong></td>
            <td id="total-net" style="font-weight: bold"><?=number_format($totalNet, 2);?></td>
          </tr>
          <?php
            if ($deposit == 1) {
              ?>
              <tr>
                <td colspan="5" align="right"><strong>จำนวนเงินมัดจำ</strong></td>
                <td id="deposit" style="font-weight: bold"><?=number_format($totalNet*50/100, 2);?></td>
                <input type="hidden" id="text-deposit" name="total-deposit" value="<?=($totalNet*50/100);?>">
              </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
      <center>
      <button type="submit" class="btn btn-success">Confirm</button>
    </dvi>
  </div>
  <script>
  function calculate(pos, box) {
    var price = $("#label-price-" + pos).val();
    var totalBox = $("#label-total-" + pos);
    var number = $(box).val();
    totalBox.text((addComma((price * number).toFixed(2))));
    var totalNet = 0;
    $('.total-price').each(function(){
      var comma = $(this).text();
      totalNet += parseInt(comma.replace(",", ""));
    })
    $('#total-net').html(addComma(totalNet.toFixed(2)));
    var deposit = totalNet * 50 / 100;
    $('#deposit').html(addComma(deposit.toFixed(2)));
    $('#text-deposit').val(deposit.toFixed(2));
  }
  function addComma(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
  }
  </script>
</body>
</html>
