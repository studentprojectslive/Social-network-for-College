<?php
include("header.php");
if($_SESSION['sessionid'] == $_POST['sessionid'])
{
	if(isset($_POST['submit']))
	{
		if(isset($_GET['editid']))
		{
			$sql = "SELECT * FROM student WHERE roll_no='$_POST[rollno]' AND (status='New' OR status='Active')";
			$qsql = mysqli_query($con,$sql);
			
			if(mysqli_num_rows($qsql) >= 1)
			{
				echo "<SCRIPT>alert('Roll number already exits..');</SCRIPT>";
			}
			else
			{
				$sql="UPDATE student set student_name='$_POST[name]',roll_no='$_POST[rollno]',course_id='$_POST[course]',semester='$_POST[semester]',status='New' WHERE student_id='$_GET[editid]'";
				$qsql = mysqli_query($con,$sql);
				if(!$qsql)
				{
					echo mysqli_error($con);
				}
				if(mysqli_affected_rows($con) == 1)
				{
					echo "<SCRIPT>alert('Student profile UPDATED successfully..');</SCRIPT>";
					echo "<script>window.location='viewstudentprofile.php';</script>";
				}
			}
		}
		else
		{
			$sql = "SELECT * FROM student WHERE roll_no='$_POST[rollno]' AND (status='New' OR status='Active')";
			$qsql = mysqli_query($con,$sql);
			
			if(mysqli_num_rows($qsql) >= 1)
			{
				echo "<SCRIPT>alert('Roll number already exits..');</SCRIPT>";	
			}
			else
			{
				$sql="INSERT INTO student(student_name,roll_no,course_id,semester,status) values ('$_POST[name]','$_POST[rollno]','$_POST[course]','$_POST[semester]','New')";
				$qsql = mysqli_query($con,$sql);
				if(!$qsql)
				{
					echo mysqli_error($con);
				}
				if(mysqli_affected_rows($con) == 1)
				{
					echo "<SCRIPT>alert('New student profile added..');</SCRIPT>";
					echo "<script>window.location='viewstudentprofile.php';</script>";		
				}
			}
		}
	}
}
$_SESSION['sessionid'] = rand();
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM student WHERE student_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>

  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2>Student Registration Panel</h2>
            <p>Kindly register by entering following details...</p>
            <form action="" class="contact_form" method="post" enctype="multipart/form-data" name="frmstudent" onsubmit="return validateform()" >
            <input  type="hidden" name="sessionid" value="<?php echo $_SESSION['sessionid']; ?>" >
             Full Name:<font color='red' size='4'><strong>*</strong></font>
              <input name="name" class="form-control" type="text" placeholder="Name  *" value="<?php echo $rsedit['student_name']; ?>" />
               <span id="idname"></span>
              	<br>
              Roll No:<font color='red' size='4'><strong>*</strong></font>
              <input name="rollno" class="form-control" type="text" placeholder="Roll No  *" value="<?php echo $rsedit['roll_no']; ?>" />
               <span id="idrollno"></span>
              	<br>
               Course:<font color='red' size='4'><strong>*</strong></font>
              <select name="course" class="form-control" >
              <option value="">Select Course</option>
              	<?php
				$sqlcourse =  "SELECT * FROM course WHERE status='Active'";
				$qsqlcourse = mysqli_query($con,$sqlcourse);
				while($rscourse = mysqli_fetch_array($qsqlcourse))
				{
					if($rscourse['course_id'] == $rsedit['course_id'])
					{
					echo "<option value='$rscourse[course_id]' selected>$rscourse[course]</option>";
					}
					else
					{					
					echo "<option value='$rscourse[course_id]'>$rscourse[course]</option>";
					}
				}
				?>
              </select>
               <span id="idcourse"></span>
              	<br>                                         
              Semester:<font color='red' size='4'><strong>*</strong></font>
              <select name="semester" class="form-control"  >  
              <option value="">Select semester</option>
              <?php
			  $arr = array("First Semester","Second Semester","Third Semester","Fourth Semester","Fifth Semester","Sixth Semester");
			  foreach($arr as $val)
			  {
				   if($val == $rsedit['semester'])
				   {
				  echo "<option value='$val' selected>$val</option>";
				   }
				   else
				   {
				  echo "<option value='$val' >$val</option>";
				   }
			  }
			  ?>
              </select>
               <span id="idsemester"></span>
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
 <script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('previewimg');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
 <script type="application/javascript">
 function validateform()
 {
	    var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		var alphanumbericExp = /^[a-zA-Z0-9]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
	 
	 var validatecondtion = 0;
	     
	 document.getElementById("idname").innerHTML ="";
	 document.getElementById("idrollno").innerHTML ="";
	 document.getElementById("idcourse").innerHTML ="";
	 document.getElementById("idsemester").innerHTML ="";
		        
	 if(!document.frmstudent.name.value.match(alphaspaceExp))
	 {
		 document.getElementById("idname").innerHTML ="<font color='red'>Only alphabets are allowed...</font>";
		 validatecondtion=1;
	 }
	  if(document.frmstudent.name.value=="")
	 {
		 document.getElementById("idname").innerHTML ="<font color='red'>Name cannot be empty.</font>";
		 validatecondtion=1;
	 }
	 if(!document.frmstudent.rollno.value.match(numericExpression))
	 {
		 document.getElementById("idrollno").innerHTML ="<font color='red'>Only numeric values allowed....</font>";
		 validatecondtion=1;
	 }
	 if(document.frmstudent.rollno.value=="")
	 {
		 document.getElementById("idrollno").innerHTML ="<font color='red'>Kindly enter your Roll Number..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmstudent.course.value=="")
	 {
		 document.getElementById("idcourse").innerHTML ="<font color='red'>Kindly select your course..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmstudent.semester.value=="")
	 {
		 document.getElementById("idsemester").innerHTML ="<font color='red'>Kindly select your semester</font>";
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
 
 
	
	