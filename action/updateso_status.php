<?php
require_once '../database/connector.php';
$so_id = isset($_GET["so_id"]) ? $_GET["so_id"] : null; // short if.
$status = isset($_POST["status_id"]) ? $_POST["status_id"] : null; // short if.

if ($status != null) {
  $sql = "UPDATE sale_order SET status =  $status WHERE so_id = $so_id ";
  $query = mysqli_query($conn, $sql) or die('Die query => ' . mysqli_error($conn));

  if ($status == 2 || $status == 5) {
    $sqlSMS = "SELECT * FROM sale_order so, customer c WHERE so.cust_id = c.cust_id and so.so_id = $so_id group by so.so_id";
    $querySMS = mysqli_query($conn, $sqlSMS);
    $row = mysqli_fetch_assoc($querySMS);

    // send SMS from THSMS.com
    $username = "icream";
    $password = "0655fd";
    $telephone = $row["cust_tel"];
    $message = urlencode("บริษัท สุเทพการหล่อ ทำการจัดส่งออเดอร์เลขที่ " . $row["so_id"]. " ให้กับคุณแล้ว");
    $url = "http://www.thsms.com/api/rest?method=send&username=$username&password=$password&from=NOTICE&to=$telephone&message=$message";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_exec($ch);
    curl_close($ch);
  }
}
 ?>
