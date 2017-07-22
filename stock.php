<?php
  require_once 'database/connector.php';
  $sql = "SELECT * FROM stock as s
    left join material as m on m.mat_id = s.mat_id
    left join supplier as su on m.sup_id = su.sup_id";
    $search = isset($_GET["search"]) ? $_GET["search"] : "";
    if ($search != "") {
      $sql .= " WHERE m.mat_name like '%$search%'";
    }
  $query = mysqli_query($conn, $sql);

  $sql2 = "SELECT * FROM supplier";
  $query2 = mysqli_query($conn, $sql2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Suthep</title>
<?php include 'header.php' ?>
<script type="text/javascript">
function func_delete(id, mid) {

  if(!confirm('Are you sure?')){
    e.preventDefault();
    return false;
  }
  window.location.href ="action/stock_delete.php?stock_id=" + id + "&mat_id=" + mid;

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
    <label for="mat_name">ชื่อวัตถุดิบ</label>
    <input type="text" name="search" class="form-control" id="mat_name" placeholder="material" value="<?=$search;?>">
  </div>
  <button type="submit" class="btn btn-info">Search</button>
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
      ชื่อวัตถุดิบ
    </td>
    <td align='center'>
      จำนวน
    </td>
    <td align='center'>
      บริษัทผู้ผลิต
    </td>
    <td align='center'>
      อัพเดตล่าสุด
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
        echo '<td>'.$row["mat_name"].'</td>';
        echo '<td align="right">'.$row["number"].'</td>';
        echo '<td>'.$row["sup_name"].'</td>';
        echo '<td>'.$row["date_time"].'</td>';
        $id = $row["stock_id"];

        ?>
        <td align="center">

        <?php
        echo '<button type="button" onclick="$(\'#mat_id\').val('.$row["mat_id"].')" class="btn btn-default open-AddBookDialog btn-sm">Edit</button>

              <button type="button" onclick="$(\'#stock_id\').val('.$row["stock_id"].');$(\'#modal_mat_id1\').val(\''.$row["mat_id"].'\');
              $(\'#modal_mat_name1\').val(\''.$row["mat_name"].'\');$(\'#modal_number1\').val(\''.$row["number"].'\');
              $(\'#modal_unit1\').val(\''.$row["unit"].'\');$(\'#modal_sup_name1\').val(\''.$row["sup_name"].'\');
              $(\'#modal_date_time1\').val(\''.$row["date_time"].'\')"
              class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal1">Detail</button>

              <button type="button" class="btn btn-danger btn-sm" onclick="func_delete(\''.$row["stock_id"].'\', \''.$row["mat_id"].'\');" >Delete</button> </td>';
        echo '</tr>';
        $count++; // $count = $count + 1;
      }
    ?>

    <script>
      $(document).ready(function(){
        $('.open-AddBookDialog').on('click', function(){
          $.ajax({
            url : "action/stock_by_id.php",
            type : "POST",
            dataType : "JSON",
            data : {
              "id" : $('#mat_id').val()
            },
            success : function(data) {
                var material = data.material;
                var supplier = data.supplier;
                $('#modal_mat_name').val(material.mat_name);
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
          <input type="hidden" id="mat_id" name="mat_id" value="">
          <input type="hidden" id="admin_id" name="admin_id" value="">
          <div class="form-group">
          <label for="mat_name" class="col-sm-2 control-label">ชื่อวัตถุดิบ</label>
          <div class="col-sm-10">
          <input type="detail" class="form-control" id="modal_mat_name" name="mat_name" value="" placeholder="ชื่อวัตถุดิบ">
          </div>
          </div>
          <div class="form-group">
          <label for="number" class="col-sm-2 control-label">จำนวน</label>
          <div class="col-sm-10">
          <input type="text" class="form-control" id="modal_number" max="<?php echo $row['number']?>" name="number" value="<?php echo $row['number']?>" placeholder="จำนวน">
          </div>
          </div>
          <div class="form-group">
          <label for="sup_id" class="col-sm-2 control-label">ชื่อผู้ผลิต</label>
          <div class="col-sm-7">
            <select class="form-control" name="sup_id" id="modal_sup_list">

            </select>
          </div>
          </div>

          <div class="form-group">
          <label for="status" class="col-sm-2 control-label">สถานะวัตถุดิบ</label>
          <div class="col-sm-10" align="left">
          <label class="radio-inline">
            <input type="radio" name="status" id="inlineRadio1" value="1" checked> เพิ่มวัตถุดิบ
          </label>
          <label class="radio-inline">
            <input type="radio" name="status" id="inlineRadio2" value="2">  เบิกไปใช้งาน
          </label>
          <label class="radio-inline">
            <input type="radio" name="status" id="inlineRadio3" value="3" > เสื่อมสภาพ, หาย
          </label>
        </div>
        </div>
        <div class="form-group">
        <label for="detail" class="col-sm-2 control-label">รายละเอียด</label>
        <div class="col-sm-10">
          <textarea class="form-control " style="resize: none;" rows="3" name="detail" value="<?=$row['mat_name']!=""?$row['mat_name']:"-";?>" placeholder="รายละเอียด"></textarea>

        </div>
        </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
</form>
  </div>
</div>
</div>


<!-- Modal Detail-->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
            <input type="detail" class="form-control" readonly id="modal_mat_id1" name="mat_id" value="" placeholder="รหัสวัตถุดิบ">
          </div>
          </div>
          <div class="form-group">
            <label for="mat_name" class="col-sm-2 control-label">ชื่อวัตถุดิบ</label>
          <div class="col-sm-10">
            <input type="detail" class="form-control" readonly id="modal_mat_name1" name="mat_name" value="" placeholder="ชื่อวัตถุดิบ">
          </div>
          </div>
          <div class="form-group">
            <label for="number" class="col-sm-2 control-label">จำนวน</label>
          <div class="col-sm-10">
            <input type="detail" class="form-control" readonly id="modal_number1" name="number" value="" placeholder="จำนวน">
          </div>
          </div>
          <div class="form-group">
            <label for="unit" class="col-sm-2 control-label">หน่วยนับ</label>
          <div class="col-sm-10">
            <input type="detail" class="form-control" readonly id="modal_unit1" name="unit" value="" placeholder="หน่วยนับ">
          </div>
          </div>
          <div class="form-group">
            <label for="sup_name" class="col-sm-2 control-label">บริษัทผู้ผลิต</label>
          <div class="col-sm-7">
            <input type="detail" class="form-control" readonly id="modal_sup_name1" name="sup_name" value="" placeholder="บริษัทผู้ผลิต">
          </div>
          </div>
          <div class="form-group">
            <label for="date_time" class="col-sm-2 control-label">อัพเดตล่าสุด</label>
          <div class="col-sm-7">
            <input type="detail" class="form-control" readonly id="modal_date_time1" name="date_time" value="" placeholder="อัพเดตล่าสุด">
          </div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
