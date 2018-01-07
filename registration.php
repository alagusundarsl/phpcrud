
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
                    <form role="form" method="post" action="registration.php" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="name" type="text" autofocus>
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


                            <input class="btn btn-lg btn-success btn-block" type="submit" value="register" name="register" >

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

<?php

include("database/db_conection.php");//make connection here
if(isset($_POST['register']))
{
    $user_name=$_POST['name'];//here getting result from the post array after submitting the form.
    $user_pass=$_POST['pass'];//same
    $user_email=$_POST['email'];//same
$mobileno1=$_POST['mobileno'];

    if($user_name=='')
    {
        //javascript use for input checking
        echo"<script>alert('Please enter the name')</script>";
exit();//this use if first is not work then other will not show
    }

    if($user_pass=='')
    {
        echo"<script>alert('Please enter the password')</script>";
exit();
    }

    if($user_email=='')
    {
        echo"<script>alert('Please enter the email')</script>";
    exit();
    }
	
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
	
//here query check weather if user already registered so can't register again.
    $check_email_query="select * from users WHERE user_email='$user_email'";
    $run_query=mysqli_query($dbcon,$check_email_query);

    if(mysqli_num_rows($run_query)>0)
    {
echo "<script>alert('Email $user_email is already exist in our database, Please try another one!')</script>";
exit();
    }
//insert the user into the database.
    $insert_user="insert into users (user_name,user_pass,user_email,user_mobile,userimage) VALUE ('$user_name','$user_pass','$user_email','$mobileno1','$userimage1')";
	
	$email_to = "sundarsl1991@gmail.com";
 $headers = 'From:'.$email. "\r\n";
		$headers .= "CC: slsundar4@gmail.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $message = '<html><body>';
        $message .= "<table  style=\"font-family:Verdana, Geneva, sans-serif; font-size: 12px; background:#e9e6f4; width:500px; border:none;\" cellpadding=\"4\" cellspacing=\"1\">";
        $message .= "<center><tr><td align=\"center\" style=\"font-weight:bold; font-variant:small-caps; background:#e9e6f4;\"> <img src=\"images/helloindia-logo.png\"></td></tr></center><tr><td align=\"left\" colspan=\"2\" style=\"font-weight:bold; font-variant:small-caps; background:#e9e6f4;\"> <center>Hello India Solutions Corporate Brochure Download Enquiry </center></td></tr>";
        $message .= "<tr><td align=\"left\" width=\"30%\" style=\"font-weight:bold; font-variant:small-caps;background:#ffffff;\">Name</td> <td align=\"left\" style=\"background:#ffffff;\">$user_name</td></tr>";
        $message .= "<tr><td align=\"left\" width=\"30%\" style=\"font-weight:bold; font-variant:small-caps; background:#ffffff;\">Message</td><td align=\"left\" style=\"background:#ffffff;\">$msg</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";
        
        // Clients mail
        $email_subject = "Thanks for the Enquiry - Infogenx ";        
        $headers1 = 'From: infogenx<slsundar4@gmail.com>' . "\r\n";
        $headers1 .= "MIME-Version: 1.0\r\n";
        $headers1 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $rplymsg = '<html><body>';
        $rplymsg .= "<table  style=\"font-family:Verdana, Geneva, sans-serif; font-size: 12px; background:#e9e6f4; width:500px; border:none;\" cellpadding=\"4\" cellspacing=\"1\">";
        $rplymsg .= "<tr><td align=\"center\" style=\"font-weight:bold; font-variant:small-caps;\"> </td></tr>";
        $rplymsg .= "<tr><td align=\"left\" width=\"30%\" style=\"font-weight:bold; font-variant:small-caps;background:#ffffff;\"> Thanks for Your Interest. 
</td></tr>";
     
        $rplymsg .= "<tr><td>More info contact us &nbsp;<b style=\"color:blue\">slsundar4@gmail.com</b> </td></tr>
		<tr><td>Our executive will reach you soon. </td></tr></table>";
        $rplymsg .= "</body></html>";
        $subject="Infogenx - Client Enquiry";
        mail($email_to,$subject, $message,$headers); // mail admin  receving 
        mail($email,$email_subject,$rplymsg,$headers1); // auto  reply mail to sender
 //echo $email_to,$email_subject,$email_message,$headers;
 echo '<script type="text/javascript">alert("Thank you for contacting us. We will be in touch with you very soon.")</script>'; 
	
    if(mysqli_query($dbcon,$insert_user))
    {
        //echo"<script>window.open('registration.php','_self')</script>";
		echo "success";
    }

}

?>