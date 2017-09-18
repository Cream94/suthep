<?php
  require_once 'database/connector.php';
  $sql = "SELECT * FROM customer ";
  $search = isset($_GET["search"]) ? $_GET["search"] : "";
  $wh = "";
  if ($search != "") {
    $wh = " and customer.cust_name like '%$search%'";
  }
  $sql .= " WHERE customer.status = 1".$wh;
  $sql .= " ORDER BY customer.cust_id DESC";
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
  window.location.href ="action/customer_delete.php?cust_id=" + id;

}

</script>
</head>
<body>
  <?php include 'navbar.php' ?>
    <div class="container-fluid">
  <center>
  <div class="row">
<form class="form-inline">
  <div class="form-group">
    <label for="cust_name">ชื่อลูกค้า</label>
    <input type="text" name="search" class="form-control" id="cust_name" placeholder="customer" value="<?=$search;?>">
  </div>
  <button type="submit" class="btn btn-info">Search</button>
  <a href="addcustomer.php" class="btn btn-success">Add</a>
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
      ชื่อลูกค้า
    </td>
    <td align='center'>
      ที่อยู่
    </td>
    <td align='center'>
      เบอร์โทร
    </td>
    <td align='center'>
      เบอร์แฟ๊กซ์
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
      echo '<td>'.$row["cust_name"].'</td>';
      echo '<td>'.$row["cust_address"].'</td>';
      echo '<td align="right">'.$row["cust_tel"].'</td>';
      echo '<td align="right">'.$row["cust_fax"].'</td>';
      $id = $row["cust_id"];
      if ($_SESSION["login_super_admin"] == 1) {
      echo '<td align="center">
                <a href="editcustomer.php?id='.$id.'" class="btn btn-default btn-sm">Edit</a>

                <button type="button" onclick="$(\'#cust_id\').val('.$row["cust_id"].');$(\'#modal_cust_id\').val(\''.$row["cust_id"].'\');
                $(\'#modal_cust_name\').val(\''.$row["cust_name"].'\');$(\'#modal_cust_address\').val(\''.$row["cust_address"].'\');
                $(\'#modal_cust_tel\').val(\''.$row["cust_tel"].'\');$(\'#modal_cust_fax\').val(\''.$row["cust_fax"].'\');
                $(\'#modal_email\').val(\''.$row["email"].'\');$(\'#modal_tax_id\').val(\''.$row["tax_id"].'\');
                " class="btn btn-default open-AddBookDialog btn-sm" data-toggle="modal" data-target="#myModal">Detail</button>

                <button type="button" class="btn btn-danger btn-sm" onclick="func_delete(\''.$row["cust_id"].'\');" >Delete</button> </td>';
                ;
      } else {
        echo '<td align="center">
                  <a href="editcustomer.php?id='.$id.'" class="btn btn-default btn-sm">Edit</a>

                  <button type="button" onclick="$(\'#cust_id\').val('.$row["cust_id"].');$(\'#modal_cust_id\').val(\''.$row["cust_id"].'\');
                  $(\'#modal_cust_name\').val(\''.$row["cust_name"].'\');$(\'#modal_cust_address\').val(\''.$row["cust_address"].'\');
                  $(\'#modal_cust_tel\').val(\''.$row["cust_tel"].'\');$(\'#modal_cust_fax\').val(\''.$row["cust_fax"].'\');
                  $(\'#modal_email\').val(\''.$row["email"].'\');$(\'#modal_tax_id\').val(\''.$row["tax_id"].'\');
                  " class="btn btn-default open-AddBookDialog btn-sm" data-toggle="modal" data-target="#myModal">Detail</button>'
                  ;
      }
      echo '</tr>';
      $count++; // $count = $count + 1;
    }
  ?>


</table>
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
            <label for="cust_id" class="col-sm-2 control-label">รหัสลูกค้า</label>
          <div class="col-sm-4">
            <input type="detail" class="form-control" readonly id="modal_cust_id" name="cust_id" value="" placeholder="รหัสลูกค้า">
          </div>
          </div>
          <div class="form-group">
            <label for="cust_name" class="col-sm-2 control-label">ชื่อลูกค้า</label>
          <div class="col-sm-10">
            <input type="detail" class="form-control" readonly id="modal_cust_name" name="cust_name" value="" placeholder="ชื่อลูกค้า">
          </div>
          </div>
          <div class="form-group">
            <label for="cust_address" class="col-sm-2 control-label">ที่อยู่</label>
          <div class="col-sm-10">
            <input type="detail" class="form-control" readonly id="modal_cust_address" name="cust_address" value="" placeholder="ที่อยู่">
          </div>
          </div>
          <div class="form-group">
            <label for="cust_tel" class="col-sm-2 control-label">เบอร์โทร</label>
          <div class="col-sm-7">
            <input type="detail" class="form-control" readonly id="modal_cust_tel" name="cust_tel" value="" placeholder="เบอร์โทร">
          </div>
          </div>
          <div class="form-group">
            <label for="cust_fax" class="col-sm-2 control-label">เบอร์แฟ๊กซ์</label>
          <div class="col-sm-7">
            <input type="detail" class="form-control" readonly id="modal_cust_fax" name="cust_fax" value="" placeholder="เบอร์แฟ๊กซ์">
          </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">อีเมล์</label>
          <div class="col-sm-10">
            <input type="detail" class="form-control" readonly id="modal_email" name="email" value="" placeholder="อีเมล์">
          </div>
          </div>
          <div class="form-group">
            <label for="tax_id" class="col-sm-2 control-label">เลขที่เสียภาษี</label>
          <div class="col-sm-10">
            <input type="detail" class="form-control" readonly id="modal_tax_id" name="tax_id" value="" placeholder="เลขที่เสียภาษี">
          </div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
