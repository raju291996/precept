<html>
<head>
    <meta charset="UTF-8" />
    <title>signup-Precept</title>
	<link rel="icon" type="image/png" href="images/prae.png">
    <link href="css/find-tutor.css" rel="stylesheet"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body>
<?php 
include('includes/header.php'); 
session_start();
if(@$_SESSION['user_id']){
	header("Location:account.php");
}

include_once('includes/Dbconfig.php');

$error = false;

if(isset($_POST['submit'])){
	
	//collect form value
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	$mobile = $_POST['mobileno'];
	date_default_timezone_set('Asia/Kolkata');
    $date= date('Y-m-d H:i:s') ;
	$confirm_code=md5(uniqid(rand())); 
	
	// to remove backslash
	$fullname = stripslashes(mysqli_real_escape_string($con, $fullname));
	$email = stripslashes(mysqli_real_escape_string($con, $email));
	$password = stripslashes(mysqli_real_escape_string($con, $password));
	$cpassword = stripslashes(mysqli_real_escape_string($con, $cpassword));
	$mobile = stripslashes(mysqli_real_escape_string($con, $mobile));
	
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
	$query = "INSERT INTO login (user_name, user_email, user_pass, user_mobile, user_datetime, user_email_confcode, user_type, user_act_code) VALUES ('$fullname', '$email', '$hash', '$mobile', '$date', '$confirm_code', 'student', 'qwerty')";
    $result = mysqli_query($con, $query);
    if(!$result){
        echo "please try again";
    }
    else{
		/*$to = $email;  // send e-mail to ...
		$subject = "mypraeceweb.esy.es"; // Your subject
		$header = "From: noreply@mypraeceweb.esy.es"; // From
		$message = " 
                Thanks for signing up!
                Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
                ------------------------
                Username: '$fullname'
                Password: '$password'
                ------------------------
 
               Please click this link to activate your account:\r\n";
        $message .= "http://mypraeceweb.esy.es/confirmation.php?passkey=$confirm_code"; //cofirmation link....
		$sentmail = mail($to, $subject, $message, $header); // send email */
		
	    $query = "SELECT * FROM login WHERE user_email = '$email' and user_name = '$fullname";
		$run = mysqli_query($con, $query);
		if(@mysqli_num_rows($run) > 0){
			$data = mysqli_fetch_array($run);
			$user_id = $data['user_id'];
		}
        //session_start();
		$_SESSION['user_email'] = $email;
		$_SESSION['user_name'] = $fullname;
		$_SESSION['user_id'] = $user_id;
		
	    header ("location:account.php");
    }
}
}
?>


<div class="xyz">
  <div class="signup-popup-div">
 
    <div class="signup-aside1 signup-12">
        <p class="p1">For Students</p>
         <img src="images/student.png" alt="image unavailable"/>
        <p>Get Unlimited Access of</p>
        <li><img src="images/correct.png" alt="1." width="10px" height="10px"> Best Tutors</li>
        <li><img src="images/correct.png" alt="2." width="10px" height="10px"> Concept Sheets</li>
        <li><img src="images/correct.png" alt="3." width="10px" height="10px"> Adaptive Practice</li>
        <li><img src="images/correct.png" alt="4." width="10px" height="10px"> Question Sets</li>
      </div>
      
    <div class="signup-aside2 signup-12">
      <form action="signup.php" method="post" class="form-login">  
        <div class="login-form-field">
          <input id="reg_fullname" type="text" name="fullname" class="form-input" placeholder="Full Name"/>
		  <span class="reg_error"><?php echo @$name_error; ?></span>
        </div>   
        <div class="login-form-field">
          <input id="reg_email" type="text" name="email" class="form-input" placeholder="Email Address"/>
		  <span class="reg_error"><?php echo @$email_error; ?></span>
        </div>
        <div class="login-form-field">
          <input id="reg_password" type="password" class="form-input" name="password" placeholder="Password"/>
		  <span class="reg_error"><?php echo @$password_error; ?></span>
        </div>   
        <div class="login-form-field">
          <input id="reg_cpassword" type="password" class="form-input" name="cpassword" placeholder="Confirm Password"/>
		  <span class="reg_error"><?php echo @$cpass_error; ?></span>
        </div>	
		<div class="login-form-field">
          <input id="reg_mobile" type="text" class="form-input" name="mobileno" placeholder="Mobile No."/>
		  <span class="reg_error"><?php echo @$mobile_error; ?></span>
        </div>
        <div class="login-form-field">
          <input type="submit" value="Sign Up" name="submit" class="submit-btn">
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