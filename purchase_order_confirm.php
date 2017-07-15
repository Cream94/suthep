<?php
require_once 'database/connector.php';
$supID = $_POST["sup_id"];
$matID = $_POST["mat_id"];
$numbers = $_POST["number"];
$prices = $_POST["price"];
$matName = $_POST["name"];

$sqlSup = "SELECT * FROM supplier WHERE sup_id = " . $supID[0];
$querySup = mysqli_query($conn, $sqlSup);
$rowSuppier = mysqli_fetch_assoc($querySup);
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
    <form action="action/purchase_order_save.php" method="post">
      <div class="col-md-12" align="center">
        <h1><?=$rowSuppier["sup_name"]; ?></h1>
        <h4><?=$rowSuppier["sup_address"]; ?></h4>
      </div>
      <div class="col-md-12" align="left">
        <h5>รายการสินค้า</h5>
      </div>
      <div class="col-md-12">
        <table class="table table-striped table-hover">
          <thead>
            <th>ลำดับ</th>
            <th>ชื่อสินค้า</th>
            <th style="width: 50px">จำนวน</th>
            <th>ราคาต่อชิ้น</th>
            <th>ราคารวม</th>
          </thead>
          <tbody>
            <?php
              $totalNet = 0;
              for ($i=0; $i < sizeof($supID); $i++) {
                echo "<tr>";
                echo '<td>'.($i + 1).'</td>';
                echo '<td>'.$matName[$i].'</td>';
                echo '<td style="display: none"><input name="mat_id[]" type="text" value="'.$matID[$i].'"></td>';
                echo '<td style="display: none"><input name="sup_id[]" type="text" value="'.$supID[$i].'"></td>';
                echo '<td><input name="number[]" min="1" type="number" onchange="calculate('.$i.', this);" value="'.$numbers[$i].'"></td>';
                echo '<td><input style="display: none" id="label-price-'.$i.'" value="'.$prices[$i].'">';
                echo '<td">'.$prices[$i].'</td>';
                echo '<td class="total-price" id="label-total-'.$i.'">'.number_format(($numbers[$i] * $prices[$i]), 2).'</td>';
                echo "</tr>";
                $totalNet += (int)($numbers[$i] * $prices[$i]);
              }
            ?>
            <tr>
              <td colspan="4" align="right"><strong>ราคาสุทธิ</strong></td>
              <td id="total-net" style="font-weight: bold"><?=number_format($totalNet, 2);?></td>
            </tr>
          </tbody>
        </table>
        <center>
        <button type="submit" class="btn btn-success">Confirm</button>
      </div>
    </div>
  </form>
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
