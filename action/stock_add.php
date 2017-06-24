<?php
require_once '../database/connector.php';
$mat_id = isset($_POST["mat_id"]) ? $_POST["mat_id"] : null; // short if.
$number = isset($_POST["number"]) ? $_POST["number"] : null; // short if.
//print_r($_POST);
//exit();
if ($mat_id != null || $number != null ) {
    $sql = "INSERT INTO stock (mat_id, number)
    VALUES('$mat_id', '$number')";
    $query = mysqli_query($conn, $sql) or die('Die query');
    header("Location: http://localhost/suthep/stock.php");
    die();
}
