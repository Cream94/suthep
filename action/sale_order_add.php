<?php
require_once '../database/connector.php';
$cus_id = isset($_POST["cus_id"]) ? $_POST["cus_id"] : null; // short if.33
$prod_id = isset($_POST["prod_id"]) ? $_POST["prod_id"] : null; // short if.
$number= isset($_POST["number"]) ? $_POST["number"] : null; // short if.
//print_r($_POST);
//exit();
if ($prod_name != null || $prod_id != null ) {
    $sql = "INSERT INTO sale_order (cus_id, prod_id, number)
    VALUES('$cus_id', '$prod_id','$number')";
    $query = mysqli_query($conn, $sql) or die('Die query');

    header("Location: http://localhost/suthep/sale_order.php");
    die();

}
