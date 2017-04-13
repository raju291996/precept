<?php 
include_once('includes/Dbconfig.php');
session_start();
if($_SESSION['user_id']){
   $user_id = $_SESSION['user_id'];
   $query = "SELECT * FROM login WHERE user_id = '$user_id'";
	$result = mysqli_query($con, $query);
	if(@mysqli_num_rows($result) > 0){
		$data = mysqli_fetch_array($result);
		$user_type = $data['user_type'];
 
           if($user_type == 'tutor'){header("Location:tutordesc.php"); exit(); }

    
?>
<html>
<head>
    <meta charset="UTF-8" />
    <title>user profile-praeceptore</title>
    <link href="css/find-tutor.css" rel="stylesheet"/>
	<link rel="stylesheet" href="css/main.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body>
<div class="scroll_header2"><?php include("includes/header2.php"); ?></div>
<div class="xyz">
    <div class="mytutor-popup-div" style="padding:100px;colot:teal;font-size:14px;color:teal;">
     
      
Hi <?php echo $_SESSION["user_name"]; ?><br>
you are not registered as a tutor, you can Choose your tutor by <a href="findtutor.php">clicking here</a><br>


      
    </div>
</div>

<script type="text/javascript" src="js/script.js"></script>
</body>
</html>
<?php
}
}
else{ header("Location:loginpage.php");}