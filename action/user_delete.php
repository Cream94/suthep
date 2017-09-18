<?php
require_once '../database/connector.php';
$admin_id = isset($_GET["admin_id"]) ? $_GET["admin_id"] : null; // short if.

if ($admin_id != null ) {
    $sql = " UPDATE admin SET `status`= 0 WHERE admin_id = $admin_id";
    $query = mysqli_query($conn, $sql) or die('Die query');
    header("Location: /suthep/user.php");
    die();
}
