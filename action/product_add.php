<?php
require_once '../database/connector.php';
$prod_id = isset($_POST["prod_id"]) ? $_POST["prod_id"] : null; // short if.
$prod_detail = isset($_POST["prod_detail"]) ? $_POST["prod_detail"] : null; // short if.
$price = isset($_POST["price"]) ? $_POST["price"] : null; // short if.
$weight = isset($_POST["weight"]) ? $_POST["weight"] : null; // short if.
$material_id = isset($_POST["material_id"]) ? $_POST["material_id"] : null; // short if.
$material_number = isset($_POST["material_number"]) ? $_POST["material_number"] : null; // short if.


$target_dir = "../image/";
$target_file = ($target_dir . $prod_id . ".jpg");
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

}

if ($prod_id != null || $prod_detail != null || $price != null || $weight != null || $material_id != null || $material_number != null) {
    $sql = "INSERT INTO product (prod_id, prod_detail, price, weight, material_id, material_number)
    VALUES('$prod_id', '$prod_detail', '$price', '$weight', '$material_id', '$material_number')";
    $query = mysqli_query($conn, $sql) or die('Die query');
    header("Location: http://localhost/suthep/product.php");
    die();
}
