<?php
	include "../connect.php";
	
$stmt=$pdo->prepare("INSERT INTO member (member_username,member_password ,member_name  ,member_email ,member_phone ,member_address ,member_city , member_country , member_zipcode) VALUES (?, ?,?,?,?,?,?,?,?)");

$stmt->bindParam(1,$_POST["member_username"]);
$stmt->bindParam(2,$_POST["member_password"]);
$stmt->bindParam(3,$_POST["member_name"]);
$stmt->bindParam(4,$_POST["member_email"]);
$stmt->bindParam(5,$_POST["member_phone"]);
$stmt->bindParam(6,$_POST["member_address"]);
$stmt->bindParam(7,$_POST["member_city"]);
$stmt->bindParam(8,$_POST["member_country"]);
$stmt->bindParam(9,$_POST["member_zipcode"]);


if($stmt->execute()){
	header("location:../index.php");
}else{
	echo "register fail back to Home Page";
	echo "<a href='../index.php'";
}
?>