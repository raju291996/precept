<?php 
session_start();
if(@!$_SESSION["user_name"]) {
?>
<html>
<head>
<link rel="icon" type="image/png" href="images/prae.png">
 <title>PRECEPT - Find your tutor</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="js/jquery-2.2.3.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/main.css"/>
  <style>

      
  </style>  
</head>
<body>
    <div class="prae-header">
        <div class="nav">
            <div class="logo"><a href="index.php">PRECEPT</a></div>
             <div class="menu">
                <ul class="topnav" id="myTopnav">
                    <li><a href="index.php" class="reslink">HOME</a></li>
                    <li><a href="becometutor.php" class="">BECOME A TUTOR</a></li>
                    <li><a href="login.php" class="signin">SIGNIN</a></li>
                    <li class="icon"><a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">☰</a></li>
                </ul>
             </div>
            <div class="clear"></div>
        </div>
        <div class="msg">
            <p>CHOOSE BETTER, LEARN BETTER</p>
            <p>Study comprehensively for CBSE and ICSE and State Board</p>
            <button class="pop">FIND A TUTOR</button>
        </div>
    </div>
	
<div class="offers" id="offers">
        <div class="start">
            <span class="ofer">What we offers?</span><hr width="8%" align="center" color="#3a6ea5"/>
        </div>
        <div class="offer_div">
          <div class="proffer">
            <div class="offer"><img src="images/best-tutors.png"/><p>Best Tutors</p></div>
            <div class="offer"><img src="images/concept-sheet.png"/><p>Concept Sheets</p></div>
            <div class="offer"><img src="images/adptive-practice.png"/><p>Adaptive Practice</p></div>
            <div class="offer"><img src="images/question-set.png"><p>Question Sets</p></div>
            <div class="clear"></div>
          </div>
        </div>
    </div>
    <div class="prae-course">
        <div class="text">Available Courses</div>
        <hr width="8%" align="center" color="#3a6ea5"/>
        <div id="all-course">
     <div class="course-avail">
        <div class="course-sheet">
            <div class="cs1 img1">
               <div class="sub">Commerce</div>
            </div>
           <div class="cs2">
             <a href="course.php?course=Commerce">view this course</a>
           </div>
       </div>
        <div class="course-sheet">
            <div class="cs1 img2">
               <div class="sub">Mathematics</div>
            </div>
           <div class="cs2">
             <a href="course.php?course=Mathematics">view this course</a>
           </div>
       </div>
       <div class="course-sheet">
            <div class="cs1 img3">
               <div class="sub">Physics</div>
            </div>
           <div class="cs2">
             <a href="course.php?course=Physics">view this course</a>
           </div>
       </div>
       <div class="clear"></div>
    </div>
     <div class="course-avail">
        <div class="course-sheet">
            <div class="cs1 img4">
               <div class="sub">Social Study</div>
            </div>
           <div class="cs2">
             <a href="course.php?course=Social Study">view this course</a>
           </div>
       </div>
        <div class="course-sheet">
            <div class="cs1 img5">
               <div class="sub">English</div>
            </div>
           <div class="cs2">
             <a href="course.php?course=English">view this course</a>
           </div>
       </div>
       <div class="course-sheet">
            <div class="cs1 img6">
               <div class="sub">Arts</div>
            </div>
           <div class="cs2">
             <a href="course.php?course=Arts">view this course</a>
           </div>
       </div>
       <div class="clear"></div>
    </div>
     <div class="course-avail">
        <div class="course-sheet">
            <div class="cs1 img7">
               <div class="sub">Computer</div>
            </div>
           <div class="cs2">
             <a href="course.php?course=Computer">view this course</a>
           </div>
       </div>
        <div class="course-sheet">
            <div class="cs1 img8">
               <div class="sub">Chemistry</div>
            </div>
           <div class="cs2">
             <a href="course.php?course=Chemistry">view this course</a>
           </div>
       </div>
       <div class="course-sheet">
            <div class="cs1 img9">
               <div class="sub">Biology</div>
            </div>
           <div class="cs2">
             <a href="course.php?course=Biology">view this course</a>
           </div>
       </div>
       <div class="clear"></div>
    </div>   
 </div>
    </div>
    <div class="prae-classes">
        <div class="text">Available Classes</div>
        <hr width="8%" align="center" color="#3a6ea5"/>
        <div class="level">
            <div class="l1"><div>8</div></div>
            <div class="l1"><div>9</div></div>
            <div class="l1"><div>10</div></div>
            <div class="l1"><div>11</div></div>
            <div class="l1"><div>12</div></div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="prae-search">
        <div class="text">Discover unlimited material</div>
        <hr width="8%" align="center" color="#3a6ea5"/>
        <div class="search">
            <div>
			    <form action="search_result.php" method="post">
                    <div class="form f-input"><input type="text" name="prae_search" class="input-search" placeholder="Search any topic Like matrix and hit enter...."/></div>
                    <div class="form f-btn"><input type="button" name="prae_submit" value="Search" class="input-btn"/></div>
                    <div class="clear"></div>
                </form>
				<div id="suggesstion-box"></div>
			</div>
        </div>
    </div>
    <div class="feedback">
        <div class="talk">
            <span class="talk1">What Students are saying</span>
            <hr width="8%" align="center" color="#3a6ea5"/>  
        </div>
        <div class="reviews">
            <div class="mySlides">
               <div class="user_img users"><img src="images/user-image.png"/></div>
               <div class="user_review users">
                  <span>"Instant reports allowed me to keep track of my progress and refine my exam strategy. Extremely useful app to have."</span>
                  <p>Nimish Agrawal, Class 8th</p>
               </div>
               <div class="clear"></div>
            </div>
            <div class="mySlides">
               <div class="user_img users"><img src="images/user-image.png"/></div>
               <div class="user_review users">
                  <span>"Praeceptore app saved a lot of my time during revision. It's a complete package for students preparing for boards as well as competitive exams."</span>
                  <p>Raja Dhanaseyan, Class 10th</p>
               </div>
               <div class="clear"></div>
            </div>
            <div class="mySlides">
               <div class="user_img users"><img src="images/user-image.png"/></div>
               <div class="user_review users">
                  <span>"Only adaptive platform I know of, questions became more challenging as I improved. Strongly recommended!"</span>
                  <p>Param Malhotra, Class 12th</p>
               </div>
               <div class="clear"></div>
            </div>
            <div class="mySlides">
               <div class="user_img users"><img src="images/user-image.png"/></div>
               <div class="user_review users">
                  <span>"Questions really made us think beyond limits and makes me think outside the box. I definitely recommend Praeceptore."</span>
                  <p>Rishika Sahoo, Class 11th</p>
               </div>
               <div class="clear"></div>
            </div>
            <div class="mySlides">
               <div class="user_img users"><img src="images/user-image.png"/></div>
               <div class="user_review users">
                  <span>"The difficulty level of questions at praeceptore is what is needed for a tough exam like JEE. The question bank was a big help too. Excellent work Praeceptore!"</span>
                  <p>Atish Sharma, Class 12th</p>
               </div>
               <div class="clear"></div>
            </div>
            <div class="slider">
                 <span class="dot" onclick="currentSlide(0)"></span>
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
                <span class="dot" onclick="currentSlide(4)"></span>
            </div>
        </div>
        
    </div>
    <div class="contact">
        <div class="cta-tittle">
            <span class="tittle">Contact Our Support Helpdesk</span><br><br>
            <p class="subtittle">You can contact us from Monday-Saturday from 9:00AM to 6:00PM</p>
        </div>
        <div class="cta-section">
            <div class="cta-col col1"><a href="#"><span class="faq">GENERAL QESTIONS?</span><br><span class="coln">View FAQs</span></a></div>
            <div class="cta-col col2 "><span class="faq">CONTACT BY PHONE</span><br> <span class="coln">+91 9694171246</span></div>
            <div class="cta-col col3"><a href="#"><span class="faq">CONTACT BY EMAIL</span><br><span class="coln">Send us an Email</span></a></div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="footer">
        <div class="col-md3 usefull">
            <span class="links">Usefull Links</span>
            <ul>
                <li><a href="becometutor">Become Tutor</a></li>
                <li><a href="signup.php">Students signup</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="home.php">Home</a></li>
                
            </ul>
        </div>
        <div class="col-md3 about">
            <span class="links">Learn More</span>
            <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">Feedback</a></li>
                <li><a href="#">Login</a></li>
                <li><a href="#">Terms</a></li>
            </ul>
        </div>
        <div class="col-md3 social">
            <span class="links">Follow Us</span>
            <ul>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Linkedin</a></li>
                <li><a href="#">GooglePlus</a></li>
            </ul>
        </div>
        <div class="col-md3 playstore">
            <span class="links">We also available </span>
            
            <img src="images/footer.png" width="200px" height="60px"/>
        </div>
        <div class="clear"></div>
    </div>
    <div class="copyright">
        <span class="right">© 2016 precept.com - All Rights Reserved.</span>
    </div>
    <div class="user-login-popup">
        <div class="popup-inner">
            <div class="popup-close">
                <div class="float-left"><b>FIND YOUR TUTOR</b></div>
                <div class="float-right"><img src="images/close.png" width="24px" height="24px"/></div>
				<div class="clear"></div>
            </div>
     <div class="main-find-tutor-page">
    <div class="find-tutor-html">
        <div class="find-tutor-header1">
            <div class="find-tutor-img1 quotes-img"><img src="images/tutor-student-connect.png" alt="Image not available" width="100px" height="100px"/></div>
            <div class="find-tutor-quotes1 quotes-img"><p>It's the <b>teacher</b> that makes the difference<br>not the <b>classroom</b></p></div>
            <div class="clear"></div>
        </div>
        <div class="find-tutor-info1">
            <div class="find-tutor-error1"></div>
            <div class="find-tutor-box1">
                <form action="tutorresult.php" method="post" class="find-tutor-form1">
                    <select name="standard" class="class">
                        <option value="12 standard">12 standard</option>
						<option value="11 standard">11 standard</option>
						<option value="10 standard">10 standard</option>
                        <option value="8 standard">9 standard</option>
                        <option value="9 standard">8 standard</option>
                    </select>
                   <select name="subject" class="subject">
                        <option value="Mathematics">Mathematics</option>
                        <option value="Arts">Arts</option>
                        <option value="Biology">Biology</option>
                        <option value="Chemistry">Chemistry</option>
                        <option value="Commerce">Commerce</option>
                        <option value="Computer">Computer</option>
                        <option value="English">English</option> 
                        <option value="Physics">Physics</option>
                        <option value="Social Study">Social Study</option>
                    </select>
                    <select name="city" class="City">
					    <option value="Delhi">Delhi</option>
                        <option value="Ahmedabad">Ahmedabad</option>
						<option value="Bengaluru">Bengaluru</option>
						<option value="Chandigarh">Chandigarh</option>
						<option value="Chennai">Chennai</option>
						<option value="Dehradoon">Dehradoon</option>
                        <option value="Hyderabad">Hyderabad</option>
                        <option value="Jaipur">Jaipur</option>
						<option value="Kota">Kota</option>
                        <option value="Mumbai">Mumbai</option>   
                    </select> 
                    <input type="submit" name="submit" value="Next" class="submit-btn"/>
                </form>
            </div>
        </div>
    </div>
    </div>
        </div>
    </div>

   
<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
    
$(function() {
    //----- OPEN
    $('.pop').on('click', function(e)  {
        $('.user-login-popup').fadeIn(350);
        e.preventDefault();
    });
 
    //----- CLOSE
    $('.float-right').on('click', function(e)  {
        $('.user-login-popup').fadeOut(350);
        e.preventDefault();
    });
});

$(document).ready(function(){
	$(".input-search").keyup(function(){
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data:'prae-search='+$(this).val(),
		beforeSend: function(){
			$(".input-search").css("color","teal");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$(".input-search").css("background","#FFF");
			
		}
		});
	});
});

    function selectResult(val) {
    $(".input-search").val(val);
    $("#suggesstion-box").hide();
    }
    

    </script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>
<?php
}
else{
	header("Location:home.php");
}