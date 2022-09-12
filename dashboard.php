<?php
include("header.php");
if(!isset($_SESSION[user_id]))
{
	echo "<script>window.location=userlogin.php;</script>";
}
?>
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2>Dashboard</h2>
            <ul class="spost_nav">
              <li>
                <div class="media wow fadeInDown"> <a href="#" class="media-left"> <img alt="" src="images/chat.jpg"> </a>
                  <div class="media-body"> <a href="#" class="catg_title"> Number of Chat records<br />
<h2> 
<?php
$sql = "SELECT * FROM chat";
$qsql= mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>
</h2></a> </div>
                </div>
              </li>
              <li>
                <div class="media wow fadeInDown"> <a href="#" class="media-left"> <img alt="" src="images/chatmsg.jpg"> </a>
                  <div class="media-body"> <a href="#" class="catg_title">Number of Chat Message records<br/>
                  <h2>
                  <?php
				  $sql= "SELECT * FROM chat_message";
				  $qsql= mysqli_query($con,$sql);
                  echo mysqli_num_rows($qsql);
                  ?>
                  </h2></a> </div>
                </div>
              </li>
              <li>
                <div class="media wow fadeInDown"> <a href="#" class="media-left"> <img alt="" src="images/course.jpg"> </a>
                  <div class="media-body"> <a href="#" class="catg_title">Number of Course records<br/>
                  <h2>
                   <?php
				  $sql= "SELECT * FROM course";
				  $qsql= mysqli_query($con,$sql);
                  echo mysqli_num_rows($qsql);
                  ?>
                  <h2></a> </div>
                </div>
              </li>
              <li>
                <div class="media wow fadeInDown"> <a href="#" class="media-left"> <img alt="" src="images/discussion.jpg"> </a>
                  <div class="media-body"> <a href="#" class="catg_title">Number of discussion records<br/>
                  <h2>
                  <?php
				  $sql= "SELECT * FROM discussion";
				  $qsql= mysqli_query($con,$sql);
                  echo mysqli_num_rows($qsql);
                  ?>
                  </h2></a> </div>
                </div>
              </li>
              <li>
               <div class="media wow fadeInDown"> <a href="#" class="media-left"> <img alt="" src="images/disrply.jpg"> </a>
                  <div class="media-body"> <a href="#" class="catg_title">Number of discussion reply records<br/>
                  <h2>
                  <?php
				  $sql= "SELECT * FROM discussion_reply";
				  $qsql= mysqli_query($con,$sql);
                  echo mysqli_num_rows($qsql);
                  ?>
                  </h2></a> </div>
                </div>
              </li>
               <li>
               <div class="media wow fadeInDown"> <a href="#" class="media-left"> <img alt="" src="images/grpchat.jpg"> </a>
                  <div class="media-body"> <a href="#" class="catg_title">Number of group chat records<br/>
                  <h2>
                  <?php
				  $sql= "SELECT * FROM group_chat";
				  $qsql= mysqli_query($con,$sql);
                  echo mysqli_num_rows($qsql);
                  ?>
                  </h2></a> </div>
                </div>
              </li>
               <li>
               <div class="media wow fadeInDown"> <a href="#" class="media-left"> <img alt="" src="images/notice.jpg"> </a>
                  <div class="media-body"> <a href="#" class="catg_title">Number of notice records<br/>
                  <h2>
                  <?php
				  $sql= "SELECT * FROM notice";
				  $qsql= mysqli_query($con,$sql);
                  echo mysqli_num_rows($qsql);
                  ?>
                  </h2></a> </div>
                </div>
              </li>
               <li>
               <div class="media wow fadeInDown"> <a href="#" class="media-left"> <img alt="" src="images/question.jpg"> </a>
                  <div class="media-body"> <a href="#" class="catg_title">Number of question records<br/>
                  <h2>
                  <?php
				  $sql= "SELECT * FROM question";
				  $qsql= mysqli_query($con,$sql);
                  echo mysqli_num_rows($qsql);
                  ?>
                  </h2></a> </div>
                </div>
              </li>
               <li>
               <div class="media wow fadeInDown"> <a href="#" class="media-left"> <img alt="" src="images/quiz.jpg"> </a>
                  <div class="media-body"> <a href="#" class="catg_title">Number of quiz records<br/>
                  <h2>
                  <?php
				  $sql= "SELECT * FROM quiz";
				  $qsql= mysqli_query($con,$sql);
                  echo mysqli_num_rows($qsql);
                  ?>
                  </h2></a> </div>
                </div>
              </li>
               <li>
               <div class="media wow fadeInDown"> <a href="#" class="media-left"> <img alt="" src="images/quizres.jpg"> </a>
                  <div class="media-body"> <a href="#" class="catg_title">Number of quiz result records<br/>
                  <h2>
                  <?php
				  $sql= "SELECT * FROM quiz_result";
				  $qsql= mysqli_query($con,$sql);
                  echo mysqli_num_rows($qsql);
                  ?>
                  </h2></a> </div>
                </div>
              </li>
                 <li>
               <div class="media wow fadeInDown"> <a href="#" class="media-left"> <img alt="" src="images/student.jpg"> </a>
                  <div class="media-body"> <a href="#" class="catg_title">Number of student records<br/>
                  <h2>
                  <?php
				  $sql= "SELECT * FROM student";
				  $qsql= mysqli_query($con,$sql);
                  echo mysqli_num_rows($qsql);
                  ?>
                  </h2></a> </div>
                </div>
              </li>
                 <li>
               <div class="media wow fadeInDown"> <a href="#" class="media-left"> <img alt="" src="images/studymat.png"> </a>
                  <div class="media-body"> <a href="#" class="catg_title">Number of study material records<br/>
                  <h2>
                  <?php
				  $sql= "SELECT * FROM study_material";
				  $qsql= mysqli_query($con,$sql);
                  echo mysqli_num_rows($qsql);
                  ?>
                  </h2></a> </div>
                </div>
              </li>
               <li>
               <div class="media wow fadeInDown"> <a href="#" class="media-left"> <img alt="" src="images/subject.jpg"> </a>
                  <div class="media-body"> <a href="#" class="catg_title">Number of subject records<br/>
                  <h2>
                  <?php
				  $sql= "SELECT * FROM subject";
				  $qsql= mysqli_query($con,$sql);
                  echo mysqli_num_rows($qsql);
                  ?>
                  </h2></a> </div>
                </div>
              </li>
               <li>
               <div class="media wow fadeInDown"> <a href="#" class="media-left"> <img alt="" src="images/timeline.jpg"> </a>
                  <div class="media-body"> <a href="#" class="catg_title">Number of timeline records<br/>
                  <h2>
                  <?php
				  $sql= "SELECT * FROM timeline";
				  $qsql= mysqli_query($con,$sql);
                  echo mysqli_num_rows($qsql);
                  ?>
                  </h2></a> </div>
                </div>
              </li>
               <li>
               <div class="media wow fadeInDown"> <a href="#" class="media-left"> <img alt="" src="images/tlcomment.jpg"> </a>
                  <div class="media-body"> <a href="#" class="catg_title">Number of timeline comments records<br/>
                  <h2>
                  <?php
				  $sql= "SELECT * FROM timeline_comments";
				  $qsql= mysqli_query($con,$sql);
                  echo mysqli_num_rows($qsql);
                  ?>
                  </h2></a> </div>
                </div>
              </li>
               <li>
               <div class="media wow fadeInDown"> <a href="#" class="media-left"> <img alt="" src="images/user.jpg"> </a>
                  <div class="media-body"> <a href="#" class="catg_title">Number of user records<br/>
                  <h2>
                  <?php
				  $sql= "SELECT * FROM user";
				  $qsql= mysqli_query($con,$sql);
                  echo mysqli_num_rows($qsql);
                  ?>
                  </h2></a> </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      
    </div>
  </section>
 <?php
 include("footer.php")
 ?>