<?php
require_once '../database/connector.php';
$mat_name = isset($_POST["mat_name"]) ? $_POST["mat_name"] : null; // short if.
$unit = isset($_POST["unit"]) ? $_POST["unit"] : null; // short if.
$price = isset($_POST["price"]) ? $_POST["price"] : null; // short if.
$sup_id = isset($_POST["sup_id"]) ? $_POST["sup_id"] : null; // short if.
//print_r($_POST);
//exit();
if ($mat_name != null || $unit != null || $sup_id != null) {
    $sql = "INSERT INTO material (mat_name, unit, price, sup_id)
    VALUES('$mat_name', '$unit', '$price','$sup_id')";
    $query = mysqli_query($conn, $sql) or die('Die query');

    $mat_id = mysqli_insert_id($conn);
    $sql_stock = "INSERT INTO stock (mat_id, number)
    VALUES('$mat_id', '0')";
    mysqli_query($conn, $sql_stock) or die('Die query');


    header("Location: http://localhost/suthep/material.php");
    die();

}
