<?php
include_once('includes/Dbconfig.php');
include('session.php');
?>

<html>
<head>
    <meta charset="UTF-8" />
    <title>Precept - Quiz Result</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/prae.png">	
    <link href="css/find-tutor.css" rel="stylesheet"/>
</head>
<body>
<div class="scroll_header2"><?php if(@$_SESSION['user_id']){include('includes/header2.php');}else{include('includes/header.php');} ?></div>

<?php
if(isset($_POST['quiz_submit'])){
   $keys = array_keys($_POST);
   $order = join(",", array_slice($keys,0,10));
   //echo $order."<br>";
   $response = mysqli_query($con, "select * from quiz where id IN($order) ORDER BY FIELD(id,$order) LIMIT 10");
   $right_answer=0;
   $wrong_answer=0;
   $unanswered=0;
   $z=10;
   //echo $rows = @mysqli_num_rows($response);
   while($result = @mysqli_fetch_assoc($response)){
       if($result['answer']==$_POST[$result['id']]){
            $right_answer++;
        }else if($_POST[$result['id']]==5){
            $unanswered++;
        }
        else{
            $wrong_answer++;
        }
       
   }
	
}
?>
<div class="q-answer" style="background:#fff;box-shadow:0px 0px 6px #999;width:40%;margin:50px 30%;color:#3ae;text-align:center;padding:20px;">
    <p>Right Answer : <?php echo $right_answer; ?></p>
    <p>Wrong Answer : <?php echo $wrong_answer; ?></p>
    <p>Unanswered : <?php echo $unanswered; ?></p>
    <p>Score : <?php echo $right_answer*$z.'%'; ?></p>
</div>