<?php
  include "../connect.php";

  session_start();

  if (empty($_SESSION["member_username"])) {
    header("location: ../index.php");
}

$user = $_SESSION["member_username"];
$stmt = $pdo->prepare("SELECT * FROM member WHERE member_username = '$user'");
$stmt->execute(); 
$stmt1 = $pdo->prepare("SELECT * FROM member");
$stmt1->execute();  

?>

  <nav class="navbar navbar-expand-lg   navbar-light " style="background-color: #7f8c8d;">
  <a class="navbar-brand" style="font-size: 24px; color: #ffffff;" href="/"> โฮปประกันภัย </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="nav navbar-nav mr-auto">
    
    </ul>
    <ul class="nav navbar-nav mr-right"> 
     <li class="nav-item dropdown " >
    <button style="width: 180px; color: #ffffff; font-size: 20px;" class="nav-link hoverborder btn btn-outline-dark mx-sm-2 "  id="navbarDropdown" style="color: #ffffff;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-target="#dropdown-user" ><i class="far fa-user-circle" style="font-size: 26px;"></i>  <?=$_SESSION["member_name"]?>  <i class="fas fa-chevron-down"></i></button>
  <div class="dropdown-menu" id="dropdown-user">
    <button class="dropdown-item" data-toggle="modal" data-target="#showProfile">ดูข้อมูลส่วนตัว</button>
          <button class="dropdown-item" data-toggle="modal" data-target="#editProfile">แก้ไขข้อมูลส่วนตัว</button>
          <a class="dropdown-item" href="../logout/logout.php">ออกจากระบบ</a>
    </div>
      </li>
      </ul>
              
              <?php while ($row=$stmt->fetch()) { ?>
              <!-- modal showProfile -->
            <div class="modal fade " id="showProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" style="font-size: 30px;">ข้อมูลส่วนตัว</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label class="text-primary" style="font-size: 20px;"> Username : </label>
                            <input class="form-control" type="text" name="member_username" disabled="disabled" value="<?=$_SESSION['member_username'] ?>">
                          </div>
                          <div class="form-group col-md-6">
                            <label class="text-primary" style="font-size: 20px;"> Password : </label>
                            <input class="form-control" type="text" name="member_password" disabled="disabled"  value="<?=$row["member_password"]?>">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-12">
                            <label class="text-primary" style="font-size: 20px;"> Name : </label>
                            <input class="form-control" type="text" name="member_name" disabled="disabled" value="<?=$row["member_name"]?>">
                          </div>
        
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label class="text-primary" style="font-size: 20px;"> Email : </label>
                          <input class="form-control" type="email" name="member_email" disabled="disabled" value="<?=$row["member_email"]?>">
                        </div>
                        <div class="form-group col-md-6">
                          <label class="text-primary" style="font-size: 20px;"> Phone Number : </label>
                          <input class="form-control" type="text" name="member_phone" disabled="disabled" value="<?=$row["member_phone"]?>">
                        </div>
                      </div>          
                      <div class="form-row">
                        <div class="form-group col-md-8">
                          <label class="text-primary" style="font-size: 20px;"> Address : </label>
                          <textarea class="form-control" name="member_address"  disabled="disabled"> <?=$row["member_address"]?> </textarea>
                        </div>
                        <div class="form-group col-md-4">
                          <label class="text-primary" style="font-size: 20px;"> Status : </label>
                           <?php if ($_SESSION["member_status"] == 'A') {
                             echo "<input type='text' name='member_status' placeholder='ผู้ดูแลระบบ' disabled class='form-control'>";
                           } ?> 

                           <?php if ($_SESSION["member_status"] == 'U') {
                             echo "<input type='text' name='member_status' placeholder='สมาชิกทั่วไป' disabled class='form-control'>";
                           } ?> 
                        </div>                
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-5">
                          <label class="text-primary" style="font-size: 20px;"> City : </label>
                          <input class="form-control" type="text" name="member_city" disabled="disabled" value="<?=$row["member_city"]?>">
                        </div>
                        <div class="form-group col-md-4">
                          <label class="text-primary" style="font-size: 20px;"> Country : </label>
                          <input class="form-control" type="text" name="member_country" disabled="disabled" value="<?=$row["member_country"]?>">
                        </div>
                        <div class="form-group col-md-3">
                          <label class="text-primary" style="font-size: 20px;"> Zip-code : </label>
                          <input class="form-control" type="text" name="member_zipcode" disabled="disabled" value="<?=$row["member_zipcode"]?>">
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                    </div>        
                </div>
              </div>
          </div>

            <!-- modal editProfile -->
          <form action="../check-editProfile/check-editProfile.php" method="post">
            <div class="modal fade " id="editProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" style="font-size: 30px;">แก้ไขข้อมูล</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label class="text-primary" style="font-size: 20px;"> Username : </label>
                            <input class="form-control" type="text" name="member_username" placeholder="ชื่อผู้ใช้" required="required" value="<?=$row["member_username"]?>" readonly>
                          </div>
                          <div class="form-group col-md-6">
                            <label class="text-primary" style="font-size: 20px;"> Password : </label>
                            <input class="form-control" type="text" name="member_password" placeholder="รหัสผ่าน" required="required" value="<?=$row["member_password"]?>">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-12">
                            <label class="text-primary" style="font-size: 20px;"> Name : </label>
                            <input class="form-control" type="text" name="member_name" placeholder="ชื่อ นามสกุล" required="required" value="<?=$row["member_name"]?>">
                          </div>
            
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label class="text-primary" style="font-size: 20px;"> Email : </label>
                          <input class="form-control" type="email" name="member_email" placeholder="อีเมลล์" required="required" value="<?=$row["member_email"]?>">
                        </div>
                        <div class="form-group col-md-6">
                          <label class="text-primary" style="font-size: 20px;"> Phone Number : </label>
                          <input class="form-control" type="text" name="member_phone" placeholder="เบอร์โทรศัพท์ xxx-xxxxxxx" required="required" pattern="0\d{2}-\d{7}" value="<?=$row["member_phone"]?>">
                        </div>
                      </div>          
                      <div class="form-row">
                        <div class="form-group col-md-12">
                          <label class="text-primary" style="font-size: 20px;"> Address : </label>
                          <textarea class="form-control" name="member_address" id="member_address" placeholder="ที่อยู่"  required="required" > <?=$row["member_address"]?> </textarea>
                        </div>                
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-5">
                          <label class="text-primary" style="font-size: 20px;"> City : </label>
                          <input class="form-control" type="text" name="member_city" placeholder="อำเภอ / เมือง" required="required" value="<?=$row["member_city"]?>">
                        </div>
                        <div class="form-group col-md-4">
                          <label class="text-primary" style="font-size: 20px;"> Country : </label>
                          <input class="form-control" type="text" name="member_country" placeholder="จังหวัด" required="required" value="<?=$row["member_country"]?>">
                        </div>
                        <div class="form-group col-md-3">
                          <label class="text-primary" style="font-size: 20px;"> Zip-code : </label>
                          <input class="form-control" type="text" name="member_zipcode" placeholder="รหัสไปรษณีย์" required="required" value="<?=$row["member_zipcode"]?>">
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
        <?php } ?>
  </div>
</nav>


