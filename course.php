<?php
include("header.php");
if($_SESSION[sessionid] == $_POST[sessionid])
{
	if(isset($_POST[submit]))
	{
		$course_description= mysqli_real_escape_string($con, $_POST[coursedescription]);
		
		if(isset($_GET[editid]))
		{
	$sql="UPDATE course set course=$_POST[coursetitle],course_description=$course_description,status=Active WHERE course_id=$_GET[editid]";
		$qsql = mysqli_query($con,$sql);
		if(!$qsql)
		{
			echo mysqli_error($con);
		}
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert(Course record UPDATED successfully..);</SCRIPT>";
		    echo "<script>window.location=viewcourse.php;</script>";
		}	
	    }
	else
	{
		$sql="INSERT INTO course(course,course_description,status) values ($_POST[coursetitle],$course_description,Active)";
		$qsql = mysqli_query($con,$sql);
		if(!$qsql)
		{
			echo mysqli_error($con);
		}
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert(Course record inserted successfully.);</SCRIPT>";
			echo "<script>window.location=viewcourse.php;</script>";
		}
	}
}
}
$_SESSION[sessionid] = rand();
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM course WHERE course_id=$_GET[editid]";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2>Course</h2>
            <p>Add new course details.</p>
            <form action="" class="contact_form" method="post" name="frmcourse" onsubmit="return validateform()">
            <input  type="hidden" name="sessionid" value="<?php echo $_SESSION[sessionid]; ?>" >
            Course Title<font color=red size=4><strong>*</strong></font>:
              <input name="coursetitle" class="form-control" type="text" placeholder="Course Title *" value="<?php echo $rsedit[course]; ?>">
              <span id="idcoursetitle"></span>
              <br />
              Course Description
              <textarea name="coursedescription" class="form-control" cols="30" rows="10" placeholder="Course Description *"><?php echo $rsedit[course_description]; ?></textarea>
              <br>
              <input name="submit" type="submit" value="Submit">
            </form>
          </div>
        </div>
      </div>
      
    </div>
  </section>
 <?php
 include("footer.php")
 ?>
 <script type="application/javascript">
 function validateform()
 {
	 var validatecondtion = 0;
	     
	 document.getElementById("idcoursetitle").innerHTML ="";
	 
	 if(document.frmcourse.coursetitle.value=="")
	 {
		 document.getElementById("idcoursetitle").innerHTML ="<font color=red>Kindly add Course..</font>";
		 validatecondtion=1;
	 }
	  if(validatecondtion==1)
	 {
		 return false;
	 }
	 else
	 {
		 return true;
	 }
 }
 </script>