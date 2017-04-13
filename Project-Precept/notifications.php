<?php 
include_once('includes/Dbconfig.php');
session_start();
$error = false;
if(isset($_SESSION['user_id'])){
	$id = $_SESSION['user_id'];
	$name = $_SESSION['user_name'];
	$email = $_SESSION['user_email'];
	$query = "SELECT * FROM login WHERE user_email = '$email' AND user_id = '$id'";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0){
		$data = mysqli_fetch_array($result);
		$user_type = $data['user_type'];
		$verify_pass = $data['user_pass'];
			
		if(isset($_POST['delete'])){
				
			$s1 = htmlspecialchars(mysqli_real_escape_string($con, $_POST['cur-pass']));
				
			if(empty($s1)){
                $error = true;
                $cur_error = "Please enter password.";
            }
				
			if(!$error){
			    if(password_verify($s1, $verify_pass)){
					if($user_type == 'student'){
						$query2 = "DELETE FROM login WHERE user_email = '$email' AND user_id = '$id'";
						$query3 = "DELETE FROM students WHERE s_email = '$email'";
						
						if(!mysqli_query($con, $query2) & !mysqli_query($con, $query3)){
                            $msg = "Please try again";
                        }
						else{
							session_destroy();
							$del_msg = "Your account successfully deleted";
							header("Location:signup.php");
						}
					}
					else if($user_type == 'tutor'){
						$query2 = "DELETE FROM login WHERE user_email = '$email' AND user_id = '$id'";
						$query3 = "DELETE FROM tutor_list WHERE tutor_email = '$email'";
						
						if(!mysqli_query($con, $query2) & !mysqli_query($con, $query3)){
                            $msg = "Please try again";
                        }
						else{
							session_destroy();
							$del_msg = "Your account successfully deleted";
							header("Location:becometutor");
						}
					}
				}
				else{
					$inval_error = "Invalid account password";
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
<div class="user-profile-divx">
        <div class="user-profile-div-aside1 profile-divx12">
            <h3>My Account</h3>
            <a href="account.php">Personal Information</a><br>
            <a href="change_password.php">Change Password</a><br>
            <a href="update_email.php">Update Email</a><br>
            <a href="notifications.php" class="cp-active">Notifications</a><br>
            <a href="delete_account.php">Deactivate Account</a>
        </div>
        <div class="user-profile-div-aside2 profile-divx12">
            <h3>Notifications</h3>
            <p class="notify">There is no notifications right now.</p>
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