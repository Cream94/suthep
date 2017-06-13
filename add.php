<!DOCTYPE html>
<html lang="en">
<head>
<title>Suthep</title>
<?php include 'header.php' ?>
</head>
<body>
  <?php include 'navbar.php' ?>
    <div class="container-fluid">

      <center>
            <h4>Add Form</h4>
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <form class="form-horizontal">
            <div class="form-group">
            <label for="prod_id" class="col-sm-2 control-label">รหัสสินค้า</label>
            <div class="col-sm-10">
            <input type="id" class="form-control" id="prod_id" placeholder="รหัสสินค้า">
            </div>
            </div>
            <div class="form-group">
            <label for="prod_detail" class="col-sm-2 control-label">รายละเอียด</label>
            <div class="col-sm-10">
            <input type="detail" class="form-control" id="prod_detail" placeholder="รายละเอียด">
            </div>
            </div>
            <div class="form-group">
            <label for="price" class="col-sm-2 control-label">ราคา/ชิ้น</label>
            <div class="col-sm-10">
            <input type="price" class="form-control" id="price" placeholder="ราคา">
            </div>
            </div>
            <div class="form-group">
            <label for="weight" class="col-sm-2 control-label">น้ำหนัก</label>
            <div class="col-sm-10">
            <input type="weight" class="form-control" id="weight" placeholder="น้ำหนัก">
            </div>
            </div>
            <div class="form-group">
            <label for="weight" class="col-sm-2 control-label">หมายเหตุ</label>
            <div class="col-sm-10">
            <input type="weight" class="form-control" id="weight" placeholder="-">
            </div>
            </div>

            <div class="form-group">
            <label for="pic" class="col-sm-2 control-label">รูปสินค้า</label>
          <input type="file" id="exampleInputFile">
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <button type="submit" class="btn btn-danger">Cencal</button>

      </form>
      </center>

</body>
</html>
