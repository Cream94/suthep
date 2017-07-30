<?php
require_once '../database/connector.php';
$cust_id = isset($_GET["id"]) ? $_GET["id"] : null; // short if.
$cust_name = isset($_POST["cust_name"]) ? $_POST["cust_name"] : null; // short if.
$cust_address = isset($_POST["cust_address"]) ? $_POST["cust_address"] : null; // short if.
$cust_tel = isset($_POST["cust_tel"]) ? $_POST["cust_tel"] : null; // short if.
$cust_fax = isset($_POST["cust_fax"]) ? $_POST["cust_fax"] : null; // short if.
$email = isset($_POST["email"]) ? $_POST["email"] : null; // short if.
if ($cust_name != null || $cust_address != null || $cust_tel != null || $cust_fax != null || $email != null) {
    $sql = "UPDATE customer SET cust_name = '$cust_name', cust_address = '$cust_address', cust_tel = '$cust_tel',
            cust_fax = '$cust_fax', email = '$email' WHERE cust_id = $cust_id";
    $query = mysqli_query($conn, $sql) or die('Die query => ' . mysqli_error($conn));
    header("Location: /suthep/customer.php");
    die();
}
