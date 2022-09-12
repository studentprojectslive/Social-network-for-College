<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM notice WHERE notice_id=$_GET[delid]";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(Notice record deleted successfully..);</script>";
	}
}
?>
  <section id="contentSection">
    <div class="row">
          <h2>View Notice</h2>
            <p>View your notice.</p>
            <table border="1" id="example" class="table table-striped table-bordered" cellspacing="0" style="width:1100px;">
            <thead>
  <tr>
    <th width="70" scope="col">Notice Type</th>
    <th width="51" scope="col">User</th>
    <th width="25" scope="col">Title</th>
    <th width="78" scope="col">Description</th>
    <th width="54" scope="col">Uploads</th>
    <th width="67" scope="col">Date Time</th>
    <th width="159" scope="col">Action</th>
  </tr>
  </thead>
  <tbody>
  <?php
  $sql="SELECT * FROM notice";
  $qsql=mysqli_query($con,$sql);
   while($rsrec = mysqli_fetch_array($qsql))
  {
	  $sqluser = "SELECT * FROM user WHERE user_id=$rsrec[user_id]";
	  $qsqluser = mysqli_query($con,$sqluser);
	  $rsuser = mysqli_fetch_array($qsqluser);
    echo "<tr>
    <td>&nbsp;$rsrec[notice_type]</td>
    <td>&nbsp;$rsuser[name]</td>
    <td>&nbsp;$rsrec[title]</td>
    <td>&nbsp;$rsrec[description]</td>
    <td>&nbsp;$rsrec[uploads]</td>
    <td>&nbsp;$rsrec[date_time]</td>
	<td>&nbsp;<a href=notice.php?editid=$rsrec[notice_id]>Edit</a> | <a href=viewnotice.php?delid=$rsrec[notice_id] onclick=return deleteconfirm()>Delete</a></td>
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