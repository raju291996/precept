<?php 
include_once('includes/Dbconfig.php');
session_start();
$error = false;
if($_SESSION['user_id']){
	$id = $_SESSION['user_id'];
	$name = $_SESSION['user_name'];
	$email = $_SESSION['user_email'];
	$query = "SELECT * FROM login WHERE user_email = '$email' AND user_id = '$id'";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0){
		$data = mysqli_fetch_array($result);
		$user_type = $data['user_type'];
		$verify_pass = $data['user_pass'];
			
			if(isset($_POST['submit'])){
				$s1 = htmlspecialchars(mysqli_real_escape_string($con, $_POST['cur-pass']));
				$s2 = htmlspecialchars(mysqli_real_escape_string($con, $_POST['new-pass']));
				$s3 = htmlspecialchars(mysqli_real_escape_string($con, $_POST['cnf-pass']));
				
				if(empty($s1)){
                    $error = true;
                    $cur_error = "Please enter password.";
                }else if(strlen($s1) < 8) {
                    $error = true;
                    $cur_error = "Atleast 8 characters";
                }
				if(empty($s2)){
                    $error = true;
                    $new_error = "Please enter password.";
                }else if(strlen($s2) < 8) {
                    $error = true;
                    $new_error = "Atleast 8 characters";
                }
				if(empty($s3)){
                    $error = true;
                    $cnf_error = "Please enter confirm password.";
                }else if($s2 != $s3){
		            $error = true;
		            $cnf_error = "password not match";
	            }
			    if(!$error){
					if(password_verify($s1, $verify_pass)){
						$query2 = "UPDATE login SET user_pass = '$s2' WHERE user_email = '$email' AND user_id = '$id'";
						if(!mysqli_query($con, $query2)){
                            $msg = "Please try again";
                        }
					    else{
						    $smsg = "Your password successfully changed"; 
					    }
					}
					else{
						$inval_error = "Invalid current password";
					}  
			    }
		    }
    }	
?>

<html>
<head>
    <meta charset="UTF-8" />
    <title>Profile-praeceptore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/prae.png">	
    <link href="css/find-tutor.css" rel="stylesheet"/>
	<link rel="stylesheet" href="css/tutor-profile.css"/>
    
</head>
<body>
    
<div class="scroll_header2"><?php include('includes/header2.php'); ?></div>
<div class="user-account-errorno" style="color:red;font-size:12px;margin:10 30px;"><?php echo @$msg; ?></div>
<div class="user-account-noerror" style="color:green;font-size:12px;margin:10 30px;"><?php echo @$smsg; ?></div>
<div class="user-profile-divx">
        <div class="user-profile-div-aside1 profile-divx12">
            <h3>My Account</h3>
            <a href="account.php">Personal Information</a><br>
            <a href="change_password.php" class="cp-active">Change Password</a><br>
            <a href="update_email.php">Update Email</a><br>
            <a href="notifications.php">Notifications</a><br>
            <a href="delete_account.php">Deactivate Account</a>
        </div>
        <div class="user-profile-div-aside2 profile-divx12">
            <h3>Change Password</h3>
            <div class="update-info">
                <form action="" method="post">
                    <div class="account-form-field">
                        <input type="password" name="cur-pass" class="input" placeholder="Current Password" ><span class="acc-error"><?php echo @$cur_error; ?><?php echo @$inval_error; ?></span>
                    </div>
                    <div class="account-form-field">
                        <input type="password" name="new-pass" class="input" placeholder="New Password"/><span class="acc-error"><?php echo @$new_error; ?></span>
                    </div>
                    <div class="account-form-field">
                        <input type="password" name="cnf-pass" class="input" placeholder="Confirm New Password"/><span class="acc-error"><?php echo @$cnf_error; ?></span>
                    </div>
                    <div class="account-form-field">
                        <input type="submit" name="submit" class="submit-btn" value="Save">
                    </div>
                    
                </form>
            </div>
        </div>
        <div class="clear"></div>
</div>
 
</body>
</html>

<?php 
}
else{
	header("Location:login.php");
	mysqli_close($con);
}
?>