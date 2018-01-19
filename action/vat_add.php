<?php
require_once '../database/connector.php';
$id = isset($_POST["id"]) ? $_POST["id"] : null; // short if.
$vat = isset($_POST["vat"]) ? $_POST["vat"] : null; // short if.

if ($id != null || $vat != null ) {
    $sql = "INSERT INTO vat (id, vat)
    VALUES('$id', '$vat')";
    $query = mysqli_query($conn, $sql) or die('Die query');
    header("Location: /suthep/vat.php");
    die();
}
