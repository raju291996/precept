<?php
$error = false;
if(isset($_POST['submit'])){
	include_once('includes/Dbconfig.php');
	$email = htmlspecialchars(mysqli_real_escape_string($con, $_POST['email']));
	$activation_code=md5(uniqid(rand())); 
	//email validation
	if(empty($email)){
		$error = true;
		$email_error = "Please enter Email";
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$error = true;
		$email_error = "Invalid email";
	}
	else{
		//check if email not exist
		$query = "select user_email from login where user_email='$email' LIMIT 1";
		$run = mysqli_query($con, $query);
		$result = mysqli_num_rows($run);
		if($result == 0){
			$error = true;
			$email_error = "Unregistered email address";
		}
	}
	if(!$error){
		$query = "UPDATE login SET user_act_code = '$activation_code' WHERE user_email = '$email' LIMIT 1";
		if(!mysqli_query($con, $query)){
            $msg = "Please try again";
		}
		else{
			$to = $email;  // send e-mail to ...
		    $subject = "Forgot Password - mypraeceweb.esy.es"; // Your subject
		    $header = "From: noreply@mypraeceweb.esy.es"; // From
		    $message = " Please click below link to reset your password:\r\n";
            $message .= "http://mypraeceweb.esy.es/resetpassword.php?email=$email&resetcode=$activation_code"; //cofirmation link....
		    $sentmail = mail($to, $subject, $message, $header); // send email
			$msg = "Your password reset email has been sent to your email";
		}
	}
}
?>


<html>
<head>
    <meta charset="UTF-8" />
    <title>Become a tutor-praeceptore</title>
    <link href="css/find-tutor.css" rel="stylesheet"/>
	<link rel="stylesheet" href="css/main.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body>
<div class="scroll_header2"><?php include('includes/header.php'); ?></div>
<div class="xyz">
  <div class="signup-popup-div">
 
    <div class="signup-aside1 signup-12" style="border-right:1px solid #e1e1e1;box-sizing:border-box;">
        <p class="p1">Forgot Password</p>
         <img src="images/login-img.png" alt="image unavailable"/>
      </div>
      
    <div class="signup-aside2 signup-12">
	  <span class="reg_error"><?php echo @$email_error; ?></span>
	  <span class="reg_error"><?php echo @$msg; ?></span>
      <form action="forgotpassword.php" method="post" class="form-login">   
        <div class="login-form-field" style="margin-top:40px;">
          <input id="reg_email" type="text" name="email" class="form-input" placeholder="Email Address" value="<?php echo $email;?>" />
        </div>
        <div class="login-form-field">
          <input type="submit" value="Next" name="submit" class="submit-btn">
        </div>
      </form>
     
    </div>
      
    <div class="clear"></div>
   </div>  
</div>
<div class="contact"><?php include('includes/contact.php'); ?></div>
<div class="footer"><?php include('includes/footer.php'); ?></div>
<div class="copyright"><span class="right"><?php include('includes/copyright.php'); ?></span></div>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>