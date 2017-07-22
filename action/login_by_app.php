<?php
require_once '../database/connector.php';
  $user = isset($_POST["username"]) ? $_POST["username"] : null;
  $pass = isset($_POST["password"]) ? $_POST["password"] : null;
  if ($user != null || $pass != null) {
    $sql = "SELECT * FROM customer WHERE username = '$user' and password = '$pass'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    if (!empty($row)) {
      $row["result"] = true;
      $row["password"] = "";
      echo json_encode($row);
    } else {
      $data["result"] = false;
      $data["message"] = "username นี้ไม่มีในระบบ";
      echo json_encode($data);
    }
  }


 ?>
