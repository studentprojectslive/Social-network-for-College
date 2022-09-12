<?php
session_start();
date_default_timezone_set(Asia/Kolkata);
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT &  ~E_WARNING);
$dt= date("Y-m-d");
$tim = date("h:i:s");
$dttim = date("Y-m-d h:i:s");
$_SESSION[project_title] = "College Social Network";
include("dbconnection.php");
if(isset($_SESSION[student_id]))
{
  $sqlstudent = "SELECT * FROM student WHERE student_id=$_SESSION[student_id]";
  $qsqlstudent = mysqli_query($con,$sqlstudent);
  $rsstudent = mysqli_fetch_array($qsqlstudent);
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $_SESSION[project_title]; ?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/animate.css">
<link rel="stylesheet" type="text/css" href="assets/css/font.css">
<link rel="stylesheet" type="text/css" href="assets/css/li-scroller.css">
<link rel="stylesheet" type="text/css" href="assets/css/slick.css">
<link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.css">
<link rel="stylesheet" type="text/css" href="assets/css/theme.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<!--[if lt IE 9]>
<script src="assets/js/html5shiv.min.js"></script>
<script src="assets/js/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>

<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">
  <header id="header">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_top">
          <div class="header_top_left">
            <ul class="top_nav">
              <li><a href="index.php">Home</a></li>
              <li><a href="about.php">About</a></li>
              <li><a href="contact.php">Contact</a></li>
            </ul>
          </div>
          <div class="header_top_right">
            <p> <?php echo date("l, F d Y  h:i  A"); ?> </p>
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_bottom">
        <a href="index.php" class="logo"><img src="images/bveclogo.jpg" alt="" style="height:100px;" align="left"></a>
        </div>
      </div>
    </div>
  </header>
  <section id="navArea">
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav main_nav">
          <li class="active"><a href="index.php"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Home</span></a></li>
          
          <?php
		   if(!isset($_SESSION[user_id]) && !isset($_SESSION[student_id]))
       		 {
		  ?>
          <li><a href="student.php">Student Registration Panel</a></li>
          <li><a href="studentlogin.php">Student Login Panel</a></li>
          <li><a href="userlogin.php">Staff Login Panel</a></li>
          <li><a href="studentforgetpassword.php">Forget Password</a></li>   
          <?php
			 }
		 ?>                 
      <?php  
	  	if(isset($_SESSION[user_id]))
        { 
		?>
          <li><a href="dashboard.php">Dashboard</a></li>
           <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Monitor</a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="viewstudent.php">View Students</a></li>
              <li><a href="viewtimeline.php">Timeline records</a></li>
             </ul>
<?php
if($_SESSION[user_type] == "Admin")
{
?>
<li><a href="viewdiscussion.php">Discussion</a></li>
<?php
}
else
{
?>
<li><a href="discussiondisplay.php">Discussion</a></li>
<?php
}
?>
           <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Study material</a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="studymaterial.php">Upload Study Material</a></li>
              <li><a href="viewstudymaterial.php">View Study Materials</a></li>
              </ul>
              </li>
               
              <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Quiz</a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="quiz.php">Add Quiz</a></li>
              <li><a href="viewquiz.php">View Quiz</a></li>
              <li><a href="quizresultstaff.php">View result</a></li>
              </ul>  
              </li>
              
           <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Notice</a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="notice.php">Add notice</a></li>
              <li><a href="viewnotice.php">View notice</a></li>
              </ul>
              </li>
              
          <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Profile</a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="userprofile.php">Profile</a></li>
              <li><a href="changepassworduser.php">Change Password</a></li>
          	<?php
		  	if($_SESSION[user_type] == "Admin")
		  	{
		  	?>
                      <li><a href="user.php">Add user</a></li>
                      <li><a href="viewuser.php">View user</a></li>
                      <li><a href="addstudentprofile.php">Add Student profile</a></li>
                      <li><a href="viewstudentprofile.php">View Student profile</a></li>
          	<?php
			}
			?>
            </ul>
          </li>
          <?php
		  if($_SESSION[user_type] == "Admin")
		  {
		  ?>
                  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Settings</a>
                    <ul class="dropdown-menu" role="menu">
                      
                      <li><a href="subject.php">Add subject</a></li>
                      <li><a href="viewsubject.php">View subject</a></li>
                      
                      <li><a href="course.php">Add course</a></li>
                      <li><a href="viewcourse.php">View course</a></li>
                    </ul> 
                  </li>
          <?php
		}
		?>
          <li><a href="logout.php">Logout</a></li>
        <?php  
			}
          if(isset($_SESSION[student_id]))
		  { 
		?>
            <li><a href="wallpost.php">Timeline</a></li>
            <li><a href="groupchat.php">Group chat</a></li>
            
            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Discussion</a>
            	<ul class="dropdown-menu" role="menu">
              		<li><a href="discussion.php">Add New</a></li>
              		<li><a href="discussiondisplay.php">View Discussion</a></li>
              	</ul>
           	</li>
            
            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Quiz</a>
            	<ul class="dropdown-menu" role="menu">
              		<li><a href="displayquiz.php">Attend quiz</a></li>
              		<li><a href="quizresultstaff.php">Quiz result</a></li>
              	</ul>
           	</li>
              
            <li><a href="displaystudymaterial.php">Study Materials</a></li>
             <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Profile</a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="studentprofile.php">Update Profile</a></li>
                  <li><a href="changepasswordst.php">Change Password</a></li>
                </ul>
            </li>
             <li><a href="logout.php">Logout</a></li>
             <?php }
			 ?>
      </div>
    </nav>
  </section>
  <section id="newsSection">
    <div class="row"> 
      <div class="col-lg-12 col-md-12">
        <div class="latest_newsarea"> <span>Latest News</span>
          <ul id="ticker01" class="news_sticker">
			<?php
            $sql= "SELECT * from notice WHERE date_time < $dttim";
            $qsql=mysqli_query($con,$sql);
            while($rsrec = mysqli_fetch_array($qsql))
           {     	
			 echo "<li style=color:white;><img src=images/newsicon.jpg><a href=single_page.php?noticeid=$rsrec[0]&noticetype=Events>$rsrec[title]</a> | </li> ";
		   }
		   ?>
          </ul>
          <div class="social_area">
            <ul class="social_nav">
              <li class="facebook"><a href="#"></a></li>
              <li class="twitter"><a href="#"></a></li>
              <li class="flickr"><a href="#"></a></li>
              <li class="pinterest"><a href="#"></a></li>
              <li class="googleplus"><a href="#"></a></li>
              <li class="vimeo"><a href="#"></a></li>
              <li class="youtube"><a href="#"></a></li>
              <li class="mail"><a href="#"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>