<?php @session_start(); ?>
<div class="scroll_header2"><div class="scroll_logo3"><a href="home.php" style="text-decoration:none;color:#00a5bb;">PRECEPT</a></div>
    <div class="scroll_nav3"> 
	    <ul>
            <li><a href="home.php">HOME</a></li>
            <li><a href="becometutor.php">BECOME A TUTOR</a></li>
            <li class="dropdown"><a href="account.php" class="dropbtn">Hi <?php echo substr($_SESSION['user_name'], 0, 4); ?>&nbsp;<img src="images/drop-down-arrow.png" align="top"/></a>
                <div id="myDropdown" class="dropdown-content">
                    <a href="account.php" class="dropdown-linkw">Account</a>
                    <a href="logout.php" class="dropdown-linkw">logout</a>
                </div>
            </li>
        </ul>
    </div>
    <div class="clear"></div>
</div>