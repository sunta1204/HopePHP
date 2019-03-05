<?php
  include "../connect.php";

$stmt1 = $pdo->prepare("SELECT * FROM member");
$stmt1->execute();  

?>
<!DOCTYPE html>
<html>
<head>
	<title>ADMIN INDEX</title>
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
					<thead class="text-primary" style="font-size: 24px;">
						<tr>
							<th>Username</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Address</th>
							<th>City</th>
							<th>Country</th>
							<th>Zip-code</th>
							<th></th>
						</tr>
					</thead>
					<?php while ($row1=$stmt1->fetch()) { ?>
					<tbody style="font-size: 16px; color: #353b48;">
						<tr>
							<td><?=$row1["member_username"] ?></td>
							<td><?=$row1["member_name"] ?></td>
							<td><?=$row1["member_email"] ?></td>
							<td><?=$row1["member_phone"] ?></td>
							<td><?=$row1["member_address"] ?></td>
							<td><?=$row1["member_city"] ?></td>
							<td><?=$row1["member_country"] ?></td>
							<td><?=$row1["member_zipcode"] ?></td>
							<td> 
								<button class="btn btn-warning " data-toggle="modal" data-target="#editMember<?=$row1["member_username"] ?>"><i class="fas fa-user-edit"></i> EDIT  </button>  || 
								<button class="btn btn-danger " data-toggle="modal" data-target="#deleteMember<?=$row1["member_username"] ?>"><i class="fas fa-trash"></i> DELETE  </button> 
							</td>
						</tr>
					</tbody>		
						
					<!-- modal edit -->
					<form action="../check-editMember/check-editMember.php" method="post">
						<div class="modal fade " id="editMember<?=$row1["member_username"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    							<div class="modal-content">
      								<div class="modal-header">
        								<h5 class="modal-title">แก้ไขข้อมูล</h5>
        								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          									<span aria-hidden="true">&times;</span>
        								</button>
      								</div>
      								<div class="modal-body">
      							
        								<div class="form-row">
        									<div class="form-group col-md-8">
        										<label class="text-primary" style="font-size: 20px;"> Username : </label>
        										<input class="form-control" type="text" name="member_username"  placeholder="ชื่อผู้ใช้" required="required" disabled="disabled" value="<?=$row1["member_username"] ?>">
              								</div>
              								<div class="form-group col-md-4">
                          						<label class="text-primary" style="font-size: 20px;"> Status : </label>
                           						<?php if ($_SESSION["member_status"] == 'A') {
                             						echo "<input type='text' name='member_status' placeholder='ผู้ดูแลระบบ' disabled class='form-control' readonly>";
                           						} ?> 

                           						<?php if ($_SESSION["member_status"] == 'U') {
                             					echo "<input type='text' name='member_status' placeholder='สมาชิกทั่วไป' disabled class='form-control' readonly>";
                           						} ?> 
                        					</div>
        								</div>
        								<div class="form-row">
        									<div class="form-group col-md-12">
        										<label class="text-primary" style="font-size: 20px;"> Name : </label>
        										<input class="form-control" type="text" name="member_name" placeholder="ชื่อ - นามสกุล" required="required" value="<?=$row1["member_name"] ?>">
        									</div>
        					
        							</div>
        							<div class="form-row">
        								<div class="form-group col-md-6">
        									<label class="text-primary" style="font-size: 20px;"> Email : </label>
        									<input class="form-control" type="email" name="member_email" placeholder="อีเมลล์" required="required" value="<?=$row1["member_email"] ?>">
        								</div>
        								<div class="form-group col-md-6">
        									<label class="text-primary" style="font-size: 20px;"> Phone Number : </label>
        									<input class="form-control" type="text" name="member_phone" placeholder="เบอร์โทรศัพท์ xxx-xxxxxxx" required="required" pattern="0\d{2}-\d{7}" value="<?=$row1["member_phone"] ?>">
        								</div>
        							</div>     			
        							<div class="form-row">
        								<div class="form-group col-md-12">
        									<label class="text-primary" style="font-size: 20px;"> Address : </label>
        									<textarea class="form-control" name="member_address" placeholder="ที่อยู่"  required="required" > <?=$row1["member_address"] ?> </textarea>
        								</div>      					
        							</div>
        							<div class="form-row">
        								<div class="form-group col-md-5">
        									<label class="text-primary" style="font-size: 20px;"> City : </label>
        									<input class="form-control" type="text" name="member_city" placeholder="อำเภอ / เมือง" required="required" value="<?=$row1["member_city"] ?>">
        								</div>
        								<div class="form-group col-md-4">
        									<label class="text-primary" style="font-size: 20px;"> Country : </label>
        									<input class="form-control" type="text" name="member_country" placeholder="จังหวัด" required="required" value="<?=$row1["member_country"] ?>">
        								</div>
        								<div class="form-group col-md-3">
        									<label class="text-primary" style="font-size: 20px;"> Zip-code : </label>
        									<input class="form-control" type="text" name="member_zipcode" placeholder="รหัสไปรษณีย์" required="required" value="<?=$row1["member_zipcode"] ?>">
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
				<form action="../check-deleteMember/check-deleteMember.php" method="get">
    			<div class="modal fade" id="deleteMember<?=$row1["member_username"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  					<div class="modal-dialog modal-dialog-centered" role="document">
    					<div class="modal-content">
      						<div class="modal-header">
        						<h5 class="modal-title" >Confirm Delete</h5>
        						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          							<span aria-hidden="true">&times;</span>
        						</button>
      						</div>
      						<div class="modal-body">
      							<input type="hidden" name="member_username" value="<?=$row1["member_username"] ?>">	
      							<label style="font-size: 24px;"> คุณแน่ใจหรือไม่ที่จะลบ User : <?=$row1["member_username"] ?> </label>     						
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