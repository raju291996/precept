<?php 
include_once("includes/Dbconfig.php");
session_start();
$error = false;
if(isset($_SESSION['user_email'])){
    $tutor_email = $_SESSION['user_email'];
	$tutor_id = $_SESSION['user_id'];
    $query  = "SELECT * FROM login WHERE user_email = '$tutor_email' AND user_id = '$tutor_id'";
    $result = mysqli_query($con, $query);
    $rows = @mysqli_num_rows($result);
    if($rows > 0){
	$data = @mysqli_fetch_array($result);
	$user_type = $data['user_type'];
	$tutor_name = $data['user_name'];
	if($user_type == 'student'){
		header("Location:account.php");
		exit();
	}
    else{
		
	$queryN = mysqli_query($con, "SELECT * FROM tutor_list WHERE tutor_email = '$tutor_email'");
	$data2 = mysqli_fetch_array($queryN);

    if(isset($_POST['submit'])){
	
	$standard = htmlspecialchars(mysqli_real_escape_string($con, $_POST['standard']));
	$subject =  htmlspecialchars(mysqli_real_escape_string($con, $_POST['subject']));
	$city =  htmlspecialchars(mysqli_real_escape_string($con, $_POST['city']));
	$qualified = htmlspecialchars(mysqli_real_escape_string($con, $_POST['tutor_qualified']));
	$skills = htmlspecialchars(mysqli_real_escape_string($con, $_POST['tutor_skills']));
	$address = htmlspecialchars(mysqli_real_escape_string($con, $_POST['tutor_add']));
	$exp = htmlspecialchars(mysqli_real_escape_string($con, $_POST['tutor_exp']));
	$cws = htmlspecialchars(mysqli_real_escape_string($con, $_POST['tutor_cws']));
	$ddesc = htmlspecialchars(mysqli_real_escape_string($con, $_POST['tutor_description']));
	date_default_timezone_set('Asia/Kolkata');
	$date= date('Y-m-d H:i:s') ;
	
		$query2 = "SELECT * FROM tutor_list WHERE tutor_email = '$tutor_email'";
		$result2 = mysqli_query($con, $query2);
		$rows2 = @mysqli_num_rows($result2);
		if($rows2 > 0){
			$query3 = "UPDATE tutor_list SET tutor_class = '$standard', tutor_city = '$city', tutor_subjects = '$subject', tutor_qualifications = '$qualified', tutor_skills = '$skills', tutor_desccription = '$ddesc', tutor_add = '$address', tutor_time = '$date', tutor_exp = '$exp', tutor_curwork_stats = '$cws' WHERE tutor_email = '$tutor_email'";
			if(mysqli_query($con, $query3)){
				$smsg = "Your information has been updated";
			}
			else{
				$msg = "Somthing wrong, Please try again to update your information";
			}
		}
		else{
			$query4 = "INSERT INTO tutor_list (tutor_email, tutor_name, tutor_class, tutor_city, tutor_subjects, tutor_qualifications, tutor_skills, tutor_desccription, tutor_add, tutor_time, tutor_exp, tutor_curwork_stats, tutor_rating) VALUES ('$tutor_email', '$tutor_name', '$standard', '$city', '$subject', '$qualified', '$skills', '$ddesc', '$address', '$date', '$exp', '$cws', '0')";
			if(mysqli_query($con, $query4)){
				$smsg = "You information has been submitted";
			}
			else{
				$msg = "Something wrong, Please try again";
			}
		}
	}
	
}
}
}
else{
	header("Location:becometutor.php");
	exit();
}

?>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Become a tutor-praeceptore</title>
	<link rel="icon" type="image/png" href="images/prae.png">
    <link href="css/find-tutor.css" rel="stylesheet"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body>
