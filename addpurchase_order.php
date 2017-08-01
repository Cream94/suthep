<?php
  require_once 'database/connector.php';
  $sql = "SELECT * FROM supplier";
  $querysupplier = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Suthep</title>
<?php include 'header.php' ?>
<script>
  $(document).ready(function(){
    $('#main-form').on('submit', function(e){
      var empty = 0;
      $('input[name^=number]').each(function(){
        var num = $(this).val();
        if (num == 0 || num == "") {
          empty += 1;
        }
      })
      if (empty == 0) {
        $('form:first').submit();
      } else {
        alert('กรุณาใส่จำนวนวัตถุดิบ');
        e.preventDefault();
      }
    })
  })

  function removeRow(row){
    var count = 1;
    $('.rank-count').each(function(){
      $(this).text(count++);
    })
  }
</script>
</head>
<body>
  <?php include 'navbar.php' ?>
    <div class="container-fluid">

      <center>

        <div class="row">
          <div class="col-md-10 col-md-offset-1 jumbotron well">
            <h4 style="font-weight: bold;">ใบสังซื้อสินค้า</h4> <br/>
            <form id="main-form" class="form-horizontal" action="purchase_order_confirm.php" method="post">
            <div class="form-group">
            <label for="sup_id" class="col-sm-2 control-label">ชื่อผู้ผลิต</label>
            <div class="col-sm-2">
              <select class="form-control" name="sup_id" onchange="callProductName();" id="sup_list">
                <?php
                  while ($row = mysqli_fetch_array($querysupplier)) {
                    echo '<option value="'.$row["sup_id"].'">'.$row["sup_name"].'</option>';
                  }

                 ?>
              </select>
            </div>
            <label for="mat_id" class="col-sm-1 control-label">ชื่อวัตถุดิบ</label>
            <div class="col-sm-2">
              <select class="form-control" name="mat_id" id="mat_list" onchange="callPrice()">

              </select>
            </div>
            <div class="form-group">
            <label for="number" class="col-sm-1 control-label">จำนวน</label>
            <div class="col-sm-2">
            <input type="id" class="form-control" id="number" name="add-number" placeholder="จำนวน">
            </div>
            <div class="col-sm-2">
              <button type="button" id="btnadd" class="btn btn-success">+</button>
              </div>
            </div>
            </div>

            <label>
            </label>
          <table class="table table-striped table-bordered">
            <tr  class="danger">
              <td align='center'>
                ลำดับ
              </td>
              <td align='center'>
                ชื่อบริษัท
              </td>
              <td align='center'>
                ชื่อวัตถุดิบ
              </td>
              <td align='center'>
                จำนวน
              </td>
              <td align='center'>
                ราคา/บาท
              </td>
              <td align='center'>
                Action
              </td>
            </tr>
            <tbody id="maincontent">

            </tbody>
          </table>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="purchase_order.php" class="btn btn-danger">Cancel</a>

      </form>
      </center>

      <script>
        $(document).ready(function(){
          var rank = 1;
          callProductName();
          $('#btnadd').on('click', function(){
            var sup_id = $('#sup_list').find('option:selected').val();
            var sup_name = $('#sup_list').find('option:selected').text();
            var mat_id = ($('#mat_list').find('option:selected').val()).split(":");
            var mat_name = $('#mat_list').find('option:selected').text();
            var number = $('#number').val();
            var total = parseInt(number) * parseInt($('#mat_price').val());
            //alert("mat_id: " + mat_id[0]);
            var tbody = $('#maincontent')
            var tr = $('<tr id="tr-'+rank+'"></tr>').appendTo(tbody);
            $('<input name="sup_id[]" style="display: none" value="'+ (sup_id) +'">').appendTo(tr);
            $('<input name="mat_id[]" style="display: none" value="'+ (mat_id[0]) +'">').appendTo(tr);
            $('<input name="price[]" style="display: none" value="'+ (mat_id[1]) +'">').appendTo(tr);
            $('<input name="name[]" style="display: none" value="'+ (mat_name) +'">').appendTo(tr);
            $('<td class="rank-count">'+ (rank++) +'</td>').appendTo(tr);
            $('<td>'+ (sup_name) +'</td>').appendTo(tr);
            $('<td>'+ (mat_name) +'</td>').appendTo(tr);
            $('<td><input name="number[]" value="'+ (number) +'"></td>').appendTo(tr);
            $('<td>'+ (addComma(total)) +'</td>').appendTo(tr);
            $('<td> <center> <button type="button" onclick="removeRow(\'tr-'+rank+'\')" class="btn btn-warning btn-sm remove-row">Delete</button> <center> </td>').appendTo(tr);

            $('#sup_list').attr('disabled', 'disabled');

          });
        })

        function callProductName() {
            var sup_id = $('#sup_list').val();
            $.ajax({
              url : "action/material_by_id.php",
              type : "POST",
              dataType : "JSON",
              data : {
                "sup_id" : sup_id
              },
              success : function(data) {
                var matList = $('#mat_list');
                matList.empty();
                for (var i = 0; i < data.length; i++) {
                  $("<option class='option-price' value='"+data[i].id+":"+data[i].price+"'>"+data[i].name+"</option>").appendTo(matList);
                  if (i == 0) {
                    $('#mat_price').val(data[i].price);
                  }
                }
              }
            })
        }

        function callPrice() {
          var val = $('#mat_list').val();
          var price = val.split(':');
          $('#mat_price').val(price[1]);
        }

        function addComma(val){
          while (/(\d+)(\d{3})/.test(val.toString())){
            val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
          }
          return val;
        }
      </script>

      <input type="hidden" id="mat_price">
</body>
</html>
