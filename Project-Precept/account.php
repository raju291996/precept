<?php 
include_once('includes/Dbconfig.php');
session_start();
$error = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_name']) || isset($_SESSION['user_email'])){
	$id = $_SESSION['user_id'];
	$name = $_SESSION['user_name'];
	$email = $_SESSION['user_email'];
	$query = "SELECT * FROM login WHERE user_email = '$email' AND user_id = '$id'";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0){
		$data = mysqli_fetch_array($result);
		$user_type = $data['user_type'];
        $mobile = $data['user_mobile'];
		if($user_type == 'tutor'){
			header("Location:tutordesc.php");
			exit();
		}
		if($user_type == 'student'){
			$query2 = "SELECT * FROM students WHERE s_email = '$email'";
			$result = mysqli_query($con, $query2);
		    $rows2 = @mysqli_num_rows($result);

				$data = @mysqli_fetch_array($result);
				$s_id = $data['s_id'];
				$s_email = $data['s_email'];
				$s_name = $data['s_name'];
				$s_state = $data['s_state'];
				$s_city = $data['s_city'];
				$s_add = $data['s_add'];
				$s_date = $data['s_date'];
				$s_mobile = $data['s_mobile'];
				
			if(isset($_POST['submit'])){
				$s1 = htmlspecialchars(mysqli_real_escape_string($con, $_POST['mobile']));
				$s2 = htmlspecialchars(mysqli_real_escape_string($con, $_POST['name']));
				$s3 = htmlspecialchars(mysqli_real_escape_string($con, $_POST['address']));
				$s4 = htmlspecialchars(mysqli_real_escape_string($con, $_POST['state']));
				$s5 = htmlspecialchars(mysqli_real_escape_string($con, $_POST['city']));
				date_default_timezone_set('Asia/Kolkata');
                $s6= date('Y-m-d H:i:s') ;
				if(empty($s2)){
		           $error = true;
		           $s2_error = "Empty field";
	            }
				if(empty($s3)){
		           $error = true;
		           $s3_error = "Empty field";
	            }
				if(empty($s4)){
		           $error = true;
		           $s4_error = "Empty field";
	            }
				if(empty($s5)){
		           $error = true;
		           $s5_error = "Empty field";
	            }
	            if(strlen($s2) < 3 ){
		           $error = true;
		           $s2_error = "At least 3 char required";
	            }
				if(strlen($s3) < 6 ){
		           $error = true;
		           $s3_error = "At least 5 char required";
	            }
				if(strlen($s4) < 3 ){
		           $error = true;
		           $s4_error = "At least 3 char required";
	            }
	            if(!preg_match("/^[a-zA-Z ]+$/",$s2)) {
		           $error = true;
                   $s2_error = "Only alphabets and space";
	            }
				if(!preg_match("/^[a-zA-Z ]+$/",$s4)) {
		           $error = true;
                   $s4_error = "Only alphabets and space";
	            }
				
	            if(empty($s1)){
                    $error = true;
                    $mobile_error = "Please enter password.";
                }else if(!preg_match("/^[789][0-9]{9}$/", $s1)){
		            $error = true;
		            $mobile_error = "Invalid Mobile No";
	            }
	            else if(strlen($s1) != 10){
		            $error = true;
		            $mobile_error = "Invalid Mobile No";
	            }
				if($rows2 > 0){
				    if(!$error){
	                    $query3 = "UPDATE students SET s_name = '$s2', s_mobile = '$s1', s_add = '$s3', s_state = '$s4', s_date = '$s6', s_city = '$s5' WHERE s_email = '$s_email' AND s_id = '$s_id'";
                        $query03 = "UPDATE login SET user_name = '$s2', user_mobile = '$s1' WHERE user_email = '$email' AND user_id = '$id'";
                        if(!mysqli_query($con, $query3) & !mysqli_query($con, $query03)){
                            $msg = "Please try again";
                        }
					    else{
						    $smsg = "Your information successfully updated"; 
					    }
				    }
				    else{
					    $msg = "Unsuccessfull attempt, Please try again";
				    }
			    }
			    else if(!$error){
				    $query4 = "INSERT INTO students (s_name, s_email, s_mobile, s_date, s_add, s_state, s_city) VALUES ('$s2', '$email', '$s1', '$s6', '$s3', '$s4', '$s5')";
				    if(!mysqli_query($con, $query4)){
                        $msg = "Please try again later";
                    }
				    else{
					    $smsg = "Your information successfully saved";
				    }
			    }
		    }
	    }
    }		
?>

<html>
<head>
    <meta charset="UTF-8" />
    <title>PRAECEPTORE</title>
	<link rel="icon" type="image/png" href="images/prae.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link href="css/find-tutor.css" rel="stylesheet"/>
	<link rel="stylesheet" href="css/main.css"/>
	<link rel="stylesheet" href="css/tutor-profile.css"/>
    
</head>
<body>
    
<div class="scroll_header2"><?php include('includes/header2.php'); ?></div>
<div class="user-account-errorno" style="color:red;font-size:12px;margin:10 30px;"><?php echo @$msg; ?></div>
<div class="user-account-noerror" style="color:green;font-size:12px;margin:10 30px;"><?php echo @$smsg; ?></div>
<div class="user-profile-divx">
        <div class="user-profile-div-aside1 profile-divx12">
            <h3>My Account</h3>
            <a href="account.php" class="cp-active">Personal Information</a><br>
            <a href="change_password.php">Change Password</a><br>
            <a href="update_email.php">Update Email</a><br>
            <a href="notifications.php">Notifications</a><br>
            <a href="delete_account.php">Deactivate Account</a>
        </div>
        <div class="user-profile-div-aside2 profile-divx12">
            <h3>Personal Information</h3>
            <div class="update-info">
                <form action="account.php" method="post">
                    <div class="account-form-field">
                        <input id="" type="text" name="name" class="input" placeholder="your Name" value="<?php echo @$name; ?>"><span class="acc-error"><?php echo @$s2_error; ?></span>
                    </div>
                    <div class="account-form-field">
                        <input id="" type="text" name="address" class="input" placeholder="Your Address" value="<?php echo @$s_add; ?>"><span class="acc-error"><?php echo @$s3_error; ?></span>
                    </div>
                    <div class="account-form-field">
                        <input id="" type="text" name="state" class="input" placeholder="Your State" value="<?php echo @$s_state; ?>"><span class="acc-error"><?php echo @$s4_error; ?></span>
                    </div>
                    <div class="account-form-field">
                        <input id="" type="text" name="mobile" class="input" placeholder="Your Mobile No" value="<?php echo @$mobile; ?>"><span class="acc-error"><?php echo @$mobile_error; ?></span>
                    </div>
                    <div class="account-form-field">
                        <select name="city" class="City">
                        <option value="0">Choose Your City</option>
                        <option value="Ahmedabad">Ahmedabad</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Hyderabad">Hyderabad</option>
                        <option value="Bengaluru">Bengaluru</option>
                        <option value="Jaipur">Jaipur</option>
                        <option value="Mumbai">Mumbai</option>   
                        <option value="Gurgaon">Kolkata</option>    
                        <option value="Chennai">Chennai</option>
                        <option value="Chandigarh">Chandigarh</option>
                        <option value="Patna">Patna</option>              
                        <option value="Dehradoon">Dehradoon</option>
                        <option value="Dehradoon">Kota</option>
                    </select><span class="acc-error"><?php echo @$s5_error; ?></span> 
                    </div>
                    <div class="account-form-field">
                        <input id="" type="submit" name="submit" class="submit-btn" value="Save">
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
	
}
?>