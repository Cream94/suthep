<?php
  require_once 'database/connector.php';
  $sql = "SELECT * FROM product";
  $search = isset($_GET["search"]) ? $_GET["search"] : "";
  if ($search != "") {
    $sql .= " WHERE product.prod_id like '%$search%'";
  }
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
  window.location.href ="action/product_delete.php?prod_id=" + id;

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
    <td align='center'>
      น้ำหนัก/กก.
    </td>
    <td align='center'>
      หมายเหตุ
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
        echo '<td align="center">รูปภาพ</td>';
        echo '<td align="center">'.$row["prod_id"].'</td>';
        echo '<td>'.$row["prod_detail"].'</td>';
        echo '<td align="right">'.$row["price"].'</td>';
        echo '<td align="right">'.$row["weight"].'</td>';
        echo '<td align="center">-</td>';
        $id = $row["prod_id"];
        echo   '<td align="center"><a href="editproduct.php?id='.$id.'" class="btn btn-default btn-sm">Edit</a>
                <button type="button" class="btn btn-default btn-sm">Detail</button>
                <button type="button" class="btn btn-danger btn-sm" onclick="func_delete(\''.$row["prod_id"].'\');" >Delete</button> </td>';
        echo '</tr>';
        $count++; // $count = $count + 1;
      }
    ?>

    <script>
      $(document).ready(function(){
        $('.open-AddBookDialog').on('click', function(){
          $.ajax({
            url : "action/product_by_id.php",
            type : "POST",
            dataType : "JSON",
            data : {
              "id" : $('#prod_id').val()
            },
            success : function(data) {
                var product = data.product;
                $('#modal_mat_name').val(product.prod_name);
                var productId = product.prod_id;
                var prodList = $('#modal_prod_list');

                $('#formModal').attr('action', 'action/product_edit.php?id=' + productId);
                $('#myModal').modal();
            }
          })
        })
      })
    </script>

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


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
</form>
  </div>
</div>
