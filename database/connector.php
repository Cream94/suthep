<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "suthep";

// create connection.
$conn = mysqli_connect($servername, $username, $password, $suthep);

// check connection.
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (!mysqli_select_db($conn, $dbname)) {
    die("Uh oh, couldn't select database $dbname");
}

?>
