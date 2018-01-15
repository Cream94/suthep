<?php
require_once '../database/connector.php';
$stock_id = isset($_GET["stock_id"]) ? $_GET["stock_id"] : null; // short if.
$mat_id = isset($_GET["mat_id"]) ? $_GET["mat_id"] : null; // short if.

if ($stock_id != null || $mat_id != null) {
    $sql = " UPDATE stock SET `status`= 0 WHERE stock_id = $stock_id";
    mysqli_query($conn, $sql) or die('Die query');

    $sql = " UPDATE material SET `status`= 0 WHERE mat_id = $stock_id";
    mysqli_query($conn, $sql) or die('die query2'.$sql);
    header("Location: /suthep/stock.php");

    die();

}
