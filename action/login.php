<?php
session_start();
require_once '../database/connector.php';
$user = isset($_POST["username"]) ? $_POST["username"] : null; // short if.
$pass = isset($_POST["password"]) ? $_POST["password"] : null; // short if.
if ($user != null || $pass != null) {
    $sql = "SELECT * FROM admin WHERE username = '$user' and password = '$pass'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    if (!empty($row)) {
        $id = $row["admin_id"];
        $name = $row["admin_name"];
        $super_admin = $row["super_admin"];
        $_SESSION["login_id"] = $id;
        $_SESSION["login_name"] = $name;
        $_SESSION["login_super_admin"] = $super_admin;
        header("Location: /suthep/product.php");
        die();
    } else {
        header("Location: /suthep/index.php");
        die();
    }
}
