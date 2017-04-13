<?php 
session_start();
?>
<html>
<head>
    <meta charset="UTF-8" />
    <title>hire tutor-praeceptore</title>
    <link href="css/find-tutor.css" rel="stylesheet"/>
	<link rel="stylesheet" href="css/main.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body>
<div class="scroll_header2"><?php include('includes/header2.php'); ?></div>
<div class="xyz">
    <div class="user-profile-hire-popup-div" style="margin:100px; font-size:14px;color:teal;'">

<?php
if($_SESSION["user_name"]) {
?>
Thank you <b><?php echo $_SESSION["user_name"]; ?></b> for your response.
We will contact you within 24 hours.

<?php
}
else{
	header("Location:loginpage.php");
}
?>
      
    </div>
</div>
<div class="contact"><?php include('includes/contact.php'); ?></div>
<div class="footer"><?php include('includes/footer.php'); ?></div>
<div class="copyright"><span class="right"><?php include('includes/copyright.php'); ?></span></div>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>