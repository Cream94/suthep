<?php
require_once '../database/connector.php';
$prod_id = isset($_POST["prod_id"]) ? $_POST["prod_id"] : null; // short if.

//print_r($_POST);
//exit();
if ($prod_id != null) {
    $sql = "SELECT * FROM product ";
    $query = mysqli_query($conn, $sql) or die('Die query => ' . mysqli_error($conn));
    $data = array();
    while ($row = mysqli_fetch_array($query)) {
      $item = [];
      $item["id"] = $row["prod_id"];
      $item["name"] = $row["prod_name"];
      $item["price"] = $row["price"];
      array_push($data, $item);
    }
    echo json_encode($data);
}
