<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM timeline WHERE timeline_id=$_GET[delid]";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(Timeline record deleted successfully..);</script>";
	}
}
?>
  <section id="contentSection">
    <div class="row">
           <h2>View Timeline</h2>
            <p>View your views.</p>
           <table border="1" border="1" id="example" class="table table-striped table-bordered" cellspacing="0" style="width:100%;">
    <thead>        
  <tr>
    <th scope="col">Student</th>
    <th scope="col">Post Type</th>
    <th scope="col">Text Message</th>
    <th scope="col">Image Path</th>
    <th scope="col">Video Path</th>
    <th scope="col">Date Time</th>
     <?php
	if($_SESSION[user_type] == "Admin")
	{
	?>
    <th scope="col">Action</th>
    <?php
	}
	?>
  </tr>
  </thead>
  <tbody>
  <?php  
  $sql ="SELECT * FROM timeline";
  $qsql = mysqli_query($con, $sql);
  while($rsrec = mysqli_fetch_array($qsql))
  {
	  $sqlstudent = "SELECT * FROM student WHERE student_id=$rsrec[student_id]";
	  $qsqlstudent = mysqli_query($con,$sqlstudent);
	  $rsstudent = mysqli_fetch_array($qsqlstudent);
     echo "<tr>
    <td>&nbsp;$rsstudent[student_name]</td>
    <td>&nbsp;$rsrec[post_type]</td>
    <td>&nbsp;$rsrec[text_message]</td>
    <td>&nbsp;$rsrec[image_path]</td>
    <td>&nbsp;$rsrec[video_path]</td>
    <td>&nbsp;$rsrec[date_time]</td>";
	if($_SESSION[user_type] == "Admin")
	{
	echo "<td>&nbsp;<a href=viewtimeline.php?delid=$rsrec[timeline_id] onclick=return deleteconfirm()>Delete</a></td>";
	}
	echo "</tr>";
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