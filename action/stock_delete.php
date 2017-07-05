<?php
require_once '../database/connector.php';
$stock_id = isset($_GET["stock_id"]) ? $_GET["stock_id"] : null; // short if.
$mat_id = isset($_POST["mat_id"]) ? $_POST["mat_id"] : null; // short if.

if ($stock_id != null || $mat_id != null) {
    $sql = " DELETE FROM stock WHERE stock_id = $stock_id";
    mysqli_query($conn, $sql) or die('Die query');

    $sql = " DELETE FROM material WHERE stock_id = $mat_id";
    mysqli_query($conn, $sql) or die('Die query');
    header("Location: http://localhost/suthep/stock.php");
    die();
}
