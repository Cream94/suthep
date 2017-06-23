<?php
require_once '../database/connector.php';
$mat_id = isset($_GET["id"]) ? $_GET["id"] : null; // short if.
$mat_name = isset($_POST["mat_name"]) ? $_POST["mat_name"] : null; // short if.
$sup_id = isset($_POST["sup_id"]) ? $_POST["sup_id"] : null; // short if.
if ($mat_name != null || $sup_id != null ) {
    $sql = "UPDATE material SET mat_name = '$mat_name', sup_id = '$sup_id' WHERE mat_id = $mat_id";
    $query = mysqli_query($conn, $sql) or die('Die query => ' . mysqli_error($conn));
    header("Location: http://localhost/suthep/material.php");
    die();
}
