<?php
require_once '../database/connector.php';
$cust_name = isset($_POST["cust_name"]) ? $_POST["cust_name"] : null; // short if.
$cust_address = isset($_POST["cust_address"]) ? $_POST["cust_address"] : null; // short if.
$cust_tel = isset($_POST["cust_tel"]) ? $_POST["cust_tel"] : null; // short if.
$cust_fax = isset($_POST["cust_fax"]) ? $_POST["cust_fax"] : null; // short if.
$email = isset($_POST["email"]) ? $_POST["email"] : null; // short if.
if ($cust_name != null || $cust_address != null || $cust_tel != null || $cust_fax != null || $email != null) {
    $sql = "INSERT INTO customer (cust_name, cust_address, cust_tel, cust_fax, email, username, password)
    VALUES('$cust_name', '$cust_address', '$cust_tel', '$cust_fax', '$email', '$email', '$cust_tel')";
    $query = mysqli_query($conn, $sql) or die('Die query');
    header("Location: http://localhost/suthep/customer.php");
    die();
}
