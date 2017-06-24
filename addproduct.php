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

        <div class="row">
          <div class="col-md-6 col-md-offset-3 jumbotron well">
            <h4 style="font-weight: bold;">Add Form</h4> <br/>
            <form class="form-horizontal" action="action/product_add.php" method="post">
              <div class="form-group">
                <label for="pic" class="col-sm-2 control-label">รูปสินค้า</label>
                <input type="file" id="exampleInputFile">
              </div>
            <div class="form-group">
            <label for="prod_id" class="col-sm-2 control-label">รหัสสินค้า</label>
            <div class="col-sm-10">
            <input type="id" class="form-control" id="prod_id" name="prod_id" placeholder="รหัสสินค้า">
            </div>
            </div>
            <div class="form-group">
            <label for="prod_detail" class="col-sm-2 control-label">รายละเอียด</label>
            <div class="col-sm-10">
            <input type="detail" class="form-control" id="prod_detail" name="prod_detail" placeholder="รายละเอียดสินค้า">
            </div>
            </div>
            <div class="form-group">
            <label for="price" class="col-sm-2 control-label">ราคา/ชิ้น</label>
            <div class="col-sm-10">
            <input type="price" class="form-control" id="price" name="price" placeholder="ราคา">
            </div>
            </div>
            <div class="form-group">
            <label for="weight" class="col-sm-2 control-label">น้ำหนัก/กก.</label>
            <div class="col-sm-10">
            <input type="weight" class="form-control" id="weight" name="weight" placeholder="น้ำหนัก">
            </div>
            </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="product.php" class="btn btn-danger">Cancel</a>

      </form>
      </center>

</body>
</html>
