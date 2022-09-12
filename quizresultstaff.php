<?php
include("header.php");
$_SESSION[sessionid] = rand();
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM question WHERE quiz_question_id=$_GET[editid]";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM quiz_result WHERE quiz_id=$_GET[delid]";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(Quiz  record deleted successfully..);</script>";
	}
}
?>

  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2>Quiz result</h2>
<table border="1" class="table table-striped table-bordered" cellspacing="0" style="width:1100px">
  <tr>
    <th height="29" colspan="2" style="color:#039" scope="col">&nbsp;<span id="idq">Student Image</span></th>
     <th height="29" colspan="2" style="color:#039" scope="col">&nbsp;<span id="idq">Student Name</span></th>
     <th height="29" colspan="2" style="color:#039" scope="col">&nbsp;<span id="idq">Title</span></th>
     <th height="29" colspan="2" style="color:#039" scope="col">&nbsp;<span id="idq">Total Marks</span></th>
     <th height="29" colspan="2" style="color:#039" scope="col">&nbsp;<span id="idq">Scored Marks</span></th>
     <th height="29" colspan="2" style="color:#039" scope="col">&nbsp;<span id="idq">Percentage</span></th> 
      <?php
	if($_SESSION[user_type] == "Admin")
	{
	?>
     <th height="29" colspan="2" style="color:#039" scope="col">&nbsp;<span id="idq">Action</span></th>
    <?php
	}
	?>
     </tr>
<?php
			  $sqlquizresultsidebar = "SELECT  DISTINCT quiz_id, student_id FROM quiz_result limit 0,10 ";
			  $qsqlquizresultsidebar = mysqli_query($con,$sqlquizresultsidebar);
			  echo mysqli_error($con);
			  while($rsquizresultsidebar = mysqli_fetch_array($qsqlquizresultsidebar))
			  {
				  $scored=0;
				  	  $sqlstudent = "SELECT * FROM student WHERE student_id=$rsquizresultsidebar[student_id]";
					  $qsqlstudent = mysqli_query($con,$sqlstudent);
					  $rsstudent = mysqli_fetch_array($qsqlstudent);
  						
						$sqlquiz ="SELECT * FROM quiz WHERE quiz_id=$rsquizresultsidebar[quiz_id]";
		  				$qsqlquiz = mysqli_query($con, $sqlquiz);
		 				$rsrecquiz = mysqli_fetch_array($qsqlquiz);
						  
						  $sqlquiz_result ="SELECT * FROM quiz_result WHERE quiz_id=$rsquizresultsidebar[quiz_id] AND  student_id=$rsquizresultsidebar[student_id] ";
							$qsqlquiz_result = mysqli_query($con, $sqlquiz_result);
							$totquestionquiz_result = mysqli_num_rows($qsqlquiz_result);
							while($rsrecquiz_result = mysqli_fetch_array($qsqlquiz_result))
							{
									  if($rsrecquiz_result[correct_ans] == $rsrecquiz_result[selected_option])
									  {
										  $scored=$scored+1;
									  }
							} 
						   ?>
<?php
	
	$count=0;
?>

    <tr height=29 width=29>
    <th height="29" colspan="2" style="color:#039"  scope="col">&nbsp;<span id="idq"><img alt="" src="studentimages/<?php echo $rsstudent[student_img]; ?>" height="35" width="35"></span></th>
     <th height="29" colspan="2" style="color:#039" scope="col">&nbsp;<span id="idq"><strong><?php echo $rsstudent[student_name]; ?></strong></span></th>
      <th height="29" colspan="2" style="color:#039" scope="col">&nbsp;<span id="idq"> <?php echo $rsrecquiz[title]; ?></span></th>
     <th height="29" colspan="2" style="color:#039" scope="col">&nbsp;<span id="idq"><?php 
	 		$sqlquizq ="SELECT * FROM question WHERE quiz_id=$rsquizresultsidebar[quiz_id] ";
			$qsqlquizq = mysqli_query($con, $sqlquizq);
	 echo mysqli_num_rows($qsqlquizq); 
	 ?></span></th>     
     <th height="29" colspan="2" style="color:#039" scope="col">&nbsp;<span id="idq"><?php echo $scored; ?></span></th>
    <th height="29" colspan="2" style="color:#039" scope="col">&nbsp;<span id="idq"><?php echo $scored/mysqli_num_rows($qsqlquizq)*100; ?>%</span></th>
   <?php
    if($_SESSION[user_type] == "Admin")
	{
	echo "<td>&nbsp;<a href=quizresultstaff.php?delid=$rsquizresultsidebar[quiz_id] onclick=return deleteconfirm()>Delete</a></td>";
	}  ?>
	</tr>
 
<?php 
	}
			  ?></table>   
              </div>
        </div>
      </div> 
   
    </div>
  </section>
 <?php
 include("footer.php");
include("datatables.php"); ?>
 <script type="application/javascript">
function deleteconfirm()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
 </script>
 
