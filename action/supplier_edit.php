<?php
require_once '../database/connector.php';
$sup_id = isset($_GET["id"]) ? $_GET["id"] : null; // short if.
$sup_name = isset($_POST["sup_name"]) ? $_POST["sup_name"] : null; // short if.
$sup_address = isset($_POST["sup_address"]) ? $_POST["sup_address"] : null; // short if.
$sup_tel = isset($_POST["sup_tel"]) ? $_POST["sup_tel"] : null; // short if.
$sup_fax = isset($_POST["sup_fax"]) ? $_POST["sup_fax"] : null; // short if.
$email = isset($_POST["email"]) ? $_POST["email"] : null; // short if.
if ($sup_name != null || $sup_address != null || $sup_tel != null || $sup_fax != null || $email != null) {
    $sql = "UPDATE supplier SET sup_name = '$sup_name', sup_address = '$sup_address', sup_tel = '$sup_tel',
            sup_fax = '$sup_fax', email = '$email' WHERE sup_id = $sup_id";
    $query = mysqli_query($conn, $sql) or die('Die query => ' . mysqli_error($conn));
    header("Location: http://localhost/suthep/supplier.php");
    die();
}
