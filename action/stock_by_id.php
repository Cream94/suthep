<?php
require_once '../database/connector.php';
$id = $_POST["id"];
$sql = "SELECT * FROM stock as s
        inner join material as m on s.mat_id = m.mat_id
      WHERE stock_id = $id";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);
//print_r($row);exit();
$sql2 = "SELECT * FROM supplier";
$query2 = mysqli_query($conn, $sql2);

$data = [];

$mat = [];
$mat["mat_id"] = $row["mat_id"];
$mat["mat_name"] = $row["mat_name"];
$mat["number"] = $row["number"];
$mat["sup_id"] = $row["sup_id"];
$mat["stock_id"] = $row["stock_id"];
$data["material"] = $mat;

$supplier = array();
while ($row2 = mysqli_fetch_array($query2)) {
  $item = [];
  $item["sup_id"] = $row2["sup_id"];
  $item["sup_name"] = $row2["sup_name"];
  array_push($supplier, $item);
}
$data["supplier"] = $supplier;

echo json_encode($data);
