<?php
  include "../connect.php";
  
  session_start();

  $stmt = $pdo->prepare("SELECT * FROM member WHERE member_username = ? AND member_password = ?");
  $stmt->bindParam(1, $_POST["member_username"]);
  $stmt->bindParam(2, $_POST["member_password"]);
  $stmt->execute();
  $row = $stmt->fetch();
	
  // หาก username และ password ตรงกัน จะมีข้อมูลในตัวแปร $row
  if (!empty($row)) { 
    // นำข้อมูลผู้ใช้จากฐานข้อมูลเขียนลง session 2 ค่า
    $_SESSION["member_id"] = $row["member_id"];
    $_SESSION["member_username"] = $row["member_username"];
    $_SESSION["member_name"] = $row["member_name"];
	 $_SESSION["member_email"] = $row["member_email"]; 
	 $_SESSION["member_phone"] = $row["member_phone"]; 
	 $_SESSION["member_address"] = $row["member_address"]; 
	 $_SESSION["member_city"] = $row["member_city"]; 
	 $_SESSION["member_country"] = $row["member_country"]; 
	 $_SESSION["member_zipcode"] = $row["member_zipcode"];
	 $_SESSION["member_status"] = $row["member_status"]; 
	  
    session_write_close();
    if($row["member_status"] == 'A'){
        header("location:../admin/index_admin.php");
      }else{
        header("location:../user/index_user.php");
      }
  } else {
    header("localtion: ../index.php");
  }
?>