<?php
require_once '../database/connector.php';
$id = $_POST["id"];
$sql = "SELECT * FROM material_log as s
        inner join material as m on s.mat_id = m.mat_id
      WHERE s.mat_id = $id Order by s.date_time desc";
$query = mysqli_query($conn, $sql);
$supplier = array();
while ($row2 = mysqli_fetch_assoc($query)) {
  // $item = [];
  // $item["date"] = $row2["date_time"];
  // $item["number"] = $row2["number"];
  // $item["name"] = $row2["mat_name"];
  array_push($supplier, $row2);
}

echo json_encode($supplier);
