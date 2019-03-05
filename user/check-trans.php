<?php 
	include '../connect.php';	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Check Transport</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
</head>
<body>

	<?php include '../navbar/navbarUser.php'; ?>
	<?php 
		$stmt3 = $pdo->prepare("SELECT * FROM payment WHERE payment_cartype = ? AND payment_name = ? AND payment_plate = ? ");
		$stmt3->bindParam(1,$_POST["payment_cartype"]);
		$stmt3->bindParam(2,$_POST["payment_name"]);
		$stmt3->bindParam(3,$_POST["payment_plate"]);
		$stmt3->execute();
	?>
	<div style="margin-left: auto; margin-right: auto; width: 1500px; margin-top: 50px; height: 725px;">
		<table class="table table-hover">
  			<thead class="text-primary" style="font-size: 24px;">
    			<tr>
      				<th>ชื่อ</th>
     				<th>ประเภทรถ</th>
     				<th>ป้ายทะเบียนรถ</th>
      				<th>สำเนาการจดทะเบียนรถ</th>
      				<th>หลักฐานการโอนเงิน</th>
      				<th>แจ้งชำระ</th>
      				<th>การจัดส่ง</th>
      				<th>เลขที่พัสดุ</th>
    			</tr>
  			</thead>

  			<?php while ($row3=$stmt3->fetch()) { ?>
  			<tbody style="font-size: 18px;">
    			<tr>
      				<td><?= $row3["payment_name"] ?></td>
      				<?php 
      					if ($row3["payment_cartype"] == 'mortorbike') { ?>
      						<td>รถจักรยานยนต์</td>
      					<?php } elseif ($row3["payment_cartype"] == 'car') { ?>
      						<td>รถยนต์</td>
      					<?php }  elseif ($row3["payment_cartype"] == 'truck') { ?>
      						<td>รถบรรทุก</td>
      					<?php } ?> 		
      				<td><?= $row3["payment_plate"] ?></td>
      				<td><img src="../paymentPic/<?=$row3['payment_picName']?>" style="max-width: 200px;" ></td>
      				<td><img src="../paymentProof/<?=$row3['payment_proof']?>" style="max-width: 200px;" ></td>

      				<?php 
      					if ($row3["payment_status"] == 'U') { ?>
      						<td>รอดำเนินการ</td>
      					<?php } elseif ($row3["payment_status"] == 'P') { ?>
      						<td>ชำระเงินแล้ว</td>
      					<?php } ?>
					
					<?php 
      					if ($row3["transport_status"] == 'N') { ?>
      						<td>ยังไม่จัดส่ง</td>
      					<?php } elseif ($row3["transport_status"] == 'D') { ?>
      						<td>จัดส่งแล้ว</td>     					
      					<?php } ?> 		
      				<?php if ($row3["payment_track"] == NULL) { ?>
      					<td>รอดำเนินการ</td>
      					<?php } elseif ($row3["payment_track"] != NULL) { ?>
      						<td><?=$row3["payment_track"] ?></td>
      					<?php } ?>
    		</tbody>
    		<?php  } ?>
		</table><br>
		<a href="index_user.php" class="btn btn-outline-primary btn-block btn-lg"> กลับสู่หน้าหลัก </a>
	</div>

	<?php include '../user/footer/footer.html'; ?>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>