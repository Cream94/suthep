<?php
  require_once 'database/connector.php';
  $email = $_POST["email"];
  $sql = "SELECT * FROM admin WHERE email = '$email' ";
  $query = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($query);
?>

<html>
<body>

  <?php
    $strTo = "$email";
    $strSubject = "แจ้งลืมรหัสผ่าน บริษัท สุเทพ การหล่อ";
    $strHeader = "Form : www.two-friend/suthep.com";
    $strMessage = "รหัสผ่านคุณคือ" . $row["password"];
    $flgSend = @mail($strTo,$strSubject,$strHeader,$strMessage);
    if($flgSend){
      echo "ระบบกำลังทำการส่งอีเมล์...";
    }else {
      echo "ไม่มีอีเมล์ที่คุณต้องการส่ง...";
    }
  ?>
</body>
</html>