<div class="scroll_header2"><?php if(@$_SESSION['user_id']){include('includes/header2.php');}else{include('includes/header.php');} ?></div>
<div class="xyz">
    <div class="tutor-email-verify"><?php echo @$msg; ?><span class="tss"><?php echo @$smsg; ?></span></div>
  <div class="tutor-desc-popup-div">
 
    <div class="tutor-desc-header1">
       <p>Fill all the information to complete your profile.</p> 
    </div>
      
    <div class="tutor-desc-header2">
      <form action="tutordesc.php" method="post" class="tutor-desc-form">
        <div class="tutor-desc-field1">
            <div class="tutor-desc-error"></div>
                <span class="s9">Choose Your Class&nbsp;&nbsp; </span><select name="standard" class="class">
                        <option value="12 standard">12 standard</option>
						<option value="11 standard">11 standard</option>
						<option value="10 standard">10 standard</option>
                        <option value="8 standard">9 standard</option>
                        <option value="9 standard">8 standard</option>
                    </select>
                <span class="s9">&nbsp;&nbsp;&nbsp; Choose Your Subject&nbsp;&nbsp;&nbsp;</span><select name="subject" class="subject">
                        
                        <option value="Arts">Arts</option>
                        <option value="Biology">Biology</option>
                        <option value="Chemistry">Chemistry</option>
                        <option value="Commerce">Commerce</option>
                        <option value="Computer">Computer</option>
                        <option value="English">English</option>
                        <option value="Mathematics">Mathematics</option>
                        <option value="Physics">Physics</option>
                        <option value="Social Study">Social Study</option>
                    </select>
                <span class="s9">&nbsp;&nbsp;&nbsp; Choose Your City&nbsp;&nbsp;&nbsp;</span><select name="city" class="City">
                    <option value="Ahmedabad">Ahmedabad</option>
						<option value="Bengaluru">Bengaluru</option>
						<option value="Chandigarh">Chandigarh</option>
						<option value="Chennai">Chennai</option>
						<option value="Dehradoon">Dehradoon</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Hyderabad">Hyderabad</option>
                        <option value="Jaipur">Jaipur</option>
						<option value="Kota">Kota</option>
                        <option value="Mumbai">Mumbai</option>
                    </select> 
        </div>
        <div class="tutor-desc-field2">
          <div class="tutor-desc-form-field">
          <input type="text" name="tutor_qualified" class="tutor-desc-input" placeholder="Your Qualification (max 200 characters)" maxlength="200" value="<?php echo @$data2['tutor_qualifications']; ?>" required />
		  <span class="tutor-desc-error"></span>
        </div>   
        <div class="tutor-desc-form-field">
          <input type="text" name="tutor_skills" class="tutor-desc-input" placeholder="Your Skills (max 200 characters)" maxlength="200" value="<?php echo @$data2['tutor_skills']; ?>" required />
		  <span class="tutor-desc-error"></span>
        </div>
        <div class="tutor-desc-form-field">
          <input type="text" class="tutor-desc-input" name="tutor_exp" placeholder="Your Experience (max 200 characters)" maxlength="200" value="<?php echo @$data2['tutor_exp']; ?>" required />
		  <span class="tutor-desc-error"></span>
        </div>
        <div class="tutor-desc-form-field">
          <input type="text" class="tutor-desc-input" name="tutor_cws" placeholder="Your Current Work Status (max 200 characters)" maxlength="200" value="<?php echo @$data2['tutor_curwork_stats']; ?>" required />
		  <span class="tutor-desc-error"></span>
        </div>
        <div class="tutor-desc-form-field">
          <input type="text" class="tutor-desc-input" name="tutor_add" placeholder="Your Address (max 200 characters)" maxlength="200" value="<?php echo @$data2['tutor_add']; ?>" required />
		  <span class="tutor-desc-error"></span>
        </div>	
		<div class="tutor-desc-form-field">
          <textarea class="tutor-desc-textarea" name="tutor_description" placeholder="Detail Description (max 500 characters)" rows="7" maxlength="500" required ><?php echo @$data2['tutor_desccription']; ?></textarea>
		  <span class="tutor-desc-error"></span>
        </div>
        <div class="tutor-desc-form-field">
          <input type="submit" value="SAVE" name="submit" class="submit-btn">
        </div>
        </div>
      </form>
      <p class="tutor-desc-text-signup"><span>You can change these information after complete registration </span></p>
    
   </div>
    </div>
    
</div>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>











