<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM discussion WHERE discussion_id=$_GET[delid]";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(Discussion record deleted successfully..);</script>";
	}
}
?>
  <section id="contentSection">
    <div class="row">
            <h2>View Discussion</h2>
            <p>View discussion details.</p>
            <table border="1" id="example" class="table table-striped table-bordered" cellspacing="0" style="width:100%;">
            <thead>
  <tr>
    <th scope="col">Student</th>
    <th scope="col">Course</th>
    <th scope="col">Discussion Description</th>
    <th scope="col">Date Time</th>
     <th scope="col">Action</th>
  </tr>
  </thead>
  <tbody>
  <?php  
  $sql ="SELECT * FROM discussion";
  $qsql = mysqli_query($con, $sql);
  while($rsrec = mysqli_fetch_array($qsql))
  {
	  $sqlstudent = "SELECT * FROM student WHERE student_id=$rsrec[student_id]";
	  $qsqlstudent = mysqli_query($con,$sqlstudent);
	  $rsstudent = mysqli_fetch_array($qsqlstudent);
	  
	  $sqlcourse = "SELECT * FROM course WHERE course_id=$rsrec[course_id]";
	  $qsqlcourse = mysqli_query($con,$sqlcourse);
	  $rscourse = mysqli_fetch_array($qsqlcourse);
	  
	  $sqlsubject= "SELECT * FROM subject WHERE subject_id=$rsrec[subject_id]";
	  $qsqlsubject = mysqli_query($con,$sqlsubject);
	  $rssubject = mysqli_fetch_array($qsqlsubject);
	  
    echo "<tr>
    <td>&nbsp;$rsstudent[student_name]</td>
    <td><strong>Course:</strong> $rscourse[course]<hr><strong>Semster:</strong> $rsrec[semester]<hr><strong>Subject:</strong> $rssubject[subject]</td>
    <td><b style=color:red>$rsrec[discussion_title]</b>&nbsp;$rsrec[discussion_description]</td>
    <td>&nbsp;$rsrec[date_time]</td>
	<td>&nbsp;<a href=viewdiscussion.php?delid=$rsrec[discussion_id] onclick=return deleteconfirm()>Delete</a></td>
  </tr>";
  }
  ?>
  </tbody>
</table>
       </div>
  </section>
 <?php
 include("footer.php")
 ?>
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
  <?php
 include("datatables.php");
 ?>