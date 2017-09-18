<?php
require_once '../database/connector.php';
$po_id = isset($_GET["po_id"]) ? $_GET["po_id"] : null; // short if.

if ($po_id != null ) {
    $sql = " UPDATE purchase_order SET `status_update`= 0 WHERE po_id = $po_id";
    $query = mysqli_query($conn, $sql) or die('Die query');
    header("Location: /suthep/purchase_order.php");
    die();
}
