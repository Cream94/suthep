<?php
  require_once 'database/connector.php';
  $matid = $_GET["matid"];

  $sql = "SELECT * FROM material as m
  left join supplier as s on s.sup_id = m.sup_id ";
  $wh = "";
  $search = isset($_GET["search"]) ? $_GET["search"] : "";
  if ($search != "") {
    $wh .= " and m.mat_name like '%$search%' or s.sup_name like '%$search%'";
  }
  $sql .= " WHERE m.status = 1".$wh;
  $sql .= " order by mat_id DESC";

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
  window.location.href ="action/material_delete.php?mat_id=" + id;

}

</script>
</head>
<body>
  <?php include 'navbar.php' ?>
    <div class="container-fluid">
  <center>
  <div class="row">
<form class="form-inline" method="get" action="material.php">
  <div class="form-group">
    <label for="mat_name">ชื่อวัตถุดิบ/ชื่อบริษัทผู้ผลิต</label>
    <input type="text" name="search" class="form-control" id="mat_name" placeholder="material" value="<?=$search;?>">
  </div>
  <button type="submit" class="btn btn-info">Search</button>
  <a href="addmaterial.php" class="btn btn-success">Add</a>
  <a href="material_print.php?matid=<?=$matid;?>" target="_blank" class="btn btn-warning">Report</a>
</form>
</center>

  <label>
  </label>
<table class="table table-striped table-bordered">
  <tr  class="warning">
    <td align='center' style="width: 5px">
      ลำดับ
    </td>
    <td align='center' style="width: 20px">
      ชื่อวัตถุดิบ
    </td>
    <td align='center' style="width: 10px">
      ราคาวัตถุดิบ/หน่วย
    </td>
    <td align='center' style="width: 10px">
      หน่วยนับ
    </td>
    <td align='center' style="width: 20px">
      ชื่อบริษัท
    </td>
    <td align='center' style="width: 20px">
      ที่อยู่
    </td>
    <td align='center' style="width: 15px">
      Action
    </td>
  </tr>

    <?php
      $count = 1;
      while ($row = mysqli_fetch_array($query)) {
        echo '<tr>';
        echo '<td align="center">'.$count.'</td>';
        echo '<td>'.$row["mat_name"].'</td>';
        echo '<td align="right">'.$row["price"].'</td>';
        echo '<td>'.$row["unit"].'</td>';
        echo '<td>'.$row["sup_name"].'</td>';
        echo '<td>'.$row["sup_address"].'</td>';
        $id = $row["mat_id"];
        echo '<td align="center"><a href="editmaterial.php?id='.$id.'" class="btn btn-default btn-sm">Edit</a>

              <button type="button" onclick="$(\'#mat_id\').val('.$row["mat_id"].');$(\'#modal_mat_id\').val(\''.$row["mat_id"].'\');
              $(\'#modal_mat_name\').val(\''.$row["mat_name"].'\');$(\'#modal_price\').val(\''.$row["price"].'\');
              $(\'#modal_unit\').val(\''.$row["unit"].'\');$(\'#modal_sup_name\').val(\''.$row["sup_name"].'\');
              $(\'#modal_sup_address\').val(\''.$row["sup_address"].'\');$(\'#modal_sup_tel\').val(\''.$row["sup_tel"].'\');
              $(\'#modal_sup_fax\').val(\''.$row["sup_fax"].'\');$(\'#modal_email\').val(\''.$row["email"].'\')"
              " class="btn btn-default open-AddBookDialog btn-sm" data-toggle="modal" data-target="#myModal">Detail</button>

                  <button type="button" class="btn btn-danger btn-sm" onclick="func_delete(\''.$row["mat_id"].'\');" >Delete</button> </td>';
        echo '</tr>';
        $count++; // $count = $count + 1;/
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
            <label for="mat_id" class="col-sm-2 control-label">รหัสวัตถุดิบ</label>
          <div class="col-sm-4">
            <input type="detail" class="form-control" readonly id="modal_mat_id" name="mat_id" value="" placeholder="รหัสวัตถุดิบ">
          </div>
          </div>
          <div class="form-group">
            <label for="mat_name" class="col-sm-2 control-label">ชื่อวัตถุดิบ</label>
          <div class="col-sm-10">
            <input type="detail" class="form-control" readonly id="modal_mat_name" name="mat_name" value="" placeholder="ชื่อวัตถุดิบ">
          </div>
          </div>
          <div class="form-group">
            <label for="price" class="col-sm-2 control-label">ราคาวัตถุดิบ/หน่วย</label>
          <div class="col-sm-10">
            <input type="detail" class="form-control" readonly id="modal_price" name="price" value="" placeholder="ราคาวัตถุดิบ/หน่วย">
          </div>
          </div>
          <div class="form-group">
            <label for="unit" class="col-sm-2 control-label">หน่วยนับ</label>
          <div class="col-sm-7">
            <input type="detail" class="form-control" readonly id="modal_unit" name="unit" value="" placeholder="หน่วยนับ">
          </div>
          </div>
          <div class="form-group">
            <label for="sup_name" class="col-sm-2 control-label">ชื่อบริษัท</label>
          <div class="col-sm-7">
            <input type="detail" class="form-control" readonly id="modal_sup_name" name="sup_name" value="" placeholder="ชื่อบริษัท">
          </div>
          </div>
          <div class="form-group">
            <label for="sup_address" class="col-sm-2 control-label">ที่อยู่</label>
          <div class="col-sm-10">
            <input type="detail" class="form-control" readonly id="modal_sup_address" name="sup_address" value="" placeholder="ที่อยู่">
          </div>
          </div>
          <div class="form-group">
            <label for="sup_tel" class="col-sm-2 control-label">เบอร์โทร</label>
          <div class="col-sm-7">
            <input type="detail" class="form-control" readonly id="modal_sup_tel" name="sup_tel" value="" placeholder="เบอร์โทร">
          </div>
          </div>
          <div class="form-group">
            <label for="sup_fax" class="col-sm-2 control-label">เบอร์แฟ๊กซ์</label>
          <div class="col-sm-7">
            <input type="detail" class="form-control" readonly id="modal_sup_fax" name="sup_fax" value="" placeholder="เบอร์แฟ๊กซ์">
          </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">อีเมล์</label>
          <div class="col-sm-10">
            <input type="detail" class="form-control" readonly id="modal_email" name="email" value="" placeholder="อีเมล์">
          </div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
