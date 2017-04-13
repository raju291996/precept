<?php session_start();
?>
<html>
<head>
    <meta charset="UTF-8" />
     <title>PRECEPT - find tutor</title>
	 <link rel="icon" type="image/png" href="images/prae.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="css/find-tutor.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body bgcolor="#fff">
<?php if(@$_SESSION['user_id']){include('includes/header2.php');}else{include('includes/header.php');} ?>
<div class="tutor-result-main-div">
<div>

<?php

include_once('includes/Dbconfig.php');

$num_rec_per_page=10;
    if (isset($_GET["page"])) { 
        $page  = mysqli_real_escape_string($con, $_GET["page"]);
	} 
	else { 
	    $page=1; 
	}
$start_from = ($page-1) * $num_rec_per_page;

if(isset($_POST['submit'])){
	
	$standard = $_POST['standard'];
	$subject = $_POST['subject'];
	$city = $_POST['city'];
    $standard = mysqli_real_escape_string($con, $standard);
	$standard = htmlentities($standard);
	$subject = mysqli_real_escape_string($con, $subject);
	$subject = htmlentities($subject);
	$city = mysqli_real_escape_string($con, $city);
	$city = htmlentities($city);	
	$query = "SELECT * FROM tutor_list WHERE tutor_subjects = '$subject' AND tutor_class = '$standard' AND tutor_city = '$city'  ORDER BY tutor_rating DESC LIMIT $start_from, $num_rec_per_page";
	$result = mysqli_query($con, $query);
	$rows = @mysqli_num_rows($result);
    if($rows > 0){
		while($data = mysqli_fetch_assoc($result)){
			$tutor_id = $data['tutor_id']; 
		    $tutor_name = $data['tutor_name'];
			$tutor_city = $data['tutor_city'];
			$tutor_class = $data['tutor_class'];
			$tutor_subjects = $data['tutor_subjects'];
			$tutor_rating = $data['tutor_rating'];
			$tutor_skills = $data['tutor_skills'];
			$tutor_qualifications = $data['tutor_qualifications'];
			$tutor_description = substr($data['tutor_desccription'], 0, 150);
	        $tutor_id = "7258".$tutor_id;
?>
        <div class="find-tutor-div">
        <div class="find-tutor-image find-tutor-imageinfo"><img src="images/boss.png" alt="tutor-image"/></div>
        <div class="find-tutor-info find-tutor-imageinfo">
            <div class="find-tutor-short-info find-tutor-infolink">
                <p class="find-tutor-name-rating"><span><?php echo $tutor_name; ?></span>&nbsp;&nbsp;&nbsp;<?php echo $tutor_rating ; ?>/5</p>
                <p class="find-tutor-skills"><?php echo $tutor_skills ; ?></p>
                <p class="find-tutor-desc" style="font-size:14px;"><?php echo $tutor_description ; ?> .........</p>
            </div>
            <div class="find-tutor-profile-link find-tutor-infolink"><p><a href="tutorprofile.php?tutorid=<?php echo $tutor_id;?>">VIEW PROFILE</a></p></div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>

<?php
		}	
?>
</div>
<div class="find-tutor-pagination">
<?php
    $query = "SELECT * FROM tutor_list WHERE tutor_subjects = '$subject' AND tutor_class = '$standard' AND tutor_city = '$city'  ORDER BY tutor_rating DESC";
    $result = mysqli_query($con, $query);
    $total_records = mysqli_num_rows($result);
    $total_pages = ceil($total_records / $num_rec_per_page); 
    $prev = $page - 1;	
    $next = $page + 1;
    $targetpage = "tutorresult.php";
    $lastpage = ceil($total_pages/$num_rec_per_page);
    $LastPagem1 = $lastpage - 1;
    $stages = 3;
    $paginate = " ";

    if($lastpage > 1){
	
	    $paginate .= "<div class='paginate'>";
	
	    if($page > 1){
		    $paginate .= "<a href='$targetpage?page=$prev'>Previous</a>";
	    }
	    else{
		    $paginate .= "<span class='disabled'>previous</span>";
	    }
	
	    if($lastpage < 7 + ($stages * 2)){
		    for($i=1; $i <= $lastpage; $i++){
			    if ($i == $page){
					$paginate .= "<span class='current'>$i</span>";
			    }
			    else{
					$paginate .= "<a href='$targetpage?page=$i'>$i</a>";
			    }
		    }
	    }
	    else if($lastpage > 5 + ($stages * 2)){
		    if($page < 1 + ($stages * 2)){
		        for($i=1; $i < 4 + ($stages * 2); $i++){
			        if ($i == $page){
					    $paginate .= "<span class='current'>$i</span>";
			        }else{
				        $paginate .= "<a href='$targetpage?page=$i'>$i</a>";
				    }
			    }
		        $paginate .= "...";
			    $paginate .= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
			    $paginate .= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";
		    }
		    else if($lastpage -($stages * 2) > $page && $page > ($stages * 2)){
			    $paginate .= "<a href='$targetpage?page=1'>1</a>";
			    $paginate .= "<a href='$targetpage?page=2'>2</a>";
			    $paginate .= "...";
			    for($i=$page-$stages; $i <= $page + $stages; $i++){
				    if ($i == $page){
					    $paginate .= "<span class='current'>$i</span>";
			        }else{
				        $paginate .= "<a href='$targetpage?page=$i'>$i</a>";
				    }
			    }
			    $paginate .= "...";
			    $paginate .= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
			    $paginate .= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";
		    }
		    else{
			    $paginate .= "<a href='$targetpage?page=1'>1</a>";
			    $paginate .= "<a href='$targetpage?page=2'>2</a>";
			    $paginate .= "...";
			    for($i=$lastpage-(2 + ($stages * 2)); $i <= $lastpage; $i++){
				    if ($i == $page){
					    $paginate .= "<span class='current'>$i</span>";
			        }else{
				        $paginate .= "<a href='$targetpage?page=$i'>$i</a>";
				    }
			    }
		    }
	    }
	
	    if($lastpage != $page){
		    $paginate .= "<a href='$targetpage?page=$next'>Next</a>";
	    }
	    else{
		    $paginate .= "<span class='disabled'>previous</span>";
	    }
	
	    $paginate .= "</div>";			
     }

      echo $paginate;



    }// for close rows>0

	else{
		echo "No result found";
	}
	
}	
mysqli_close($con);
?>
</div>
</div>

<script type="text/javascript" src="js/script.js"></script>
</body>
</html>
        



