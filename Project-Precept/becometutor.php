<?php

include_once('includes/Dbconfig.php');

session_start();
if(isset($_SESSION['user_id'])){
	$tutor_email = $_SESSION['user_email'];
	$query = "SELECT * FROM login WHERE user_email = '$tutor_email'";
	$result = mysqli_query($con, $query);
	if(@mysqli_num_rows($result) > 0){
		$data = mysqli_fetch_array($result);
		$user_type = $data['user_type'];
		if($user_type == 'tutor'){
			header("Location:tutordesc.php");
		}
		if($user_type == 'student'){
			header("Location:account.php");
		}
	exit();
    }
}
$error = false;

if(isset($_POST['submit'])){
	
	date_default_timezone_set('Asia/Kolkata');
    $date= date('Y-m-d H:i:s') ;
	$confirm_code=md5(uniqid(rand())); 
	
	$fullname = stripslashes(mysqli_real_escape_string($con, $_POST['fullname']));
	$email = stripslashes(mysqli_real_escape_string($con, $_POST['email']));
	$password = stripslashes(mysqli_real_escape_string($con, $_POST['password']));
	$cpassword = stripslashes(mysqli_real_escape_string($con, $_POST['cpassword']));
	$mobile = stripslashes(mysqli_real_escape_string($con, $_POST['mobileno']));
	
	$hash = password_hash($password, PASSWORD_BCRYPT);
	
	//basic name validation
	if(empty($fullname)){
		$error = true;
		$name_error = "Please enter your name";
	}
	else if(strlen($fullname) < 3){
		$error = true;
		$name_error = "At least 3 char required";
	}
	else if(!preg_match("/^[a-zA-Z ]+$/",$fullname)){
		$error = true;
        $name_error = "only alphabets and space";
	}
	
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
		//check if email already exist
		$query = "select user_email from login where user_email='$email'";
		$run = mysqli_query($con, $query);
		$result = mysqli_num_rows($run);
		if($result!=0){
			$error = true;
			$email_error = "email already exist";
		}
	}
	
	//password validation
	if(empty($password)){
        $error = true;
        $password_error = "Please enter password.";
    }else if(strlen($password) < 8) {
        $error = true;
        $password_error = "Atleast 8 characters";
    }
	
	//confirm password
	if(empty($cpassword)){
        $error = true;
        $cpass_error = "Please enter confirm password.";
    }else if($password != $cpassword){
		$error = true;
		$cpass_error = "password not match";
	}
	
	//mobile no validation
	if(empty($mobile)){
        $error = true;
        $mobile_error = "Please enter password.";
    }else if(!preg_match("/^[789][0-9]{9}$/", $mobile)){
		$error = true;
		$mobile_error = "Invalid Mobile No";
	}
	else if(strlen($mobile) != 10){
		$error = true;
		$mobile_error = "Invalid Mobile No";
	}
	
	if(!$error){
	$query = "INSERT INTO login (user_name, user_email, user_pass, user_mobile, user_datetime, user_email_confcode, user_type) VALUES ('$fullname', '$email', '$hash', '$mobile', '$date', '$confirm_code', 'tutor')";
    $result = mysqli_query($con, $query);
    if(!$result){
        echo "<span style='margin-top:100px;color:red;'>please try again</span>";
    }
    else{
		/*$to = $email;  // send e-mail to ...
		$subject = "mypraeceweb.esy.es"; // Your subject
		$header = "From: noreply@mypraeceweb.esy.es"; // From
		$message = " 
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
Please click this link to activate your account:\r\n";
      $message .= "http://mypraeceweb.esy.es/confirmation.php?passkey=$confirm_code"; //cofirmation link....
		$sentmail = mail($to, $subject, $message, $header); // send email */

	   $user_id = mysqli_insert_id($con);
		//session_start();
		$_SESSION['user_email'] = $email;
		$_SESSION['user_id'] = $user_id;
		$_SESSION['user_name'] = $fullname;
	    header ("Location:tutordesc.php");
    }
}
}
?>


<html>
<head>
    <meta charset="UTF-8" />
    <title>Become a tutor-Precept</title>
	<link rel="icon" type="image/png" href="images/prae.png">
    <link href="css/find-tutor.css" rel="stylesheet"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body>
<?php include('includes/header.php'); ?>
<div class="xyz">
  <div class="signup-popup-div">
 
    <div class="signup-aside1 signup-12">
        <p class="p1">Become A Tutor</p>
         <img src="images/login-img.png" alt="image unavailable"/>
        <p> Get more benefits of</p>
        <li><img src="images/correct.png" alt="1." width="10px" height="10px"> Flexible Schedules</li>
        <li><img src="images/correct.png" alt="2." width="10px" height="10px"> Time Management</li>
        <li><img src="images/correct.png" alt="3." width="10px" height="10px"> More Students</li>
      </div>
      
    <div class="signup-aside2 signup-12">
      <form action="becometutor.php" method="post" class="form-login">  
        <div class="login-form-field">
          <input id="reg_fullname" type="text" name="fullname" class="form-input" placeholder="Full Name" value="<?php echo @$fullname;?>"/>
		  <span class="reg_error"><?php echo @$name_error; ?></span>
        </div>   
        <div class="login-form-field">
          <input id="reg_email" type="text" name="email" class="form-input" placeholder="Email Address" value="<?php echo @$email;?>" />
		  <span class="reg_error"><?php echo @$email_error; ?></span>
        </div>
        <div class="login-form-field">
          <input id="reg_password" type="password" class="form-input" name="password" placeholder="Password" value="<?php echo @$password;?>" />
		  <span class="reg_error"><?php echo @$password_error; ?></span>
        </div>   
        <div class="login-form-field">
          <input id="reg_cpassword" type="password" class="form-input" name="cpassword" placeholder="Confirm Password" value="<?php echo @$cpassword;?>" />
		  <span class="reg_error"><?php echo @$cpass_error; ?></span>
        </div>	
		<div class="login-form-field">
          <input id="reg_mobile" type="text" class="form-input" name="mobileno" placeholder="Mobile No." value="<?php echo @$mobile;?>" />
		  <span class="reg_error"><?php echo @$mobile_error; ?></span>
        </div>
        <div class="login-form-field">
          <input type="submit" value="Next" name="submit" class="submit-btn">
        </div>
      </form>
      <p class="login-text-signup"><span>Already a member?</span> <a href="login.php">Sign In</a></p>
    </div>
      
    <div class="clear"></div>
   </div>  
</div>

<script type="text/javascript" src="js/script.js"></script>
</body>
</html>