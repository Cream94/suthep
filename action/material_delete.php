<?php
require_once '../database/connector.php';
$mat_id = isset($_GET["mat_id"]) ? $_GET["mat_id"] : null; // short if.

if ($mat_id != null ) {
    $sql = " DELETE FROM material WHERE mat_id = $mat_id";
    mysqli_query($conn, $sql) or die('Die query');

    $sql = " DELETE FROM stock WHERE mat_id = $mat_id";
    mysqli_query($conn, $sql) or die('Die query');
    header("Location: /suthep/material.php");
    die();
}
