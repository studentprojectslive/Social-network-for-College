<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM course WHERE course_id=$_GET[delid]";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(Course record deleted successfully..);</script>";
	}
}
?>
  <section id="contentSection">
    <div class="row">
            <h2>View Course</h2>
            <p>View course details.</p>
<table border="1" id="example" class="table table-striped table-bordered" cellspacing="0" style="width:1100px;" >
<thead>
  <tr>
    <th width="49" scope="col">Course</th>
    <th width="94" scope="col">Course description </th>
    <th width="144" scope="col">Action</th>
  </tr>
  </thead>
  <tbody>
<?php  
  $sql ="SELECT * FROM course";
  $qsql = mysqli_query($con, $sql);
  while($rsrec = mysqli_fetch_array($qsql))
  {
  echo "<tr>
    <td>&nbsp;$rsrec[course]</td>
    <td>&nbsp;$rsrec[course_description]</td>
    <td>&nbsp;<a href=course.php?editid=$rsrec[course_id] class=btn btn-primary>Edit</a> | <a href=viewcourse.php?delid=$rsrec[course_id] onclick=return deleteconfirm() class=btn btn-danger>Delete</a></td>
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