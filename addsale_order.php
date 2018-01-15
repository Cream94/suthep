<?php
  require_once 'database/connector.php';
  $sql = "SELECT * FROM customer";
  $querycustomer = mysqli_query($conn, $sql);

  $sql2 = "SELECT * FROM product";
  $queryproduct = mysqli_query($conn, $sql2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Suthep</title>
<?php include 'header.php' ?>
<script>
var rank = 1;
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
        alert('กรุณาใส่จำนวนสินค้า');
        e.preventDefault();
      }
    })
  })

  $(document).on('click', '.remove-row', function(){
    $(this).closest("tr").remove();
    var count = 1;
    $('.ranking').each(function(){
      $(this).text(count++);
    })
    rank = count;
  })

</script>
</head>
<body>
  <?php include 'navbar.php' ?>
    <div class="container-fluid">

      <center>

        <div class="row">
          <div class="col-md-10 col-md-offset-1 jumbotron well">
            <h4 style="font-weight: bold;">ใบสังผลิตสินค้า</h4> <br/>
            <form id="main-form" class="form-horizontal" action="sale_order_confirm.php" method="post">
            <div class="form-group">
            <label for="cust_id" class="col-sm-2 control-label">ชื่อลูกค้า</label>
            <div class="col-sm-2">
              <select class="form-control" name="cust_id" onchange="callProductName();" id="cust_list">
                <?php
                  while ($row = mysqli_fetch_array($querycustomer)) {
                    echo '<option value="'.$row["cust_id"].'">'.$row["cust_name"].'</option>';
                  }

                 ?>
              </select>
            </div>
            <label for="prod_id" class="col-sm-1 control-label">รหัสสินค้า</label>
            <div class="col-sm-2">
              <select class="form-control" name="prod_id" onchange="callProductName();" id="prod_list" >
                <?php
                  while ($row = mysqli_fetch_array($queryproduct)) {
                    echo '<option value="'.$row["prod_id"]. ":" .$row["price"]. ":" .$row["prod_detail"].":" .$row["weight"].'">'.$row["prod_id"].'</option>';
                  }

                 ?>
              </select>
            </div>
            <div class="form-group">
            <label for="number" class="col-sm-1 control-label">จำนวน</label>
            <div class="col-sm-2">
            <input type="number" class="form-control" id="number" name="add-number" placeholder="จำนวน">
            </div>
            <div class="col-sm-2">
              <button type="button" id="btnadd" class="btn btn-success">+</button>
              </div>
            </div>
            <label class="radio-inline">
              <input type="radio" name="deposit" id="inlineRadio1" value="0" checked> เงินสด
            </label>
            <label class="radio-inline">
              <input type="radio" name="deposit" id="inlineRadio2" value="1">  มัดจำ (50%)
            </label>
            <label class="radio-inline">
              <input type="radio" name="deposit" id="inlineRadio2" value="2">  เงินเชื่อ
            </label>
            </div>

            <label>
            </label>
          <table class="table table-striped table-bordered">
            <tr  class="danger">
              <td align='center'>
                ลำดับ
              </td>
              <td align='center'>
                ชื่อลูกค้า
              </td>
              <td align='center'>
                รหัสสินค้า
              </td>
              <td align='center'>
                รายละเอียด
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

        <button type="submit" class="btn btn-success">บันทึก</button>
        <a href="sale_order.php" class="btn btn-danger">ยกเลิก</a>

      </form>
      </center>

      <script>
        $(document).ready(function(){
          callProductName();
          $('#btnadd').on('click', function(){
            var cust_id = $('#cust_list').find('option:selected').val();
            var cust_name = $('#cust_list').find('option:selected').text();
            var prod_id = ($('#prod_list').find('option:selected').val()).split(":");
            var prod_name = $('#prod_list').find('option:selected').text();
            var prod_detail = prod_id[2];
            var prod_weight = prod_id[3];
            var number = $('#number').val();
            var total = parseInt(number) * parseInt(prod_id[1]);
            //alert(total);
            var tbody = $('#maincontent')
            var tr = $('<tr></tr>').appendTo(tbody);
            $('<input name="cust_id[]" style="display: none" value="'+ (cust_id) +'">').appendTo(tr);
            $('<input name="prod_id[]" style="display: none" value="'+ (prod_id[0]) +'">').appendTo(tr);
            $('<input name="price[]" style="display: none" value="'+ (prod_id[1]) +'">').appendTo(tr);
            $('<input name="name[]" style="display: none" value="'+ (prod_name) +'">').appendTo(tr);
            $('<td class="ranking">'+ (rank++) +'</td>').appendTo(tr);
            $('<td>'+ (cust_name) +'</td>').appendTo(tr);
            $('<td>'+ (prod_name) +'</td>').appendTo(tr);
            $('<td>'+ (prod_detail) +'</td>').appendTo(tr);
            $('<input name="prod_detail[]" style="display: none" value="'+ (prod_detail) +'">').appendTo(tr);
            $('<input name="weight[]" style="display: none" value="'+ (prod_weight) +'">').appendTo(tr);
            $('<td><input type="number" name="number[]" value="'+ (number) +'"></td>').appendTo(tr);
            $('<td>'+ (addComma(total)) +'</td>').appendTo(tr);
            $('<td> <center> <button type="button" class="btn btn-warning btn-sm remove-row">ลบ</button> <center> </td>').appendTo(tr);

            $('#cust_list').attr('disabled', 'disabled');

          });
        })

        function callProductName() {
            var cust_id = $('#cust_list').val();
            $.ajax({
              url : "action/product_by_id.php",
              type : "POST",
              dataType : "JSON",
              data : {
                "cust_id" : cust_id
              },
              success : function(data) {
                var prodList = $('#prod_list');
                prodList.empty();
                for (var i = 0; i < data.length; i++) {
                  $("<option class='option-price' value='"+data[i].id+":"+data[i].price+"'>"+data[i].name+"</option>").appendTo(prodList);
                  if (i == 0) {
                    $('#prod_price').val(data[i].price);
                  }
                }
              }
            })
        }

        function callPrice() {
          var val = $('#prod_list').val();
          var price = val.split(':');
          $('#prod_price').val(price[1]);
        }

        function addComma(val){
          while (/(\d+)(\d{3})/.test(val.toString())){
            val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
          }
          return val;
        }
      </script>

      <input type="hidden" id="prod_price">
      <input type="hidden" id="prod_detail">
      <input type="hidden" id="tax_id">
</body>
</html>
