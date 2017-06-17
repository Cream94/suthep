<?php
require_once '../database/connector.php';
$user = isset($_POST["username"]) ? $_POST["username"] : null;
$pass = isset($_POST["password"]) ? $_POST["password"] : null;
if ($user != null || $pass != null){
  $sql = "SELECT * FROM admin WHERE username = '$user' and password = '$pass'";
  $query = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($query);
  if (!empty($row)) {
    echo $row["admin_name"] ." ที่อยู่ ". $row["admin_address"];
  }else{
    echo "username or password ไม่ถูกต้อง";
  }
}


?>
