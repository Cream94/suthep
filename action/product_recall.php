<?php
require_once '../database/connector.php';
$prod_id = isset($_GET["id"]) ? $_GET["id"] : null; // short if.

if ($prod_id != null ) {
    $sql = " UPDATE `product` SET `status`= 1 WHERE prod_id = '$prod_id'";
    $query = mysqli_query($conn, $sql) or die('Die query');
    header("Location: /suthep/product.php");
    die();
}
