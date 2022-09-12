<?php
include("header.php");
if($_SESSION[sessionid] == $_POST[sessionid])
{
	if(isset($_POST[submit]))
	{
		$title= mysqli_real_escape_string($con, $_POST[title]);
		$description= mysqli_real_escape_string($con, $_POST[description]);
		if(isset($_GET[editid]))
		{
			$sql="UPDATE quiz set course_id=$_POST[course],semester=$_POST[semester],subject_id=$_POST[subject],title=$title,description=$description WHERE quiz_id=$_GET[editid]";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<SCRIPT>alert(Quiz record UPDATED successfully..);</SCRIPT>";
				echo "<script>window.location=viewquiz.php;</script>";
			}	
	    }
		else
		{
			$sql="INSERT INTO quiz(user_id,course_id,semester,subject_id,title,description) values ($_SESSION[user_id],$_POST[course],$_POST[semester],$_POST[subject],$_POST[title],$description)";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<SCRIPT>alert(Quiz record inserted successfully..);</SCRIPT>";
				echo "<script>window.location=viewquiz.php;</script>";
			}
		}
	}
}
$_SESSION[sessionid] = rand();
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM quiz WHERE quiz_id=$_GET[editid]";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2>Quiz</h2>
            <p>Add the quiz.</p>
            <form action="" class="contact_form" method="post" name="frmquiz" onsubmit="return validateform()">
            <input  type="hidden" name="sessionid" value="<?php echo $_SESSION[sessionid]; ?>" >

              Course:<font color=red size=4><strong>*</strong></font>
              <select name="course" class="form-control" onchange="loadsubject(course.value,semester.value)">
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
              <span id="idcourse"></span>
              <br />
               Semester:<font color=red size=4><strong>*</strong></font>
              <select name="semester" class="form-control" onchange="loadsubject(course.value,semester.value)">   
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
              <span id="spansubjectid">
              Subject:<font color=red size=4><strong>*</strong></font>
              <select name="subject" class="form-control">
              <option value="">Select Subject</option>
	<?php
    $sqlsubject =  "SELECT * FROM subject WHERE  subject_id=$rsedit[subject_id]";
    $qsqlsubject = mysqli_query($con,$sqlsubject);
    $rssubject = mysqli_fetch_array($qsqlsubject);
        echo "<option value=$rssubject[subject_id] selected>$rssubject[subject]</option>";
    ?>
              </select>
               <span id="idsubject"></span>
              </span>
              <br />
              Title:<font color=red size=4><strong>*</strong></font>
              <input type="text" name="title" class="form-control" placeholder="Title *" value="<?php echo $rsedit[title]; ?>">
              <span id="idtitle"></span>
              <br />
              Description:
			  <script src="richtexteditor/tinymce.min.js"></script>
              <script>tinymce.init({ selector:textarea });</script>
              <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Description *"><?php echo $rsedit[description]; ?></textarea>
              <br />
              <input name="submit" type="submit" value="submit">
            </form>
          </div>
        </div>
      </div>
       <?php include("rightsidebar.php"); ?>
    </div>
  </section>
 <?php
 include("footer.php")
 ?>
 <script>
 function loadsubject(courseid,semester) {
    if (courseid == "")
	{
        document.getElementById("spansubjectid").innerHTML = "";
        return;
    } 
	else
	{ 
        if (window.XMLHttpRequest)
		{
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } 
		else
		{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
				
        xmlhttp.open("GET","ajaxloadsubject.php?courseid="+courseid+"&semester="+semester,true);
        xmlhttp.send();
				
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("spansubjectid").innerHTML = this.responseText;
            }
        };
    }
}
</script>
<script type="application/javascript">
 function validateform()
 {
		var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		var alphanumbericExp = /^[a-zA-Z0-9]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
	 
	 var validatecondtion = 0;
	     
	 document.getElementById("idcourse").innerHTML ="";
	 document.getElementById("idsemester").innerHTML ="";
	 document.getElementById("idsubject").innerHTML ="";
	 document.getElementById("idtitle").innerHTML ="";
	 
	 if(document.frmquiz.course.value=="")
	 {
		 document.getElementById("idcourse").innerHTML ="<font color=red>Kindly select Course..</font>";
		 validatecondtion=1;
	 }
	  if(document.frmquiz.semester.value=="")
	 {
		 document.getElementById("idsemester").innerHTML ="<font color=red>Kindly select Semester..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmquiz.subject.value=="")
	 {
		 document.getElementById("idsubject").innerHTML ="<font color=red>Kindly select Subject..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmquiz.title.value=="")
	 {
		 document.getElementById("idtitle").innerHTML ="<font color=red>Title must not be empty..</font>";
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