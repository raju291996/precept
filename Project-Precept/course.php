<?php
include_once('includes/Dbconfig.php');
include_once('session.php');
$error = false;
if(isset($_GET['course'])){
$course = htmlspecialchars(mysqli_real_escape_string($con, $_GET['course']));
$query = "SELECT DISTINCT course, topic FROM course WHERE course = '$course'";
$result = mysqli_query($con, $query);

?>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Course-Precept</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/prae.png">	
    <link href="css/find-tutor.css" rel="stylesheet"/>
</head>
<body bgcolor="#e3e3e3">
<div class="scroll_header2"><?php if(@$_SESSION['user_id']){include('includes/header2.php');}else{include('includes/header.php');} ?></div>
<div id="view_course_part1"><p><?php echo $course; ?></p></div>
<?php
if(@mysqli_num_rows($result) > 0){
	while($rows = mysqli_fetch_assoc($result)){
		$topic = $rows['topic'];
		$img = mysqli_query($con, "SELECT * FROM course WHERE course = '$course' AND topic ='$topic'");
        $img_info = mysqli_fetch_array($img);
        $img_name = $img_info['img_name'];
?>

    <div id="view_course_part2">
    <div class="course1">
	    <div class="d-main">
            <div class="d1"><img src="c-images/<?php echo $img_name; ?>"/></div>
            <div class="d2">
                <p>The complete <b><?php echo $rows['topic']; ?></b> course learn step by step</p>
                <p><img src="images/star.png"><img src="images/star.png"><img src="images/star.png"><img src="images/star.png"><img src="images/blank-star.png" align="top"></p>
                <p><a href="chapter.php?course=<?php echo $course; ?>&topic=<?php echo $rows['topic']; ?>&lession=Introduction">Learn this course</a></p>
            </div>
        </div>
	</div>
</div>
</div>
</div>
</body>
</html>

<?php
}
}
else{
	$no_course = "There is no course available right now";
}
}
?>