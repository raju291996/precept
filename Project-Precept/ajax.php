<?php
include_once('includes/Dbconfig.php');
include_once('session.php');

if(isset($_POST['prae-search']) && $_POST['prae-search'] !=""){

	$searchquery = preg_replace('#[^a-z 0-9?!]#i','', $_POST['prae-search']);
	$sqlCommand = "SELECT * from course WHERE sub_topic LIKE '%$searchquery%' OR topic LIKE '%$searchquery%' LIMIT 10";  
    $query = mysqli_query($con,$sqlCommand);
	$count = mysqli_num_rows($query);
	if($count > 0){
		
?>
<ul id="result-lists">
	<?php
	foreach ($query as $result_lists){
	?>
	<li onClick="selectResult('<?php echo $result_lists["sub_topic"]; ?>');"><?php echo $result_lists["sub_topic"]; ?></li>
	<?php } ?>
	</ul>
<?php } } ?>
