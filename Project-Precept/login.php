<?php
session_start();
include_once('includes/Dbconfig.php');
if(@$_SESSION['user_id']){
	header("Location:home.php");
    exit();
}

$error = false;

if(isset($_POST['submit'])){
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	$email = htmlspecialchars($email);
	$password = htmlspecialchars($password);
	$email = mysqli_real_escape_string($con, $email);
    $password = mysqli_real_escape_string($con, $password);
	
	if(empty($email) & empty($password)){
		$error = true;
		$login_error = "Please fill both fields";
		$log_err = 1;
	}
	
	if(!$error){
	    $query = "SELECT * FROM login WHERE user_email = '$email'";
	    $result = mysqli_query($con, $query);
	    $rows = mysqli_num_rows($result);
	    if($rows > 0){
	        $data = mysqli_fetch_array($result);
	        $verify_pass = $data['user_pass'];
			$user_id = $data['user_id'];
			$user_email = $data['user_email'];
			$user_name = $data['user_name'];
	        if(password_verify($password, $verify_pass)){
				$_SESSION['user_email'] = $user_email;
				$_SESSION['user_id'] = $user_id;
				$_SESSION['user_name'] = $user_name;
				if(isset($_POST['remember'])){
				setcookie("cookie_id", $user_id, time()+60*60*24);
				setcookie("cookie_email", $user_email, time()+60*60*24);
				setcookie("cookie_pass", $verify_pass, time()+60*60*24);
			    }
				header("Location:home.php");
		    }
	        else {
		        $login_error = "Invalid Email or Password";
            }
	    }
	    else{
		    $login_error = "Unregistered Email Address";
	    }
    }
}

?>
	

<html>
<head>
    <meta charset="UTF-8" />
    <title>login-Precept</title>
	<link rel="icon" type="image/png" href="images/prae.png">
    <link href="css/find-tutor.css" rel="stylesheet"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body>

<?php include('includes/header.php'); ?>

<div class="xyz">
        
  <div class="login-popup-div">
     <div class="login-aside1 aside12">
         <p>Student / Tutor</p>
         <img src="images/login-img.png" alt="image unavailable"/>
      </div>
     <div class="login-aside2 aside12">
       <form action="login.php" method="post" class="form-login">
		   <div class="login-error"><?php echo @$login_error;?></div>
           <div class="login-form-field">
               <input id="reg_email" type="text" name="email" class="form-input" placeholder="Email Address">
           </div>
           <div class="login-form-field">
               <input id="reg_password" type="password" class="form-input" name="password" placeholder="Password">
           </div>
           <div class="login-form-field">
              <input type="checkbox" name="remember" id="remember" class="form-checkbox" />
               <label for="remember-me"><span>Remember me </span><a href="forgotpassword.php">Forgot Password</a></label>
           </div>
           <div class="login-form-field">
              <input type="submit" value="Log In" name="submit" class="submit-btn">
           </div>  
        </form>
        <p class="login-text-signup"><span>New Memeber at Precept</span> <a href="signup.php">Create an Account</a></p>
     </div>
      <div class="clear"></div>
  </div>
        
</div>


<script type="text/javascript" src="js/script.js"></script>
</body>
</html>






