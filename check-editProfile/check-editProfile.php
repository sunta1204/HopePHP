<?php
	include "../connect.php";
	
$stmt=$pdo->prepare("UPDATE member SET member_password = ? , member_name = ? , member_email = ? , member_phone = ? , member_address = ? , member_city = ? , member_country = ? , member_zipcode = ?  WHERE member_username = ?");

$stmt->bindParam(1,$_POST["member_password"]);
$stmt->bindParam(2,$_POST["member_name"]);
$stmt->bindParam(3,$_POST["member_email"]);
$stmt->bindParam(4,$_POST["member_phone"]);
$stmt->bindParam(5,$_POST["member_address"]);
$stmt->bindParam(6,$_POST["member_city"]);
$stmt->bindParam(7,$_POST["member_country"]);
$stmt->bindParam(8,$_POST["member_zipcode"]);
$stmt->bindParam(9,$_POST["member_username"]);

if($stmt->execute()){
	echo "แก้ไขข้อมูลส่วนตัวสำเร็จ " ;
	echo "<a href='../admin/index_admin.php>กลับสู่หน้าหลัก</a>";
}else{
	echo "แก้ไขข้อมูลส่วนตัวไม่สำเร็จ" ;
	echo "<a href='../admin/index_admin.php></a>'";
}
?>