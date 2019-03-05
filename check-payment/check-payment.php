<?php include '../connect.php'; ?>

<?php 

	date_default_timezone_set('Asia/Bangkok');
	$date = date('d/m/Y-h:i:sa');

	$target = "../paymentPic/" . basename($_FILES['payment_pic']['name']);

	$image = $_FILES['payment_pic']['name'];

	move_uploaded_file($_FILES['payment_pic']['tmp_name'], $target);
	

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

	$stmt=$pdo->prepare("INSERT INTO payment (payment_cartype , payment_plate , payment_username , payment_name , payment_email , payment_phone , payment_address , payment_city , payment_country , payment_zipcode , payment_picName , payment_date ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

	$stmt->bindParam(1,$_POST["payment_cartype"]);
	$stmt->bindParam(2,$_POST["payment_plate"]);
	$stmt->bindParam(3,$_POST["payment_username"]);
	$stmt->bindParam(4,$_POST["payment_name"]);
	$stmt->bindParam(5,$_POST["payment_email"]);
	$stmt->bindParam(6,$_POST["payment_phone"]);
	$stmt->bindParam(7,$_POST["payment_address"]);
	$stmt->bindParam(8,$_POST["payment_city"]);
	$stmt->bindParam(9,$_POST["payment_country"]);
	$stmt->bindParam(10,$_POST["payment_zipcode"]);
	$stmt->bindParam(11,$image);
	$stmt->bindParam(12,$date);

	if($stmt->execute()){
		header("location:../user/index_user.php");
	}else{
		echo "Upload fail back to Home Page";
		echo "<a href='../index.php'";
	}
?>