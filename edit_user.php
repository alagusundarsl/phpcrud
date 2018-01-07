<?php 
/*
session_start(); 
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
*/
?>

<?php
// including the database connection file
error_reporting(0);
include("database/db_conection.php");

if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	
	$username = $_POST['username'];
	$userpass = $_POST['userpass'];
	$useremail = $_POST['useremail'];
	$usermobile = $_POST['usermobile'];
	
	if(!empty($_FILES['cate_img']['name']))
			{
			
				$uploaddir = 'userimages/';
$uploadfile = $uploaddir . basename($_FILES['cate_img']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['cate_img']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}
$userimage1=$_FILES['cate_img']['name'];

			}
			
	
	//$userimage = $_POST['userimage'];	
	
	// checking empty fields
	if(empty($username) || empty($userpass) || empty($useremail) || empty($usermobile)) {
				
		if(empty($username)) {
			echo "<font color='red'>username field is empty.</font><br/>";
		}
		
		if(empty($userpass)) {
			echo "<font color='red'>userpass field is empty.</font><br/>";
		}
		
		if(empty($useremail)) {
			echo "<font color='red'>useremail field is empty.</font><br/>";
		}

if(empty($usermobile)) {
			echo "<font color='red'>usermobile field is empty.</font><br/>";
		}		
	} else {	
		//updating the table
		$result = mysqli_query($dbcon, "UPDATE users SET user_name='$username',user_pass='$userpass',user_email='$useremail',user_mobile='$usermobile', userimage='$userimage1' WHERE id=$id");
		
		//redirectig to the display page. In our case, it is view.php
		header("Location: view_users.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($dbcon, "SELECT * FROM users WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$username = $res['user_name'];
	$userpass = $res['user_pass'];
	$useremail = $res['user_email'];
	$usermobile = $res['user_mobile'];
	$userimage = $res['userimage'];
}
?>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css">
    <title>Registration</title>
</head>
<style>
    .login-panel {
        margin-top: 150px;

</style>
<body>

<div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
    <div class="row"><!-- row class is used for grid system in Bootstrap-->
        <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Details</h3>
                </div>
                <div class="panel-body">
<!--
	<a href="index.php">Home</a> | <a href="view.php">View Products</a> | <a href="logout.php">Logout</a>
	<br/><br/>
	 -->
	
	<form name="form1" method="post" action="edit_user.php" enctype="multipart/form-data">
		
		<fieldset>
                            <div class="form-group">
							  <input class="form-control" placeholder="Enter Username" name="username" type="text" value="<?php echo $username;?>" autofocus>
                            </div>
							
							 <div class="form-group">
							  <input class="form-control" placeholder="Enter Password" name="userpass" type="text" value="<?php echo $userpass;?>" autofocus>
                            </div>
							
							 <div class="form-group">
							  <input class="form-control" placeholder="Enter Email" name="useremail" type="email" value="<?php echo $useremail;?>" autofocus>
                            </div>
							
							 <div class="form-group">
							  <input class="form-control" placeholder="Enter Mobile No" name="usermobile" type="text" maxlength="10" value="<?php echo $usermobile;?>" autofocus>
                            </div>
							
							 <div class="form-group">
							 <label>Previous Image</label>
							 <img src="userimages/<?php echo $userimage; ?>" style="height:100px;width:150px;">
                            </div>
							
							 <div class="form-group">
							 <label>Upload Image</label>
							 <input type="file" name="cate_img" class="form-control">
                            </div>
							
							 <div class="form-group">
							 <input type="hidden" name="id" value=<?php echo $_GET['id'];?> />
							 <input type="submit" name="update" value="Update">
                            </div>
							<!--
		<table border="0">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="username" value="<?php //echo $username;?>"></td>
			</tr>
			<tr> 
				<td>Pasword</td>
				<td><input type="password" name="userpass" value="<?php //echo $userpass;?>"></td>
			</tr>
			<tr> 
				<td>Email</td>
				<td><input type="text" name="useremail" value="<?php //echo $useremail;?>"></td>
			</tr>
			<tr> 
				<td>Mobile</td>
				<td><input type="text" name="usermobile" value="<?php //echo $usermobile;?>"></td>
			</tr>
			<tr> 
				<td>Previous Image</td>
				<td>
				<img src="userimages/<?php //echo $userimage; ?>" style="height:100px;width:150px;"><br/>
				</td>
				</tr>
				<tr>
				<td>New Image</td>
				<td><input type="file" name="userimage">
				
				</td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table> -->
	</form>
</body>
</html>
