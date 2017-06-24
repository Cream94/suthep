<?php
require_once '../database/connector.php';
$cust_id = isset($_GET["cust_id"]) ? $_GET["cust_id"] : null; // short if.

if ($cust_id != null ) {
    $sql = " DELETE FROM customer WHERE cust_id = $cust_id";
    $query = mysqli_query($conn, $sql) or die('Die query');
    header("Location: http://localhost/suthep/customer.php");
    die();
}
