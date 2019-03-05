<?php include '../connect.php'; ?>

<?php 

	date_default_timezone_set('Asia/Bangkok');
	$date = date('d/m/Y-h:i:sa');

	$target = "../paymentProof/" . basename($_FILES['proof_file']['name']);

	$image = $_FILES['proof_file']['name'];

	move_uploaded_file($_FILES['proof_file']['tmp_name'], $target);
	

	//$expfile = explode(".", $_FILES["payment_pic"]["name"]);

	//$newfilename = round(microtime(true)) . '.' . end($expfile);

	//$filename = $_POST["payment_picName"] . $_POST["payment_cartype"] . $_POST["payment_plate"];

	//if (is_uploaded_file($_FILES["payment_pic"]["tmp_name"])) {
	//	move_uploaded_file($_FILES["payment_pic"]["tmp_name"], "../paymentPic/" . $filename . "." . $newfilename);
	//}

	//$name = $_FILES['payment_picName']['name'];
	//$unicode = iconv('UTF-8', 'UTF-8', $name);
	//move_uploaded_file($_FILES['payment_picName']['tmp_name'], '../paymentPic/' . $unicode);

	//$temp = explode(".", $_FILES["payment_picName"]["name"]);

	//$newfilename = round(microtime(true)) . '.' . end($temp);

	//($_FILES["payment_picName"]["tmp_name"], "../paymentPic/" . $newfilename);

	$stmt=$pdo->prepare("UPDATE payment SET payment_proof = ? WHERE payment_cartype = ? AND payment_plate = ? AND payment_name = ?");

	$stmt->bindParam(1,$image);
	$stmt->bindParam(2,$_POST["payment_cartype"]);
	$stmt->bindParam(3,$_POST["payment_plate"]);
	$stmt->bindParam(4,$_POST["payment_name"]);

	if($stmt->execute()){
		header("location:../user/index_user.php");
	}else{
		echo "Upload fail back to Home Page";
		echo "<a href='../index.php'";
	}
?>