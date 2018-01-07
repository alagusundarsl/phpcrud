<?php
ob_start();

?><html>
<head lang="en">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css">
    <title>Registration</title>
</head>


<?php
//session_start();
include("database/db_conection.php");
if(isset($_POST['submit']) && !empty($_POST['submit']))
{
$username=$_POST['username'];
$username2=base64_encode($username);

$email=$_POST['email'];
 $check_email_query="select * from users WHERE user_email='$email'";
    $run_query=mysqli_query($dbcon,$check_email_query);

    if(mysqli_num_rows($run_query)>0)
    {
echo "<script>alert('Email $user_email is already exist in our database, Please try another one!')</script>";
//exit();
    }

$mobile=$_POST['mobileno'];
$mobile2=base64_encode($mobile);

if(!empty($_FILES['cate_img']['name']))
{
$uploaddir = 'userimages/';
$uploadfile = $uploaddir . basename($_FILES['cate_img']['name']);
echo '<pre>';
if (move_uploaded_file($_FILES['cate_img']['tmp_name'], $uploadfile)) 
{
   // echo "File is valid, and was successfully uploaded.\n";
} else {
  //  echo "Possible file upload attack!\n";
}
$userimage1=$_FILES['cate_img']['name'];
}
			
			
//insert the user into the database.
    $insert_user="insert into users (user_name,user_email,user_mobile,userimage) VALUE ('$username','$email','$mobile','$userimage1')";
		
		if(mysqli_query($dbcon,$insert_user))
    {
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
    
    
    <tr><td align=\"left\" width=\"20%\" style=\"font-weight:bold; font-variant:small-caps;background:#ffffff;\">Imge</td> 
    <td align=\"left\" style=\"background:#ffffff;width:60%\">
	<img src=\"http://igxprodus.com/sundarphpwork/userimages/$userimage1\" style=\"height:100px;width:150px;\">
	</td></tr></table>
    <a href=\"http://igxprodus.com/sundarphpwork/userformupdate.php?username1=$username2&mobile=$mobile2\">Click this link. And Type your Password</a>
    ";  
        // admin mail
        
        $headers = 'From:'.$email. "\r\n";
		
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $subject="infogenx - Client Enquiry";
        mail($email, $subject, $message, $headers);
        //echo "Email sent!";
      
        if(mail)
        {
          /* echo '<script type="text/javascript">alert("Thank you for contacting us. We will be in touch with you very soon.")
		   
		   </script>';  
			header('Location: '.$_SERVER['REQUEST_URI']);*/
            header("Location:formregister.php?flag=success");

			
        }
		
    }
				
		}
		
			
		
?>

<body>

<div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
    <div class="row"><!-- row class is used for grid system in Bootstrap-->
        <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Registration</h3>
                </div>
                <div class="panel-body">
                    <div>
                        <?php 
                        if($_REQUEST['flag']=='success')
                        {
                            echo "Thank you for contacting us. We will be in touch with you very soon";
                        }
                        ?>
                    </div>
                    <form  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="username" type="text" required>
                            </div>

                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" required>
                            </div>
                           
							
							<div class="form-group">
							
                                <input class="form-control" placeholder="Upload Image" type="file" name="cate_img" required>
                            </div>
							
							 <div class="form-group">
                                <input class="form-control" placeholder="Mobile No" name="mobileno" type="text" maxlength="10" required>
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
