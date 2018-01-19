<?php
require_once '../database/connector.php';
$id = isset($_GET["id"]) ? $_GET["id"] : null; // short if.

if ($id != null) {
  $sql = "UPDATE config SET content_id = $id WHERE type = 'vat' ";
  $query = mysqli_query($conn, $sql) or die('Die query => ' . mysqli_error($conn));
  header("Location: /suthep/vat.php");

}
 ?>
