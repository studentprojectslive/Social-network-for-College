<?php
include("header.php");
$sqlstudent = "SELECT * FROM student WHERE student_id=$_SESSION[student_id]";
$qsqlstudent = mysqli_query($con, $sqlstudent);
$rsstudent = mysqli_fetch_array($qsqlstudent);
?>

  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
<ul class="business_catgnav  wow fadeInDown">

           <?php  
		  $sql ="SELECT * FROM quiz WHERE course_id=$rsstudent[course_id] AND semester=$rsstudent[semester] ORDER BY  quiz.quiz_id desc";
		  $qsql = mysqli_query($con, $sql);
		 while($rsrec = mysqli_fetch_array($qsql))
		  {
			  	$sqlsubject = "SELECT * FROM subject WHERE subject_id=$rsrec[subject_id]";
	 			$qsqlsubject = mysqli_query($con,$sqlsubject);
	 			$rssubject = mysqli_fetch_array($qsqlsubject);
	  		?>
                <li>
                  <figure class="bsbig_fig"> 
                    <figcaption> <a href="attendquiz.php?quizid=<?php echo $rsrec[0]; ?>"><?php echo $rsrec[title]; ?></a></figcaption>  
                    <span><strong>Subject:<?php echo $rssubject[subject]; ?></strong></span>                  
                    <p><?php echo $rsrec[description]; ?></p>
                    <figcaption>
                    <?php
					$sqlquestion="SELECT * FROM question WHERE quiz_id=$rsrec[quiz_id]";
					$qsqlquestion = mysqli_query($con, $sqlquestion);	
			  		if(mysqli_num_rows($qsqlquestion) == 0)
					{
						 echo "<a href=# style=background-color:#d083cf; color:#FFF; padding:5px;>No questions</a>";					
					}
			  		else
					{			  	
						$sqld="SELECT * FROM quiz_result WHERE quiz_id=$rsrec[quiz_id] AND student_id=$_SESSION[student_id]";
						$qsqld = mysqli_query($con, $sqld);					
						if(mysqli_num_rows($qsqld) != 0)
						{
						 echo "<a href=quizresult.php?quizstid=$rsrec[quiz_id] style=background-color:#d083cf; color:#FFF; padding:5px;>Quiz Result</a>";
						}
						else
						{
						 echo "<a href=attendquiz.php?quizstid=$rsrec[quiz_id] style=background-color:#d083cf; color:#FFF; padding:5px;>Attend Quiz</a>";
						}
					}
					?>
					 </figcaption>
                  </figure>
                  <hr>
                </li>
           <?php
              echo "<hr>";
  			}
			?>
</ul>


          
        </div>
      </div>
     <?php include("rightsidebar.php"); ?>
    </div>
  </section>
 <?php
 include("footer.php")
 ?>