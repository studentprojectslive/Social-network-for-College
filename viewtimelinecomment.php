<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM timeline_comments WHERE timeline_comment_id=$_GET[delid]";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(Timeline Comment record deleted successfully..);</script>";
	}
}
?>
  <section id="contentSection">
    <div class="row">
          <h2>View Timeline Comment</h2>
            <p>View your comments.</p>
           <table border="1" border="1" id="example" class="table table-striped table-bordered" cellspacing="0" style="width:100%;">
    <thead>        
  <tr>
    <th scope="col">Student</th>
    <th scope="col">Timeline Id</th>
    <th scope="col">Message</th>
    <th scope="col">Date Time</th>
    <th scope="col">Action</th>
  </tr>
  </thead>
  <tbody>
  <?php  
  $sql ="SELECT * FROM timeline_comments";
  $qsql = mysqli_query($con, $sql);
  while($rsrec = mysqli_fetch_array($qsql))
  {
	  $sqlstudent = "SELECT * FROM student WHERE student_id=$rsrec[student_id]";
	  $qsqlstudent = mysqli_query($con,$sqlstudent);
	  $rsstudent = mysqli_fetch_array($qsqlstudent);
    echo "<tr>
    <td>&nbsp;$rsstudent[student_name]</td>
    <td>&nbsp;$rsrec[timeline_id]</td>
    <td>&nbsp;$rsrec[message]</td>
    <td>&nbsp;$rsrec[date_time]</td>
    <td>&nbsp;<a href=timelinecomment.php?editid=$rsrec[timeline_comment_id]>Edit</a> | <a href=viewtimelinecomment.php?delid=$rsrec[timeline_comment_id] onclick=return deleteconfirm()>Delete</a></td>
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