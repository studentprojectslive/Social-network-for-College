<?php
include("header.php");
if(isset($_GET[delid]))
{	
	$sql = "DELETE FROM user WHERE user_id=$_GET[delid]";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(User record deleted successfully..);</script>";
	}
}
?>
  <section id="contentSection">
    <div class="row">
         <h2>View User</h2>
            <p>View User Login.</p>
             <table border="1" border="1" id="example" class="table table-striped table-bordered" cellspacing="0" style="width:100%;">
    <thead>        
  <tr>
    <th scope="col">Image</th>
    <th scope="col">User Type</th>
    <th scope="col">Name</th>
    <th scope="col">Login Id</th>
    <th scope="col">Status</th>
    <th scope="col">Action</th>
  </tr>
  </thead>
  <tbody>
  <?php  
  $sql ="SELECT * FROM user";
  $qsql = mysqli_query($con, $sql);
  while($rsrec = mysqli_fetch_array($qsql))
  {
    echo "<tr>
    <td>&nbsp;<img src=userprofileimages/$rsrec[user_img] style=width:50px;height:50px; > </td>
    <td>&nbsp;$rsrec[user_type]</td>
    <td>&nbsp;$rsrec[name]</td>
    <td>&nbsp;$rsrec[login_id]</td>
    <td>&nbsp;$rsrec[status]</td>
    <td>&nbsp;<a href=user.php?editid=$rsrec[user_id]>Edit</a> |  <a href=viewuser.php?delid=$rsrec[user_id] onclick=return deleteconfirm()>Delete</a></td>
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