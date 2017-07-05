<?php
require_once '../database/connector.php';
$id = $_POST["id"];
$sql = "SELECT * FROM product WHERE prod_id = $id";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);

$data = [];

$prod = [];
$prod["prod_id"] = $row["prod_id"];
$prod["prod_detail"] = $row["prod_detail"];
$prod["price"] = $row["price"];
$prod["weight"] = $row["weight"];
$data["product"] = $prod;

echo json_encode($data);
