<?php
require_once '../database/connector.php';
$sup_id = isset($_GET["sup_id"]) ? $_GET["sup_id"] : null; // short if.

if ($sup_id != null ) {
    $sql = " DELETE FROM supplier WHERE sup_id = $sup_id";
    $query = mysqli_query($conn, $sql) or die('Die query');
    header("Location: http://localhost/suthep/supplier.php");
    die();
}
