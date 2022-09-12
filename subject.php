<?php
include("header.php");
if($_SESSION[sessionid] == $_POST[sessionid])
{
	if(isset($_POST[submit]))
	{
		$note= mysqli_real_escape_string($con, $_POST[note]);
		
		if(isset($_GET[editid]))
		{
			$sql="UPDATE subject  set subject=$_POST[subject],course_id=$_POST[coursetitle],semester=$_POST[semester],note=$note,status=Active WHERE subject_id=$_GET[editid]";
				$qsql = mysqli_query($con,$sql);
				if(!$qsql)
				{
					echo mysqli_error($con);
				}
				if(mysqli_affected_rows($con) == 1)
				{
					echo "<SCRIPT>alert(Subject record UPDATED successfully..);</SCRIPT>";
					echo "<script>window.location=viewsubject.php;</script>";
				}	
		}
		else
		{
		$sql="INSERT INTO subject(subject,course_id,semester,note,status) values ($_POST[subject],$_POST[coursetitle],$_POST[semester],$note,Active)";
		$qsql = mysqli_query($con,$sql);
		if(!$qsql)
		{
			echo mysqli_error($con);
		}
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert(Subject record inserted successfully..);</SCRIPT>";
			echo "<script>window.location=viewsubject.php;</script>";
		}
	}
	}
}
$_SESSION[sessionid] = rand();
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM subject WHERE subject_id=$_GET[editid]";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>

  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2>Subject</h2>
            <p>Add your subject.</p>
            <form action="" class="contact_form" method="post" name="frmsubject" onsubmit="return validateform()">
            <input  type="hidden" name="sessionid" value="<?php echo $_SESSION[sessionid]; ?>" >
            Course :<font color=red size=4><strong>*</strong></font>
            <select name="coursetitle" class="form-control">
              <option value="">Select Course</option>
              <?php
				$sqlcourse =  "SELECT * FROM course WHERE status=Active";
				$qsqlcourse = mysqli_query($con,$sqlcourse);
				while($rscourse = mysqli_fetch_array($qsqlcourse))
				{
					if($rscourse[course_id] == $rsedit[course_id])
					{
					echo "<option value=$rscourse[course_id] selected>$rscourse[course]</option>";
					}
					else
					{					
					echo "<option value=$rscourse[course_id]>$rscourse[course]</option>";
					}
				}
				?>
                </select>
               <span id="idcoursetitle"></span>
                <br />
                 Semester:<font color=red size=4><strong>*</strong></font>
              <select name="semester" class="form-control">   
              <option value="">Select semester</option>
              <?php
			  $arr = array("First Semester","Second Semester","Third Semester","Fourth Semester","Fifth Semester","Sixth Semester");
			  foreach($arr as $val)
			  {
				   if($val == $rsedit[semester])
				   {
				  echo "<option value=$val selected>$val</option>";
				   }
				   else
				   {
				  echo "<option value=$val>$val</option>";
				   }
			  }
			  ?>
              </select>
               <span id="idsemester"></span>
                <br />
              Subject:<font color=red size=4><strong>*</strong></font>
              <input name="subject" class="form-control" type="text" placeholder="Subject *" value="<?php echo $rsedit[subject]; ?>">
              <span id="idsubject"></span>
                <br />
              Note:
              <textarea name="note" class="form-control" cols="30" rows="10" placeholder="Note *"><?php echo $rsedit[note]; ?></textarea>
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
	 document.getElementById("idsubject").innerHTML ="";

	 if(document.frmsubject.coursetitle.value=="")
	 {
		 document.getElementById("idcoursetitle").innerHTML ="<font color=red>Kindly select Course..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmsubject.subject.value=="")
	 {
		 document.getElementById("idsubject").innerHTML ="<font color=red>Kindly add Subject..</font>";
		 validatecondtion=1;
	 }
	  if(document.frmsubject.semester.value=="")
	 {
		 document.getElementById("idsemester").innerHTML ="<font color=red>Kindly add Semester..</font>";
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
	 