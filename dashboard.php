<?php

// We need to use sessions, so you should always start sessions using the below code.
require_once("../config/config.php");
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
 error_reporting( ~E_NOTICE ); // avoid notice
 
 if(isset($_POST['btnsave']))
 {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $type = $_POST['type'];
  $cost = $_POST['cost'];
  $filename = $_FILES["img"]["name"];
  $tempname = $_FILES["img"]["tmp_name"];    
  $folder = "../image/".$filename;
  
  $sql = "INSERT INTO tbl_hotels (name,description,type,img,cost) VALUES ('$name','$description','$type','$filename','$cost')";
  mysqli_query($con,$sql);
  
  // Now let's move the uploaded image into the folder: image
  if (move_uploaded_file($tempname, $folder))  {
     $msg = "Image uploaded successfully";
   }else{
      $msg = "Failed to upload image";
   }
 }
 $result = mysqli_query($con, "SELECT * FROM image");
 while($data = mysqli_fetch_array($result))
 {
   
       ?>
 <img src="<?php echo $data['Filename']; ?>">
   
 <?php
 }
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Admin dashboard - Online Hotel Management</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/style.css">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="css/dashboard.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1><a href="../index.php">OHMS</a></h1>
				<a href="dashboard.php"><i class="fas fa-user-circle"></i>Add new hotels</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
			<p>Welcome back, <?=$_SESSION['name']?>!</p>
			<form method="post" enctype="multipart/form-data" class="form-horizontal">
				<table class="table table-bordered table-responsive"><tr>
					<td><label class="control-label">Name</label></td>
					<td><input class="form-control" type="text" name="name" placeholder="Hotel Name" value="<?php echo $name; ?>" /></td>
				</tr>
				<tr>
					<td><label class="control-label">Description</label></td>
					<td><input class="form-control" type="text" name="description" placeholder="Description" value="<?php echo $description; ?>" /></td>
				</tr>
				<tr>
					<td><label class="control-label">Accomodation Type</label></td>
					<td><input class="form-control" type="text" name="type" placeholder="Accomodation Type" value="<?php echo $type; ?>" /></td>
				</tr>
				<tr>
					<td><label class="control-label">Cost per day</label></td>
					<td><input class="form-control" type="text" name="cost" placeholder="Cost per day" value="<?php echo $cost; ?>" /></td>
				</tr>
				<tr>
					<td><label class="control-label">Image</label></td>
					<td><input class="input-group" type="file" name="img" accept="image/*" /></td>
				</tr>
				<tr>
					<td colspan="2"><button type="submit" name="btnsave" class="btn btn-default" style="padding-left: 50%">
						<span class="fas fa-save"></span> &nbsp; save</button></td>
				</tr></table>
			</form>
		</div>
    </body>
</html>