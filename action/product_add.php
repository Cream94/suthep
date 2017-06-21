<?php
require_once '../database/connector.php';
$prod_id = isset($_POST["prod_id"]) ? $_POST["prod_id"] : null; // short if.
$prod_detail = isset($_POST["prod_detail"]) ? $_POST["prod_detail"] : null; // short if.
$price = isset($_POST["price"]) ? $_POST["price"] : null; // short if.
$weight = isset($_POST["weight"]) ? $_POST["weight"] : null; // short if.
if ($prod_id != null || $prod_detail != null || $price != null || $weight != null ) {
    $sql = "INSERT INTO product (prod_id, prod_detail, price, weight)
    VALUES('$prod_id', '$prod_detail', '$price', '$weight')";
    $query = mysqli_query($conn, $sql) or die('Die query');
    header("Location: http://localhost/suthep/product.php");
    die();
}
