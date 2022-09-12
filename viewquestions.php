<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM question WHERE quiz_question_id=$_GET[delid]";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(Question record deleted successfully..);</script>";
	}
}
?>
  <section id="contentSection">
    <div class="row">
 
     <h2>Quiz detail</h2>

 <table border="1" class="table table-striped table-bordered" cellspacing="0" style="width:1100px;">
  <thead>
	  <tr>
		<th scope="col">User</th>
		<th scope="col">Course</th>
		<th scope="col">Semester</th>
		<th scope="col">Subject</th>
		<th scope="col">Title</th>
	  </tr>
  </thead>
  <tbody>
  <?php  
  $sql ="SELECT * FROM quiz WHERE quiz_id=$_GET[quizid]";
  $qsql = mysqli_query($con, $sql);
 while($rsrec = mysqli_fetch_array($qsql))
  {
	  $sqluser = "SELECT * FROM user WHERE user_id=$rsrec[user_id]";
	  $qsqluser = mysqli_query($con,$sqluser);
	  $rsuser = mysqli_fetch_array($qsqluser);
	  
	  $sqlcourse = "SELECT * FROM course WHERE course_id=$rsrec[course_id]";
	  $qsqlcourse = mysqli_query($con,$sqlcourse);
	  $rscourse = mysqli_fetch_array($qsqlcourse);
	  
	  $sqlsubject = "SELECT * FROM subject WHERE subject_id=$rsrec[subject_id]";
	  $qsqlsubject = mysqli_query($con,$sqlsubject);
	  $rssubject = mysqli_fetch_array($qsqlsubject);
	  
	  echo "<tr>
		<td>&nbsp;$rsuser[name]</td>
		<td>&nbsp;$rscourse[course]</td>
		<td>&nbsp;$rsrec[semester]</td>
		<td>&nbsp;$rssubject[subject]</td>
		<td><strong>$rsrec[title]</strong><br />$rsrec[description]</td>
	  </tr>";
  }
  ?>
  </tbody>
 </table>
 
     <h2>View Question</h2>
            <p>View the question.</p>
            
      <table border="1" id="example" class="table table-striped table-bordered" cellspacing="0" style="width:1100px;">
<thead>
  <tr>
    <th scope="col">&nbsp;Question</th>
    <th scope="col">&nbsp;Options</th>
    <th scope="col">&nbsp;Correct Answer</th>
    <th scope="col">&nbsp;Action</th>
  </tr>
</thead>
  <tbody>
  <?php  
  $sql ="SELECT * FROM question WHERE quiz_id=$_GET[quizid]";
  $qsql = mysqli_query($con, $sql);
  while($rsrec = mysqli_fetch_array($qsql))
  {
  echo "<tr>
    <td>&nbsp;$rsrec[question]</td>
	<td>1. &nbsp;$rsrec[option1]<br />
2. &nbsp;$rsrec[option2]<br />
3. &nbsp;$rsrec[option3]<br />
4. &nbsp;$rsrec[option4]</td>
	<td>&nbsp;$rsrec[correct_ans]</td>
	<td>&nbsp;";
	if($_SESSION[user_type] == "Staff")
	{
	echo "<a href=questions.php?editid=$rsrec[quiz_question_id]&quizid=$_GET[quizid]>Edit</a> | ";
	}	
    echo "<a href=viewquestions.php?delid=$rsrec[quiz_question_id] onclick=return deleteconfirm()>Delete</a></td>
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