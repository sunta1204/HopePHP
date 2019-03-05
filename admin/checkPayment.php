<?php
  include "../connect.php";

$stmt2 = $pdo->prepare("SELECT * FROM payment");
$stmt2->execute();  

?>
<!DOCTYPE html>
<html>
<head>
	<title>Check Payment</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
</head>
<body>
	<?php include '../navbar/navbarAdmin.php'; ?>

	<div style="display: flex;">
		<div style="height: 775px; width: 300px; background-color: #b2bec3;">
			<div style="margin: 30px; margin-top: 50px;">
				<div class="form-row">
					<a href="checkPayment.php" class="btn btn-info col-md-12"><i class="fas fa-money-check-alt fa-spin" style="font-size: 25px;"></i>  ตรวจสอบยอดแจ้งชำระ </a>
				</div><br>			
				<div class="form-row">
					<a href="../logout/logout.php" class="btn btn-danger col-md-12"><i class="fas fa-sign-out-alt fa-spin" style="font-size: 25px;"></i> ออกจากระบบ </a>
				</div><br>				
			</div>			
		</div>
		<div style="height: 775px; width: 100%; background-color: #dfe6e9;">
			<div style="margin: 50px;">
				<label class="text-primary" style="font-size: 40px;">รายชื่อสมาชิก</label>
				<div id="table-wrapper">
  					<div id="table-scroll">
				<table class="table table-hover">
					<thead class="text-primary" style="font-size: 18px;">
						<tr>
							<th>ชื่อ</th>
							<th>อีเมลล์</th>
							<th>เบอร์</th>
							<th>ที่อยู่</th>
							<th>เมือง</th>
							<th>จังหวัด</th>
							<th>รหัสไปรษณีย์</th>
							<th>ประเภทรถ</th>
							<th>สำเนารถ</th>
							<th>สลิปการโอน</th>
							<th></th>
						</tr>
					</thead>
					<?php while ($row=$stmt2->fetch()) { ?>
					<tbody style="font-size: 14px; color: #353b48;">
						<tr>
							<td><?=$row["payment_name"] ?></td>
							<td><?=$row["payment_email"] ?></td>
							<td><?=$row["payment_phone"] ?></td>
							<td><?=$row["payment_address"] ?></td>
							<td><?=$row["payment_city"] ?></td>
							<td><?=$row["payment_country"] ?></td>
							<td><?=$row["payment_zipcode"] ?></td>
							
							<?php if ($row["payment_cartype"] == "mortorbike") { ?>
								<td>รถจักรยานยนต์</td>
							<?php } elseif ($row["payment_cartype"] == "car") { ?>
								<td>รถยนต์</td>
							<?php } elseif ($row["payment_cartype"] == "truck") { ?>
								<td>รถบรรทุก</td>
							<?php } ?>

							<td><a  data-toggle="modal" data-target="#zoomCar<?=$row['payment_id'] ?>"> <img src="../paymentPic/<?=$row['payment_picName'] ?>" style="width: 150px;" ></a> </td>

							<td><a  data-toggle="modal" data-target="#zoomProof<?=$row['payment_id'] ?>"> <img src="../paymentProof/<?=$row['payment_proof'] ?>" style="width: 150px;" ></a> </td>

							<td> 
								<button class="btn btn-warning " data-toggle="modal" data-target="#editTransport<?=$row['payment_id']?>"><i class="fas fa-user-edit"></i> EDIT  </button>  || 
								<button class="btn btn-danger " data-toggle="modal" data-target="#deleteTransport<?=$row['payment_id'] ?>"><i class="fas fa-trash"></i> DELETE  </button> 
							</td>
						</tr>
					</tbody>	

					<!-- Modal Zoom Car-->
					<div class="modal fade bd-example-modal-lg" id="zoomCar<?=$row['payment_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
  						<div class="modal-dialog modal-lg modal-dialog-centered" role="document"  style="margin-right: auto;margin-left: auto;max-width: 1000px;">
    						<div class="modal-content " style="width: 1500px;text-align: center;">
      							<div class="modal-header">
        							<h5 class="modal-title" id="exampleModalLongTitle" style="font-size: 30px;">สำเนาการจดทะเบียนรถ</h5>
        							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          								<span aria-hidden="true">&times;</span>
       								 </button>
      							</div>
      							<div class="modal-body">
									<img src="../paymentPic/<?=$row['payment_picName'] ?>" style="max-width: 1200px;" >
      							</div>     							
   							 </div>
  						</div>
					</div>	
					
					<!-- Modal Zoom Proof-->
					<div class="modal fade bd-example-modal-lg" id="zoomProof<?=$row['payment_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
  						<div class="modal-dialog modal-lg modal-dialog-centered" role="document"  style="margin-right: auto;margin-left: auto;max-width: 1000px;">
    						<div class="modal-content " style="width: 1500px;text-align: center;">
      							<div class="modal-header">
        							<h5 class="modal-title" id="exampleModalLongTitle" style="font-size: 30px;">หลักฐานการโอนเงิน</h5>
        							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          								<span aria-hidden="true">&times;</span>
       								 </button>
      							</div>
      							<div class="modal-body">
									<img src="../paymentProof/<?=$row['payment_proof'] ?>" style="max-width: 1200px;" >
      							</div>     							
   							 </div>
  						</div>
					</div>



					<!-- modal edit -->
					<form action="editTransprot/editTransprot.php" method="post">
						<div class="modal fade " id="editTransport<?=$row['payment_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    							<div class="modal-content">
      								<div class="modal-header">
        								<h5 class="modal-title" style="font-size: 30px;">แก้ไขข้อมูล</h5>
        								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          									<span aria-hidden="true">&times;</span>
        								</button>
      								</div>
      								<div class="modal-body">
      									<input type="hidden" name="payment_id" value="<?=$row['payment_id']?>">
      									<div class="form-row">
      										<div class="form-group col-md-6">
      											<label class="text-primary" style="font-size: 20px;" > ชำระยอด</label>
      											<?php if ($row["payment_status"] == "U") { ?>
      												<select class="form-control" name="payment_status">
      													<option value="U">ยังไม่ชำระ</option>
      													<option value="P">ชำระแล้ว</option>     												
    												</select>
      											<?php } ?>
      											 	
												<?php if ($row["payment_status"] == "P") { ?>
      												 <select class="form-control" name="payment_status">
      													<option value="P">ชำระแล้ว</option>  
      													<option value="U">ยังไม่ชำระ</option>     												   												
    												</select>
    											<?php } ?>			
      										</div> 
      											<div class="form-group col-md-6">
      											<label class="text-primary" style="font-size: 20px;"> การจัดส่งเอกสาร </label>
      											<?php if ($row["transport_status"] == "N") { ?>
      												<select class="form-control" name="transport_status">
      													<option value="N">ยังไม่จัดส่ง</option>
      													<option value="D">จัดส่งแล้ว</option>     												
    												</select>
      											<?php } ?>
      											 	
												<?php if ($row["transport_status"] == "D") { ?>
      												 <select class="form-control" name="transport_status">
      													<option value="D">จัดส่งแล้ว</option>  
      													<option value="N">ยังไม่จัดส่ง</option>     												   												
    												</select>
      											<?php } ?> 					
      										</div>   												  										
      									</div>
      									<div class="form-row">
      										<div class="form-group col-md-12">
      											<label class="text-primary" style="font-size: 20px;"> เลขที่พัสดุ </label>
      											<input type="text" name="payment_track" placeholder="เลขที่พัสดุ" class="form-control">
      										</div>
      									</div>
        							</div>
      							<div class="modal-footer">
        							<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
        							<button type="submit" class="btn btn-primary"><i class="fas fa-location-arrow"></i> Save</button>
      							</div>   			
    						</div>
  						</div>
					</div>
				</form>		

				<!-- modal Delete-->
				<form action="deletePayment/deletePayment.php" method="post">
    			<div class="modal fade" id="deleteTransport<?=$row['payment_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  					<div class="modal-dialog modal-dialog-centered" role="document">
    					<div class="modal-content">
      						<div class="modal-header">
        						<h5 class="modal-title" >Confirm Delete</h5>
        						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          							<span aria-hidden="true">&times;</span>
        						</button>
      						</div>
      						<div class="modal-body">	
      							<label style="font-size: 24px;"> คุณแน่ใจหรือไม่ที่จะลบ การแจ้งชำระ ของคุณ : <?=$row['payment_name']?> </label> 
      							<input type="hidden" name="payment_id" value="<?=$row['payment_id']?>">

        					</div>
      						<div class="modal-footer">
        						<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
        						<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete </button>
      						</div>   			
    					</div>
  					</div>
				</div>
			</form>						
											
				<?php } ?>
				</table>
				</div>
				</div>			
				
					<div class="form-row">
						<input type="text" name="key" value="" class="form-control col-2 mx-sm-2">
						<button type="submit" class="btn btn-outline-primary">Search</button>
					</div>	
				</form>
			</div>			
		</div>
	</div>


	<?php include '../footer/footer.html'; ?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>