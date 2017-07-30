<?php
require_once '../database/connector.php';
session_start();
$stock_id = isset($_GET["id"]) ? $_GET["id"] : null; // short if.
$mat_id = isset($_POST["mat_id"]) ? $_POST["mat_id"] : null; // short if.
$number = isset($_POST["number"]) ? $_POST["number"] : null; // short if.
$mat_name = isset($_POST["mat_name"]) ? $_POST["mat_name"] : null; // short if.
$sup_id = isset($_POST["sup_id"]) ? $_POST["sup_id"] : null; // short if.
$detail = isset($_POST["detail"]) ? $_POST["detail"] : null; // short if.
$status = isset($_POST["status"]) ? $_POST["status"] : null; // short if.
//$admin_id = isset($_POST["admin_id"]) ? $_POST["admin_id"] : null; // short if.
$admin_id = $_SESSION["login_id"];
if ($mat_name != null ) {
    $sql3 = "INSERT INTO material_log (mat_id, number, admin_id, detail, status)
            value('$mat_id','$number','$admin_id','$detail','$status')";
    $query = mysqli_query($conn, $sql3) or die('Die query => ' . mysqli_error($conn));

    $sql2 = "UPDATE material SET mat_name = '$mat_name', sup_id = '$sup_id' WHERE mat_id = $mat_id";
    $query = mysqli_query($conn, $sql2) or die('Die query => ' . mysqli_error($conn));

    $sql1 = "select number from stock WHERE stock_id = $stock_id and mat_id = $mat_id";
    $query1 = mysqli_query($conn, $sql1) or die('Die query => ' . mysqli_error($conn));
    $old_number = mysqli_fetch_assoc($query1);

    if ($status==1) {
      $new_number = $old_number['number'] + $number ;
    }else{
      $new_number = $old_number['number'] - $number ;
    }
    $sql = "UPDATE stock SET number = '$new_number' WHERE stock_id = $stock_id and mat_id = $mat_id";
    $query = mysqli_query($conn, $sql) or die('Die query => ' . mysqli_error($conn));




    header("Location: /suthep/stock.php");
    die();
}
