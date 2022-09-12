<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM subject WHERE subject_id=$_GET[delid]";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(Subject record deleted successfully..);</script>";
	}
}
?>
  <section id="contentSection">
    <div class="row">
            <h2>View Subject</h2>
            <p>View your subject.</p>
            <table border="1" id="example" class="table table-striped table-bordered" cellspacing="0" style="width:100%;">
  <thead>
  <tr>
    <th scope="col">Subject</th>
    <th scope="col">Course</th>
    <th scope="col">Semester</th>
    <th scope="col">Note</th>
    <th scope="col">Action</th>
  </tr>
  </thead>
  <tbody
  <?php  
  $sql ="SELECT * FROM subject";
  $qsql = mysqli_query($con, $sql);
  while($rsrec = mysqli_fetch_array($qsql))
  {
	  $sqlcourse = "SELECT * FROM course WHERE course_id=$rsrec[course_id]";
	  $qsqlcourse = mysqli_query($con,$sqlcourse);
	  $rscourse = mysqli_fetch_array($qsqlcourse);
    echo "<tr>
    <td>&nbsp;$rsrec[subject]</td>
    <td>&nbsp;$rscourse[course]</td>
	<td>&nbsp;$rsrec[semester]</td>
    <td>&nbsp;$rsrec[note]</td>
	<td>&nbsp;<a href=subject.php?editid=$rsrec[subject_id]>Edit</a> | <a href=viewsubject.php?delid=$rsrec[subject_id] onclick=return deleteconfirm()>Delete</a></td>
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