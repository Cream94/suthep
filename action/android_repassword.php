<?php
  require_once '../database/connector.php';
  $user = isset($_POST["userID"]) ? $_POST["userID"] : null;
  $oldpassword = isset($_POST["oldpassword"]) ? $_POST["oldpassword"] : null;
  $newpassword = isset($_POST["newpassword"]) ? $_POST["newpassword"] : null;

  if ($user != null || $oldpassword != null || $newpassword != null) {
    $sql = "UPDATE customer SET password = '$newpassword' WHERE cust_id = $user and password = '$oldpassword'";
    mysqli_query($conn, $sql) or die("DIE");
    $resp["result"] = mysqli_affected_rows($conn) > 0 ? true : false;
  } else {
      $resp["result"] = false;
  }
  echo json_encode($resp);

 ?>
