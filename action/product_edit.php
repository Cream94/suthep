<?php
require_once '../database/connector.php';
$prod_id = isset($_GET["prod_id"]) ? $_GET["prod_id"] : null; // short if.
$prod_detail = isset($_POST["prod_detail"]) ? $_POST["prod_detail"] : null; // short if.
$price = isset($_POST["price"]) ? $_POST["price"] : null; // short if.
$weight = isset($_POST["weight"]) ? $_POST["weight"] : null; // short if.
if ($prod_id != null || $prod_detail != null || $price != null || $weight != null ) {
    $sql = "UPDATE product SET  prod_id = '$prod_id', prod_detail = '$prod_detail', price = '$price',
            weight = '$weight' WHERE prod_id = $prod_id";
    $query = mysqli_query($conn, $sql) or die('Die query => ' . mysqli_error($conn));
    header("Location: http://localhost/suthep/product.php");
    die();
}
