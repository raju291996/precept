<?php
include_once('includes/Dbconfig.php');
include_once('session.php');
$error = false;
if(isset($_GET['course']) & isset($_GET['topic']) & isset($_GET['lession'])){
$course = htmlspecialchars(mysqli_real_escape_string($con, $_GET['course']));
$topic = htmlspecialchars(mysqli_real_escape_string($con, $_GET['topic']));
$lession = htmlspecialchars(mysqli_real_escape_string($con, $_GET['lession']));
$query1 = "SELECT * FROM course WHERE course = '$course' AND topic ='$topic'";
$result = mysqli_query($con, $query1);
$pdf = mysqli_query($con, "SELECT * FROM course WHERE course = '$course' AND topic ='$topic' AND sub_topic = '$lession'");
$pdf_info = mysqli_fetch_array($pdf);
$pdf_name = $pdf_info['pdf_name'];
?>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Course-Precept</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/prae.png">	
    <link href="css/find-tutor.css" rel="stylesheet"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<style>
	.course-topic-list p .<?php echo preg_replace('/\s+/', '', $lession);?> {background-color: teal;}
	</style>
</head>
<body bgcolor="#e3e3e3">
<div class="scroll_header2"><?php if(@$_SESSION['user_id']){include('includes/header2.php');}else{include('includes/header.php');} ?></div>
<div id="view_course_partU"><p><?php echo $course; ?> / <span class="topic"><?php echo $topic; ?> / </span> <span class="lession"><?php echo $lession; ?></span></p></div>
<div class="view-this-course">
<div class="course-topic-list ctl">
<?php
if(mysqli_num_rows($result) > 0){
	while($rows = mysqli_fetch_assoc($result)){
?>
   <p><a href="chapter.php?course=<?php echo $course;?>&topic=<?php echo $topic;?>&lession=<?php echo $rows['sub_topic'];?>" class="<?php echo preg_replace('/\s+/', '', $rows['sub_topic']);?>"><?php echo $rows['sub_topic']; ?></a></p>
<?php
}
}
?> 
</div>
<div class="prae-course-sheet ctl">   
    <div class="tabs-header">
        <ul class="tab">
           <li><a href="javascript:void(0)" class="tablinks defaultOpen" onclick="openSub(event, 'Theory')" id="defaultOpen">Theory</a></li>
           <li><a href="javascript:void(0)" class="tablinks removeDefault" onclick="openSub(event, 'Practice')">Practice</a></li>
           <li><a href="javascript:void(0)" class="tablinks removeDefault" onclick="openSub(event, 'Questions')">Questions</a></li>
           <li><a href="javascript:void(0)" class="tablinks removeDefault" onclick="openSub(event, 'Quiz')">Quiz</a></li>
        </ul>
    </div>
	<div class="tabs-desc">
        <div id="Theory" class="tabcontent">
           <embed src="pdf_course/<?php echo $pdf_name; ?>.pdf" style="width:96%;height:100%;margin:20px 2%;">
        </div>
        <div id="Practice" class="tabcontent">
           <p>No content available right now</p>
        </div>
        <div id="Questions" class="tabcontent">
           <p>No content available right now.</p>
        </div>
		<div id="Quiz" class="tabcontent">
		<p class="quiz-info" style="color:#333;border:0px solid #990;text-align:center;padding:10px;">We suggest you to go for quiz after finishing this chapter because quiz cover entire chapter.</p>
		<form class="quiz_check" method="post" action="quiz_check.php">
<?php
$query2 = mysqli_query($con, "SELECT * FROM quiz WHERE subject= '$course' AND topic= '$topic' ORDER BY RAND() LIMIT 10");
if(mysqli_num_rows($query2) > 0){
	$z=0;
	while($result = mysqli_fetch_assoc($query2))
	{
?>
        <div class="start_quiz">
            <p>Q<?php echo ++$z; ?>. <?php echo $result['question']; ?></p>
            <label><input type="radio" value="A" name="<?php echo $result['id']; ?>" class="quizA"/><?php echo $result['optiona']; ?></label><br>
            <label><input type="radio" value="B" name="<?php echo $result['id']; ?>" class="quizA"/><?php echo $result['optionb']; ?></label><br>
            <label><input type="radio" value="C" name="<?php echo $result['id']; ?>" class="quizA"/><?php echo $result['optionc']; ?></label><br>
            <label><input type="radio" value="D" name="<?php echo $result['id']; ?>" class="quizA"/><?php echo $result['optiond']; ?></label>
	        <input type="radio" checked='checked' style='display:none' value="5" name='<?php echo $result['id'];?>'/> 
        </div>
<?php	   
	}
?>
    <div class="quiz_submit"><button name="quiz_submit">Submit</button></div>
		</form>
<?php
}
else{
	echo "Sorry, no quiz available for this chapter";
}
}
?>
	   </div>
    </div>
</div>   
</div>    
<script>
function openSub(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

$(document).ready(function(){
    $('.removeDefault').click(function(){
        $('#defaultOpen').removeClass('defaultOpen');
    });
});    
    
</script>
  </body>
  </html>