<?php
require_once '../database/connector.php';
$admin_id = isset($_GET["id"]) ? $_GET["id"] : null; // short if.
$admin_name = isset($_POST["admin_name"]) ? $_POST["admin_name"] : null; // short if.
$admin_address = isset($_POST["admin_address"]) ? $_POST["admin_address"] : null; // short if.
$admin_tel = isset($_POST["admin_tel"]) ? $_POST["admin_tel"] : null; // short if.
$admin_fax = isset($_POST["admin_fax"]) ? $_POST["admin_fax"] : null; // short if.
$email = isset($_POST["email"]) ? $_POST["email"] : null; // short if.
$username = isset($_POST["username"]) ? $_POST["username"] : null; // short if.
$password = isset($_POST["password"]) ? $_POST["password"] : null; // short if.
if ($admin_name != null || $admin_address != null || $admin_tel != null || $admin_fax != null || $email != null || $username != null || $password != null) {
    $sql = "UPDATE admin SET admin_name = '$admin_name', admin_address = '$admin_address', admin_tel = '$admin_tel',
            admin_fax = '$admin_fax', email = '$email', username = '$username', password = '$password' WHERE admin_id = $admin_id";
    $query = mysqli_query($conn, $sql) or die('Die query => ' . mysqli_error($conn));
    header("Location: http://localhost/suthep/user.php");
    die();
}
