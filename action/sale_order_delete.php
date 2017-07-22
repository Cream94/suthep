<?php
require_once '../database/connector.php';
$so_id = isset($_GET["so_id"]) ? $_GET["so_id"] : null; // short if.

if ($so_id != null ) {
    $sql = " DELETE FROM sale_order WHERE so_id = $so_id";
    $query = mysqli_query($conn, $sql) or die('Die query');
    header("Location: http://localhost/suthep/sale_order.php");
    die();
}
