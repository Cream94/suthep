<?php
require_once '../database/connector.php';
$sql = "SELECT * FROM admin";
$query = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($query)) {
  echo $row["admin_name"];
}
 ?>
