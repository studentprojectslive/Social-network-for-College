<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM study_material WHERE study_material_id=$_GET[delid]";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(Study Material record deleted successfully..);</script>";
	}
}
?>
  <section id="contentSection">
    <div class="row">
           <h2>View Study Material</h2>

<form class="contact_form" method="get" >
<?php
  	  $sqlsubject = "SELECT * FROM subject WHERE course_id=$rsstudent[course_id] and semester=$rsstudent[semester]";
	  $qsqlsubject = mysqli_query($con,$sqlsubject);
	  while($rssubject= mysqli_fetch_array($qsqlsubject))
	  {		  
echo "<input type=button value=$rssubject[subject] name=submit$rssubject[subject_id] onclick=window.location=`displaystudymaterial.php?subjectid=$rssubject[subject_id]&sub=$rssubject[subject]` style=height:55px;color:white; > ";
	  }
?>
</form>
<hr>
<h2><?php echo $_GET[sub]; ?></h2>   
<?php
   $sql ="SELECT * FROM study_material WHERE  course_id=$rsstudent[course_id] AND semester=$rsstudent[semester] AND subject_id=$_GET[subjectid]";
  $qsql = mysqli_query($con, $sql);
  if(mysqli_num_rows($qsql) == 0)
  {
?>
    <table border="1"  class="table table-striped table-bordered" cellspacing="0" style="width:100%;">
      <thead>
      <tr>
      	<?php
			if(isset($_GET[subjectid]))
			{
        	echo "<th scope=col >Study materials not found</th>";
			}
			else
  			{
        	echo "<th scope=col >Kindly select subject</th>";
			}
		?>
      </tr>
      </thead>
      <tbody>
      </tbody>
      </table>
 <?php
  }
  else
  {
?>
    <table border="1"  class="table table-striped table-bordered" cellspacing="0" style="width:100%;">
      <thead>
      <tr>
        <th scope="col">Title</th>
        <th scope="col">Faculty</th>
        <th scope="col">Description</th>
        <th scope="col" width="150">Study material</th>
      </tr>
      </thead>
     
      <?php   while($rsrec = mysqli_fetch_array($qsql))
  { ?>
       <tbody>
      <?php
	      $sqluser = "SELECT * FROM user WHERE user_id=$rsrec[user_id]";
          $qsqluser = mysqli_query($con,$sqluser);
          $rsuser = mysqli_fetch_array($qsqluser);
          $sqlcourse = "SELECT * FROM course WHERE course_id=$rsrec[course_id]";
          $qsqlcourse = mysqli_query($con,$sqlcourse);
          $rscourse = mysqli_fetch_array($qsqlcourse);
          $sqlsubject = "SELECT * FROM subject WHERE course_id=$rsrec[course_id]";
          $qsqlsubject = mysqli_query($con,$sqlsubject);
          $rssubject= mysqli_fetch_array($qsqlsubject);
        echo "<tr>
        <td>&nbsp;$rsrec[title]</td>
        <td>&nbsp;$rsuser[name]</td>
        <td>$rsrec[description]</td>
        <td>&nbsp;";
$ext = pathinfo($rsrec[uploads], PATHINFO_EXTENSION);
	  if($ext== "jpg" || $ext== "png" || $ext == "jpeg" || $ext == "gif")
	  	{
	  echo "<a href=imagetopdf.php?imgpath=studymaterialimages/$rsrec[uploads] download><img src=images/download.png width=100></img></a>";
	  	}
	  else
	  	{
	  echo "<a href=studymaterialimages/$rsrec[uploads] download><img src=images/download.png width=100></img></a>";
		}
		echo "</td></tr>";
        ?>
      </tbody>
      <?php
     }  
	 ?>
    </table>
    <hr>
<?php
 
  }
 ?>
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