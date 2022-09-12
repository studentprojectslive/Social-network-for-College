<?php
include("header.php");
?>
<section id="contentSection">
<?php
if(isset($_SESSION[user_id]))
{
?>
<form action="" class="contact_form" method="get" name="frmcourse" onsubmit="return validateform()">
    <table  border="1" id="example" class="table table-striped table-bordered" cellspacing="0" style="width:1100px;">
      <tbody>
        <tr>
          <th scope="col" style="vertical-align:middle">Course</th> 
          <th scope="col"><select name="course_id" class="form-control">
              <option value="">Select Course</option>
              <?php
				$sqlcourse =  "SELECT * FROM course WHERE status=Active";
				$qsqlcourse = mysqli_query($con,$sqlcourse);
				while($rscourse = mysqli_fetch_array($qsqlcourse))
				{
					if($rscourse[course_id] == $_GET[course_id])
					{
					echo "<option value=$rscourse[course_id] selected>$rscourse[course]</option>";
					}
					else
					{					
					echo "<option value=$rscourse[course_id]>$rscourse[course]</option>";
					}
				}
				?>
                </select></th>
          <th scope="col" style="vertical-align:middle">Semester</th>
          <th scope="col"><select name="semester" class="form-control">   
              <option value="">Select semester</option>
              <?php
			  $arr = array("First Semester","Second Semester","Third Semester","Fourth Semester","Fifth Semester","Sixth Semester");
			  foreach($arr as $val)
			  {
				   if($val == $_GET[semester])
				   {
				  echo "<option value=$val selected>$val</option>";
				   }
				   else
				   {
				  echo "<option value=$val>$val</option>";
				   }
			  }
			  ?>
              </select></th>
          <th scope="col"><input name="submit" type="submit" value="Submit"></th>
        </tr>
      </tbody>
    </table>
</form>
<?php
}
?>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="left_content">
<?php        
			$sqlsubject = "SELECT * FROM subject WHERE status=Active ";
			if(isset($_SESSION[student_id]))
			{
				$sqlsubject= $sqlsubject . " AND course_id=$rsstudent[course_id] AND semester=$rsstudent[semester] ";
			}
			else
			{
				$sqlsubject= $sqlsubject . " AND course_id=$_GET[course_id] AND semester=$_GET[semester] ";	
			}
			$qsqlsubject = mysqli_query($con,$sqlsubject);
			while($rssubject = mysqli_fetch_array($qsqlsubject))
			{  	
?>   
				<?php
                if($i == 0)
                {
                ?>
                <div class="fashion_technology_area">                       
                <div class="fashion">
                  <div class="single_post_content">
                    <h2><span><?php echo $rssubject[subject]; ?></span></h2>
                  
                    <ul class="spost_nav">
                    <?php 
                      $sqldiscussion ="SELECT * FROM discussion WHERE subject_id=$rssubject[subject_id]";
                      $qsqldiscussion = mysqli_query($con, $sqldiscussion);
                      while($rsrecdiscussion = mysqli_fetch_array($qsqldiscussion))
                        {
							  $sqlstudent = "SELECT * FROM student WHERE student_id=$rsrecdiscussion[student_id]";
							  $qsqlstudent = mysqli_query($con,$sqlstudent);
							  $rsstudent = mysqli_fetch_array($qsqlstudent);
                         
							 	echo "<li>
								<div class=media wow fadeInDown>  <a href=single_page_discussion.php?discussionid=$rsrecdiscussion[discussion_id]&subject=$rssubject[subject] class=media-left><img alt= src=studentimages/$rsstudent[student_img] style=height:60px></a>
								  <div class=media-body> <a href=single_page_discussion.php?discussionid=$rsrecdiscussion[discussion_id]&subject=$rssubject[subject] class=catg_title> $rsrecdiscussion[discussion_title]</a> </div>
							  </div>
							  </li>";
                     	}
                     ?>
                    </ul>
                  </div>
                </div>
                <?php
                	$i=1;
                }
                else if($i == 1)
                {
                ?>
                <div class="technology">
                  <div class="single_post_content">
                    <h2><span><?php echo $rssubject[subject]; ?></span></h2>
                    <ul class="spost_nav">
                      <?php 
         $sqldiscussion ="SELECT * FROM discussion WHERE subject_id=$rssubject[subject_id]";
        $qsqldiscussion = mysqli_query($con, $sqldiscussion);
        while($rsrecdiscussion = mysqli_fetch_array($qsqldiscussion))
                     {	 
                          $sqlstudent = "SELECT * FROM student WHERE student_id=$rsrecdiscussion[student_id]";
                          $qsqlstudent = mysqli_query($con,$sqlstudent);
                          $rsstudent = mysqli_fetch_array($qsqlstudent);
                         
                     echo "<li>
                        <div class=media wow fadeInDown> <a href=single_page_discussion.php?discussionid=$rsrecdiscussion[discussion_id]&subject=$rssubject[subject] class=media-left><img alt= src=studentimages/$rsstudent[student_img] style=height:60px></a>
                          <div class=media-body> <a href=single_page_discussion.php?discussionid=$rsrecdiscussion[discussion_id]&subject=$rssubject[subject] class=catg_title> $rsrecdiscussion[discussion_title]</a> </div>
                      </div>
                      </li>";
                     }
                     ?>
                    </ul>
                  </div>
                </div>
              </div>
              <?php
              $i=0;
                }
                ?>
<?php
			}
?>
          
</div>
        </div>
      </div>
    </div>
  </section>
  <?php
include("footer.php");
?>