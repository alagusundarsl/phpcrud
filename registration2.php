<?php
//session_start();
if(isset($_POST['submit']) && !empty($_POST['submit']))
{
$username=$_POST['username'];
$email=$_POST['email'];
$userpassword=$_POST['pass'];
$mobile=$_POST['mobileno'];
if(!empty($_FILES['cate_img']['name']))
{
$uploaddir = 'userimages/';
$uploadfile = $uploaddir . basename($_FILES['cate_img']['name']);
echo '<pre>';
if (move_uploaded_file($_FILES['cate_img']['tmp_name'], $uploadfile)) {
   // echo "File is valid, and was successfully uploaded.\n";
} else {
  //  echo "Possible file upload attack!\n";
}
$userimage1=$_FILES['cate_img']['name'];

			}
			
			 $check_email_query="select * from users WHERE user_email='$email'";
    $run_query=mysqli_query($dbcon,$check_email_query);

    if(mysqli_num_rows($run_query)>0)
    {
echo "<script>alert('Email $user_email is already exist in our database, Please try another one!')</script>";
exit();
    }
//insert the user into the database.
    $insert_user="insert into users (user_name,user_pass,user_email,user_mobile,userimage) VALUE ('$username','$userpassword','$email','$mobile','$userimage1')";
	
    $message="<h4>Dear user,</h4>
	<table style=\"font-family:Verdana, Geneva, sans-serif; font-size: 12px; background:#999999; width:500px; border:none;\">
    <tr><td colspan=\"2\" style=\"font-weight:bold; font-variant:small-caps;background:lightblue;font-size:16px;\"><center>Infogenx Admin Enquiry</center></td> 
    </tr>
    <tr><td align=\"left\" width=\"20%\" style=\"font-weight:bold; font-variant:small-caps;background:#ffffff;\">NAME</td> 
    <td align=\"left\" style=\"background:#ffffff;width:60%\">$username</td></tr>
    <tr><td align=\"left\" width=\"20%\" style=\"font-weight:bold; font-variant:small-caps;background:#ffffff;\">EMAIL</td> 
    <td align=\"left\" style=\"background:#ffffff;width:60%\">$email</td></tr>
	<tr><td align=\"left\" width=\"20%\" style=\"font-weight:bold; font-variant:small-caps;background:#ffffff;\">MOBILE</td> 
    <td align=\"left\" style=\"background:#ffffff;width:60%\">$mobile</td></tr>
    <tr><td align=\"left\" width=\"20%\" style=\"font-weight:bold; font-variant:small-caps;background:#ffffff;\">Password</td> 
    <td align=\"left\" style=\"background:#ffffff;width:60%\">$userpassword</td></tr>
    
    <tr><td align=\"left\" width=\"20%\" style=\"font-weight:bold; font-variant:small-caps;background:#ffffff;\">Imge</td> 
    <td align=\"left\" style=\"background:#ffffff;width:60%\">
	<img src=\"http://igxprodus.com/sundarphpwork/userimages/$userimage1\" style=\"height:100px;width:150px;\">
	</td></tr></table>
    <a href=\"http://igxprodus.com/sundarphpwork/userformupdate.php?name='$username'&mobile='$mobile'\">Userformupdate</a>
    ";  
        // admin mail
        
        $headers = 'From:'.$email. "\r\n";
		//$headers .= "CC: lamp@helloindiasolutions.com\r\n";
//$headers .= "BCC: slsundar4@gmail.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        //$headers="From: $name<$email>\r\nReturn-path: $email";
        $subject="infogenx - Client Enquiry";
        mail('slsundar4@gmail.com', $subject, $message, $headers);
        //echo "Email sent!";
        
        // client mail
        
        //$email_subject = "CanterCadd Training Institute person will Contact you soon ";
        $email_subject = "Thanks for contacting us - infogenx	";
        $headers1 = 'From: infogenx<slsundar4@gmail.com>' . "\r\n";
        $headers1 .= "MIME-Version: 1.0\r\n";
        $headers1 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $rplymsg='We Will reach you soon\r\nWith Regrads,</br>infogenx \r\n<p>This is auto Generated Email From infogenx</p>';
        $rplymsg .= "</body></html>";
         
        mail($email,$email_subject,$rplymsg,$headers1); // auto  reply mail to sender
        if(mail)
        {
           echo '<script type="text/javascript">alert("Thank you for contacting us. We will be in touch with you very soon.")</script>';  
			
			header('Location: '.$_SERVER['REQUEST_URI']);
        }
else{
            //$errMsg = 'Captcha code not matched, please try again.';
			echo '<script language="javascript">';
echo 'alert("error")';
echo '</script>';
        }		
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
                    <h3 class="panel-title">Registration</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                            </div>

                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="pass" type="password" value="">
                            </div>
							
							<div class="form-group">
							
                                <input class="form-control" placeholder="Upload Image" type="file" name="cate_img">
                            </div>
							
							 <div class="form-group">
                                <input class="form-control" placeholder="Mobile No" name="mobileno" type="text" maxlength="10" autofocus>
                            </div>


                            <input class="btn btn-lg btn-success btn-block" type="submit" value="register" name="submit" >

                        </fieldset>
                    </form>
                    <center><b>Already registered ?</b> <br></b><a href="login.php">Login here</a></center><!--for centered text-->
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
