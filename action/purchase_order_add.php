<?php
require_once '../database/connector.php';
$sup_id = isset($_POST["sup_id"]) ? $_POST["sup_id"] : null; // short if.33
$price = isset($_POST["price"]) ? $_POST["price"] : null; // short if.
$mat_name = isset($_POST["mat_name"]) ? $_POST["mat_name"] : null; // short if.
//print_r($_POST);
//exit();
if ($mat_name != null || $sup_id != null ) {
    $sql = "INSERT INTO material (mat_name, price, sup_id)
    VALUES('$mat_name', '$price','$sup_id')";
    $query = mysqli_query($conn, $sql) or die('Die query');

    $mat_id = mysqli_insert_id($conn);
    $sql_stock = "INSERT INTO stock (mat_id, number)
    VALUES('$mat_id', '0')";
    mysqli_query($conn, $sql_stock) or die('Die query');


    header("Location: http://localhost/suthep/purchase_order.php");
    die();

}
