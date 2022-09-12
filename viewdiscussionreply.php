<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM discussion_reply WHERE discussion_reply_id=$_GET[delid]";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(Discussion reply record deleted successfully..);</script>";
	}
}
?>
  <section id="contentSection">
    <div class="row">
           <h2>View Discussion Reply</h2>
            <p>View your replies.</p>
            <table border="1" id="example" class="table table-striped table-bordered" cellspacing="0" style="width:100%;">
            <thead>
  <tr>
    <th scope="col">Discussion</th>
    <th scope="col">Student</th>
    <th scope="col">User</th>
    <th scope="col">Message</th>
    <th scope="col">Uploads</th>
    <th scope="col">Date Time</th>
     <th width="144" scope="col">Action</th>
  </tr>
  </thead>
  <tbody>
  <?php  
  $sql ="SELECT * FROM discussion_reply";
  $qsql = mysqli_query($con, $sql);
 while($rsrec = mysqli_fetch_array($qsql))
  {
	  $sqlstudent = "SELECT * FROM student WHERE student_id=$rsrec[student_id]";
	  $qsqlstudent = mysqli_query($con,$sqlstudent);
	  $rsstudent = mysqli_fetch_array($qsqlstudent);
	  
	  $sqluser = "SELECT * FROM user WHERE user_id=$rsrec[user_id]";
	  $qsqluser = mysqli_query($con,$sqluser);
	  $rsuser = mysqli_fetch_array($qsqluser);
  echo "<tr>
    <td>&nbsp;$rsrec[discussion_id]</td>
    <td>&nbsp;$rsstudent[student_name]</td> 
	<td>&nbsp;$rsuser[name]</td> 
    <td>&nbsp;$rsrec[message]</td>
    <td>&nbsp;$rsrec[uploads]</td>
	<td>&nbsp;$rsrec[date_time]</td>
	<td>&nbsp;<a href=discussionreply.php?editid=$rsrec[discussion_reply_id]>Edit</a> | <a href=viewdiscussionreply.php?delid=$rsrec[discussion_reply_id] onclick=return deleteconfirm()>Delete</a></td>
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