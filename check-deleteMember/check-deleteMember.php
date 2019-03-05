<?php include '../connect.php'; ?>
<?php 

	$stmt = $pdo->prepare("DELETE FROM member WHERE member_username=?"); 
	$stmt->bindParam(1, $_GET["member_username"]);

	if ($stmt->execute())  
		header("location: ../admin/index_admin.php");
?>