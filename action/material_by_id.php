<?php
require_once '../database/connector.php';
$sup_id = isset($_POST["sup_id"]) ? $_POST["sup_id"] : null; // short if.

//print_r($_POST);
//exit();
if ($sup_id != null || $price != null ) {
    $sql = "SELECT * FROM material WHERE material.sup_id = $sup_id";
    $query = mysqli_query($conn, $sql) or die('Die query => ' . mysqli_error($conn));
    $data = array();
    while ($row = mysqli_fetch_array($query)) {
      $item = [];
      $item["id"] = $row["mat_id"];
      $item["name"] = $row["mat_name"];
      $item["price"] = $row["price"];
      array_push($data, $item);
    }
    echo json_encode($data);
}
