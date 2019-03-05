<form method="post" enctype="multipart/form-data">
	Select File :
	<input type="file" name="photo_file">
	<input type="submit" value="Upload">
</form>

<?php 
	if ($_FILES) {
		$name = $_FILES["photo_file"]["name"];
		move_uploaded_file($_FILES["photo_file"]["tmp_name"], "Upload/".$name);
	}
?>