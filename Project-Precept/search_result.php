<?php
include_once('includes/Dbconfig.php');
include_once('session.php');
?>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Precept</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/prae.png">	
    <link href="css/find-tutor.css" rel="stylesheet"/>
</head>
<body>
<div class="scroll_header2"><?php if(@$_SESSION['user_name']){include('includes/header2.php');}else{include('includes/header.php');} ?></div>
<?php
//if(isset($_POST['prae_submit'])){
if(isset($_POST['prae_search']) && $_POST['prae_search'] !=""){

    $searchquery = preg_replace('#[^a-z 0-9?!]#i','', $_POST['prae_search']);
	$sqlCommand = "SELECT * from course WHERE sub_topic LIKE '%$searchquery%' OR topic LIKE '%$searchquery%'";
	//$sqlCommand = "SELECT *, MATCH(sub_topic, topic) AGAINST('$searchquery') AS score FROM course WHERE MATCH(sub_topic, topic) AGAINST('$searchquery') ORDER BY score DESC";  
    $query = mysqli_query($con,$sqlCommand);
	$count = mysqli_num_rows($query);

    if($count > 0){
?>

<div class='search-resulttt'>
	<p><?php echo "<b>$count</b> results for your search query<b> $searchquery </b>";?></p>
	<table>
	<tr><th>Course Name</th><th>Topic</th><th>Sub Topic</th><th>View</th><th>Download</th></tr>
	
<?php	
		while($row = mysqli_fetch_array($query)){
			$course = $row['course'];
			$topic = $row['topic'];
			$sub_topic = $row['sub_topic'];
?>
<tr>
<td><?php echo $course; ?></td>
<td><?php echo $topic; ?></td>
<td><?php echo $sub_topic; ?></td>
<td><a href="chapter.php?course=<?php echo $course;?>&topic=<?php echo $topic;?>&lession=<?php echo $sub_topic; ?>">View</a></td>
<td><a href="pdf_course/<?php echo $course;?>-<?php echo $topic;?>-<?php echo $sub_topic;?>.pdf" Download>Download</a></td>
</tr>
<?php } } ?>
</table>
</div>



<?php
    
	if($count == 0){
?>
		<div class="resulttt">
		    <p>0 result for your search query </b> <?php echo $searchquery; ?> </b></p>
		</div>
	
<?php }  } ?>
