<?php
  require_once 'database/connector.php';
  $sql = "SELECT * FROM product";
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
    <label for="prod_name">ชื่อสินค้า</label>
    <input type="text" class="form-control" id="prod_name" placeholder="product">
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
        echo '<td>'.$row["price"].'</td>';
        echo '<td>'.$row["weight"].'</td>';
        echo '<td align="center">-</td>';
        $id = $row["prod_id"];

        ?>
        <td align="center">

        <?php
        echo   '<button type="button" onclick="$(\'#prod_id\').val('.$row["prod_id"].')" class="btn btn-default open-AddBookDialog btn-sm">Edit</button>
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
                $('#modal_mat_name').val(material.prod_name);
                $('#modal_number').val(material.number);
                var stockId = material.stock_id;
                var supSeleted = material.sup_id;
                var supList = $('#modal_sup_list');
                for (var i = 0; i < supplier.length; i++) {
                  var id = supplier[i].sup_id;
                  var name = supplier[i].sup_name;
                  if (supSeleted == id) {
                    $('<option value="'+id+'" selected>'+name+'</option>').appendTo(supList);
                  } else {
                    $('<option value="'+id+'">'+name+'</option>').appendTo(supList);
                  }
                }
                $('#formModal').attr('action', 'action/stock_edit.php?id=' + stockId);
                $('#myModal').modal();
            }
          })
        })
      })
    </script>

</table>
</body>
</html>
