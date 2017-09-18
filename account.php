<?php
  require_once 'database/connector.php';

  $sqlso = "SELECT *, sum((s.number * p.weight) * p.price) as total FROM sale_order s
            left join customer  c  on s.cust_id = c.cust_id
            left join product  p on s.prod_id = p.prod_id
            group by s.so_id order by date_time";

  $sqlpo = "SELECT *, sum(p.number*m.price) as total FROM purchase_order p
            left join supplier as su on p.sup_id = su.sup_id
            left join material as m on m.mat_id = p.mat_id
            group by p.po_id order by date_time";

  $query1 = mysqli_query($conn, $sqlso);
  $query2 = mysqli_query($conn, $sqlpo);



?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Suthep</title>
<?php include 'header.php' ?>

</head>
<body>
  <?php include 'navbar.php' ?>

  <form class="form-inline"  method="get">
    <h4 align='center' style="font-weight: bold;" >บัญชี</h4> <br/>
  </form>

    <div class="col-md-6">
      <table class="table table-striped table-bordered">
        <tr class="warning" style="font-weight: bold;">
          <td style="width: 5%" align="center">
            ลำดับ
          </td>
          <td style="width: 20%" align="center">
            วันที่
          </td>
          <td style="width: 50%" align="center">
            รายการ
          </td>
          <td style="width: 25%" align="center">
            รายรับ
          </td>
          <?php
            $count = 1;
            $total = 0;
            while ($row = mysqli_fetch_array($query1)) {
              echo '<tr>';
              echo '<td align="center">'.$count.'</td>';
              $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $row["date_time"]);
              $newDateString = $myDateTime->format('d F Y');
              echo '<td align="center">'.$newDateString.'</td>';
              $deposit = $row["deposit"];
              if ($deposit == 0) {
                echo '<td align="left">เลขที่ '.$row["so_id"].' ของ '.$row["cust_name"].' เงินสด</td>';
                echo '<td align="right">'.number_format(($row["total"]*7 /100)+$row["total"], 2).'</td>';
              } else {
                echo '<td align="left">เลขที่ '.$row["so_id"].' ของ '.$row["cust_name"].' มัดจำเงินสด</td>';
                echo '<td align="right">'.number_format(($row["total"]/ 2)*7/100+($row["total"]/2), 2).'</td></tr>';
                echo '<tr><td></td><td></td><td align="left">เลขที่ '.$row["so_id"].' ของ '.$row["cust_name"].' ลูกหนี้</td>
                      <td align="right">'.number_format(($row["total"]/ 2)*7/100+($row["total"]/2), 2).'</tr>';

              }
              $total += (($row["total"])*7/100+($row["total"]));
              $count++;
            }
           ?>
           <tr>
             <td colspan="3" align="right"><strong>รวมรายรับ</strong></td>
             <td align='right'><?=number_format($total, 2);?></td>
           </tr>
        </tr>
      </table>
    </div>
    <div class="col-md-6">
      <table class="table table-striped table-bordered">
        <tr class="info" style="font-weight: bold;">
          <td style="width: 5%" align="center">
            ลำดับ
          </td>
          <td style="width: 20%" align="center">
            วันที่
          </td>
          <td style="width: 50%" align="center">
            รายการ
          </td>
          <td style="width: 25%" align="center">
            รายจ่าย
          </td>
        </tr>
        <?php
          $count = 1;
          $total1 = 0;
          while ($row = mysqli_fetch_array($query2)) {
            echo '<tr>';
            echo '<td align="center">'.$count.'</td>';
            $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $row["date_time"]);
            $newDateString = $myDateTime->format('d F Y');
            echo '<td align="center">'.$newDateString.'</td>';
            $status = $row["status"];
            if ($status == 3 || $status == 4 ) {
              echo '<td align="left">เลขที่ '.$row["po_id"].' ของ '.$row["sup_name"].' ชำระเงินสด</td>';
              echo '<td align="right">'.number_format($row["total"], 2).'</td>';
            } else {
              echo '<td align="left">เลขที่ '.$row["po_id"].' ของ '.$row["sup_name"].' ค้างชำระ</td>';
              echo '<td align="right">'.number_format($row["total"], 2).'</td></tr>';
            }
            $total1 += $row["total"];
            $count++;
          }
        ?>
        <tr>
          <td colspan="3" align="right"><strong>รวมรายจ่าย</strong></td>
          <td align='right'><?=number_format($total1, 2);?></td>
        </tr>
      </table>
    </div>
    <div class="col-md-4 col-md-offset-4">
        <table class="table table-bordered">
          <tr>
            <td style="width: 50%" align="center">สรุปยอดคงเหลือ/เดือน</td>
            <td style="width: 40%" align="center"><?php echo number_format($total - $total1, 2) ?></td>
            <td style="width: 40%" align="center">บาท</td>
          </tr>

</body>
</html>
