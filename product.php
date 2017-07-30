<?php
  require_once 'database/connector.php';
  $sql = "SELECT * FROM product, material WHERE product.material_id = material.mat_id group by product.prod_id";
  $search = isset($_GET["search"]) ? $_GET["search"] : "";
  if ($search != "") {
    $sql .= " WHERE product.prod_id like '%$search%'";
  }
  $sql .= " ORDER By product.id DESC";  //เมื่อ add ข้อมูลแล้วจะขึ้นบนสุดของ table
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
  window.location.href ="action/product_delete.php?id=" + id;

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
    <label for="prod_id">รหัสสินค้า</label>
    <input type="text" name="search" class="form-control" id="prod_id" placeholder="product" value="<?=$search;?>">
  </div>
  <button type="submit" class="btn btn-info">Search</button>
  <a href="addproduct.php" class="btn btn-success">Add</a>
</form>
</center>

  <label>
  </label>
<table class="table table-striped table-bordered">
  <tr  class="warning">
    <td align='center'>
      ลำดับ
    </td>
    <td align='center'>
      รูปภาพ
    </td>
    <td align='center'>
      รหัสสินค้า
    </td>
    <td align='center'>
      รายละเอียดสินค้า
    </td>
    <td align='center'>
      ราคา/ชิ้น
    </td>
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
        echo '<td align="center"><img src="image/'.$row["prod_id"].'.jpg" width="50px" height="50px"></td>';
        echo '<td align="center">'.$row["prod_id"].'</td>';
        echo '<td>'.$row["prod_detail"].'</td>';
        echo '<td align="right">'.$row["price"].'</td>';
        $id = $row["prod_id"];
        echo   '<td align="center">
                <a href="editproduct.php?id='.$id.'" class="btn btn-default btn-sm">Edit</a>

                <button type="button" onclick="$(\'#modal_prod_id\').val(\''.$row["prod_id"].'\');
                $(\'#modal_prod_detail\').val(\''.$row["prod_detail"].'\');$(\'#modal_price\').val(\''.$row["price"].'\');
                $(\'#modal_weight\').val(\''.$row["weight"].'\');$(\'#modal_material_id\').val(\''.$row["mat_name"].'\');
                $(\'#modal_material_number\').val(\''.$row["material_number"].'\')
                " class="btn btn-default open-AddBookDialog btn-sm" data-toggle="modal" data-target="#myModal">Detail</button>

                <button type="button" class="btn btn-danger btn-sm" onclick="func_delete(\''.$row["prod_id"].'\');" >Delete</button> </td>';
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
            <label for="prod_id" class="col-sm-2 control-label">รหัสสินค้า</label>
          <div class="col-sm-10">
            <input type="detail" class="form-control" readonly id="modal_prod_id" name="prod_id" value="" placeholder="รหัสสินค้า">
          </div>
          </div>
          <div class="form-group">
            <label for="prod_detail" class="col-sm-2 control-label">รายละเอียด</label>
          <div class="col-sm-10">
            <input type="detail" class="form-control" readonly id="modal_prod_detail" name="prod_detail" value="" placeholder="รายละเอียด">
          </div>
          </div>
          <div class="form-group">
            <label for="price" class="col-sm-2 control-label">ราคา/ชิ้น</label>
          <div class="col-sm-7">
            <input type="detail" class="form-control" readonly id="modal_price" name="price" value="" placeholder="ราคา">
          </div>
          </div>
          <div class="form-group">
            <label for="weight" class="col-sm-2 control-label">น้ำหนัก/ชิ้น</label>
          <div class="col-sm-7">
            <input type="detail" class="form-control" readonly id="modal_weight" name="weight" value="" placeholder="น้ำหนัก/ชิ้น">
          </div>
          </div>
          <div class="form-group">
            <label for="mat_name" class="col-sm-2 control-label">วัตถุดิบที่ใช้</label>
          <div class="col-sm-7">
            <input type="detail" class="form-control" readonly id="modal_material_id" name="mat_name" value="" placeholder="วัตถุดิบที่ใช้">
          </div>
          </div>
          <div class="form-group">
            <label for="material_number" class="col-sm-2 control-label">จำนวนที่ใช้วัตถุดิบ</label>
          <div class="col-sm-7">
            <input type="detail" class="form-control" readonly id="modal_material_number" name="material_number" value="" placeholder="จำนวนที่ใช้วัตถุดิบ">
          </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
