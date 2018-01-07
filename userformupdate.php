<?php
// including the database connection file
//error_reporting(0);
include("database/db_conection.php");

$username1 = $_GET['username1'];
//echo "$username1<br/>";
$str = "$username1";
$username2 = base64_decode($str);
//echo "testusername1 : $username2<br/>";

$usermobile1 = $_GET['mobile'];
//echo "$usermobile1<br/>";
$str2 = "$usermobile1";
$usermobile2 = base64_decode($str2);
//echo "testusermobile1: $usermobile2<br/>";

//selecting data associated with this particular id
$result = mysqli_query($dbcon, "SELECT * FROM users WHERE user_name='$username2' AND user_mobile='$usermobile2'");

if(isset($_POST['update']))
{	
	$username = $_POST['username1'];
	//echo "testusername2 :$username<br/>";
	$stra = "$username";
$username2 = base64_decode($stra);

	$mobile = $_POST['mobile'];
	//echo "testusermobile2: $mobile<br/>";
	$str2a = "$mobile";
$usermobile2 = base64_decode($str2a);
	
	$email = $_POST['useremail'];
	
	$userimage1 = $_POST['userimage'];
	//echo "$userimage1<br/>";
	$userpass12 = $_POST['userpass'];
	//echo "userpassword: $userpass12<br/>";
				
		//if(empty($userpass)) 
		//{
			//echo "<font color='red'>userpass field is empty.</font><br/>";
			//} 
	//else {	
		
		$result = mysqli_query($dbcon, "UPDATE users SET user_pass='$userpass12' WHERE user_name='$username2' AND user_mobile='$usermobile2'");
		
		//header("Location: view_users.php");
		 $message="<h4>Dear user,</h4>
	<table style=\"font-family:Verdana, Geneva, sans-serif; font-size: 12px; background:#999999; width:400px; border:none;\">
	<img src=\"http://igxprodus.com/sundarphpwork/userimages/$userimage1\" style=\"height:100px;width:150px;\">
    <tr><td style=\"font-weight:bold; font-variant:small-caps;font-size:16px;\"><center>Password changes</center></td> 
    </tr>
   
    <tr><td align=\"left\" width=\"20%\" style=\"font-weight:bold; font-variant:small-caps;background:#ffffff;\">Password</td> 
    <td align=\"left\" style=\"background:#ffffff;width:60%\">$userpass12</td></tr>
	
    </table><a href=\"http://igxprodus.com/sundarphpwork/userformupdate.php/post.php\">http://igxprodus.com/sundarphpwork/userformupdate.php/post.php</a>"
	;  
        // admin mail
        
        $headers = 'From:'.$email. "\r\n";
		//$headers .= "CC: lamp@helloindiasolutions.com\r\n";
//$headers .= "BCC: slsundar4@gmail.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        //$headers="From: $name<$email>\r\nReturn-path: $email";
        $subject="User Password changes";
        mail($email, $subject, $message, $headers);
        //echo "Email sent!";
    
}

//getting id from url


//selecting data associated with this particular id
$result = mysqli_query($dbcon, "SELECT * FROM users WHERE user_name='$username2' AND user_mobile='$usermobile2'");

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
<body>

<div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
    <div class="row"><!-- row class is used for grid system in Bootstrap-->
        <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit User Details</h3>
                </div>
                <div class="panel-body">
<!--
	<a href="index.php">Home</a> | <a href="view.php">View Products</a> | <a href="logout.php">Logout</a>
	<br/><br/>
	 -->
	
	<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
		
		<fieldset>
		
		 <div class="form-group">
							
							 <img src="userimages/<?php echo $userimage; ?>" style="height:100px;width:150px;">
                            </div>
							
                            <div class="form-group">
							  <input class="form-control" placeholder="Enter Username" name="username" type="text" value="<?php echo $username;?>" disabled readonly>
                            </div>
							
							 <div class="form-group">
							  <input class="form-control" placeholder="Enter Password" name="userpass" type="password" required />
							  
							  <input class="form-control" name="userimage" type="hidden" value="<?php echo $userimage;?>" >
                            </div>
							
							 
							 <div class="form-group">
							  <input class="form-control" placeholder="Enter Email" name="useremail" type="email" value="<?php echo $useremail;?>" >
                            </div>
							
							 <div class="form-group">
							  <input class="form-control" placeholder="Enter Mobile No" name="usermobile" type="text" maxlength="10" value="<?php echo $usermobile;?>" disabled readonly>
                            </div>
							
							
							
							 <div class="form-group">
							 <input type="hidden" name="username1" value=<?php echo $_GET['username1'];?> />
							 <input type="hidden" name="mobile" value=<?php echo $_GET['mobile'];?> />
							 <center>
							 <input type="submit" name="update" value="Update">
							 </center>
                            </div>
							
	</form>
</body>
</html>
