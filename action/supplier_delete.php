<?php
require_once '../database/connector.php';
$sup_id = isset($_GET["sup_id"]) ? $_GET["sup_id"] : null; // short if.

if ($sup_id != null ) {
    $sql = " UPDATE supplier SET `status`= 0 WHERE sup_id = $sup_id";
    $query = mysqli_query($conn, $sql) or die('Die query');
    header("Location: /suthep/supplier.php");
    die();
}
