<?php
require_once '../database/connector.php';
$mat_name = isset($_POST["mat_name"]) ? $_POST["mat_name"] : null; // short if.
$sup_id = isset($_POST["sup_id"]) ? $_POST["sup_id"] : null; // short if.
if ($mat_name != null || $sup_id != null ) {
    $sql = "INSERT INTO material (mat_name, sup_id)
    VALUES('$mat_name', '$sup_id')";
    $query = mysqli_query($conn, $sql) or die('Die query');
    header("Location: http://localhost/suthep/material.php");
    die();
}
