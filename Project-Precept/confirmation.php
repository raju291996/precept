<?php

include_once('includes/Dbconfig.php');

if(isset($_GET['passkey']) && !empty($_GET['passkey'])){
	
	$passkey = $_GET['passkey'];
	$passkey = mysqli_real_escape_string($con, $passkey);
         $passkey = htmlspecialchars($passkey);
	$query = "SELECT * FROM login WHERE user_email_confcode ='$passkey'";
    $result = mysqli_query($con, $query);
	
	if($result){
	
        $count = mysqli_num_rows($result);
		

        if($count > 0){
			
			$query2 = "UPDATE login set active = '1', user_email_confcode = '0' WHERE user_email_confcode = '$passkey' AND active = '0'";
			
			if(mysqli_query($con, $query2)){
				echo "Your account has been activated, you can now login <a href='mypraeceweb.esy.es'>Praceceptore</a>";
			}
			else{
				echo "there is an error ";
			}
        }
		else{
			
			echo "The url is either invalid or you already have activated your account.";
		}
	}
	else{
		echo "Invalid approach, please use the link that has been send to your email.";
	}
}



