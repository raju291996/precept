<?php session_start(); ?>
<html>
<head>
    <meta charset="UTF-8" />
    <title>tutor profile-Precept</title>
	<link rel="icon" type="image/png" href="images/prae.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="css/main.css"/>
	<link rel="stylesheet" href="css/find-tutor.css"/>
	<link rel="stylesheet" href="css/tutor-profile.css"/> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="js/rating.js"></script>
	
	
</head>
<body>
<div class="scroll_header2"><?php if(@$_SESSION['user_id']){include('includes/header2.php');}else{include('includes/header.php');} ?></div>
<div class="tutor-profile-main-divx"> 
<?php
include_once('includes/Dbconfig.php');

if (isset($_GET['tutorid'])) {
      
    $tutor_id = $_GET['tutorid'];
	$tutor_id  = substr($tutor_id, 4);
	
	$query = "SELECT * FROM tutor_list WHERE tutor_id = '$tutor_id'";
	$result = mysqli_query($con, $query);
	$rows = @mysqli_num_rows($result);
    if($rows > 0){
		$data = mysqli_fetch_assoc($result);
	}
}
?> 
 
    <div class="tutor-profile-div">
        <div class="tutor-profile-infos tutor-profile-divs">
		
            <div class="tutor-profile-personal-info">
                <div class="tutor-profile-image basic-image"><img src="images/boss-1.png" alt="Profile Image" width="160px" height="160px"/></div>
                <div class="tutor-profile-basic basic-image">
                    <p class="span1"><b><?php echo $data['tutor_name']; ?></b></p>
                    <span class="span2"><span class="s1">Working at</span> <?php echo $data['tutor_curwork_stats']; ?></span><br>
                    <span class="span3"><span class="s1">From </span><?php echo $data['tutor_city']; ?>, India</span><br><br>
                    <span class="span4"><span class="s1">Education </span><?php echo $data['tutor_qualifications']; ?></span>
                </div>
                <div class="clear"></div>
            </div>
            <div class="tutor-profile-exp-skills">
                <div class="tutor-profile-skills exp-skills">
                    <div class="skill-image skill-name-img"><img src="images/skills.png"/></div>
                    <div class="skill-name skill-name-img">
                        <b>Skills</b><p><?php echo $data['tutor_skills']; ?></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="tutor-profile-experience exp-skills">
                    <div class="exp-image exp-name-img"><img src="images/exp.png"/></div>
                        <div class="exp-name exp-name-img">
                            <b>Experience</b><p><?php echo $data['tutor_exp']; ?></p>
                        </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="tutor-profile-summary">
                <div class="desc-image desc-name-img"><img src="images/desc.png"/></div>
                <div class="desc-name desc-name-img">
                    <b>Description</b><p><?php echo $data['tutor_desccription']; ?></p>
                </div>
                <div class="clear"></div>
            </div> 
        </div>
        <div class="tutor-contact-s1 tutor-profile-divs">  
		<div class="above-img"><img src="images/t-contact.png" align="middle"/><span class="sp1">Contact</span></div>
		<div class="below-desc">
		    <p><span style="font-size:14px;color:#999;">Email : </span><?php echo $data['tutor_email']; ?></p>
		</div>
        </div>
        <div class="clear"></div>
    </div>
	
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
</body>
</html>

