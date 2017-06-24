<?php
require_once '../database/connector.php';
$admin_id = isset($_GET["admin_id"]) ? $_GET["admin_id"] : null; // short if.

if ($admin_id != null ) {
    $sql = " DELETE FROM admin WHERE admin_id = $admin_id";
    $query = mysqli_query($conn, $sql) or die('Die query');
    header("Location: http://localhost/suthep/user.php");
    die();
}
