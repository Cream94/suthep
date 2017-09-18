<?php
require_once '../database/connector.php';
$cust_id = isset($_GET["cust_id"]) ? $_GET["cust_id"] : null; // short if.

if ($cust_id != null ) {
    $sql = " UPDATE customer SET `status`= 0 WHERE cust_id = $cust_id";
    $query = mysqli_query($conn, $sql) or die('Die query');
    header("Location: /suthep/customer.php");
    die();
}
