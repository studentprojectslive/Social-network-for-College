<?php
include("header.php");
if($_SESSION[sessionid] == $_POST[sessionid])
{
		if($_FILES[profileimage][name] != "")
	{
		$imgname = rand(). $_FILES[profileimage][name];
		move_uploaded_file($_FILES["profileimage"]["tmp_name"],"studentimages/".$imgname);
	}
		if(isset($_POST[submit]))
		{
			$aboutus= mysqli_real_escape_string($con, $_POST[aboutus]);
			
			$sql="UPDATE student set student_name=$_POST[name],roll_no=$_POST[rollno],";
			if($_FILES[profileimage][name] != "")
			{
			$sql = $sql . "student_img=$imgname,";
			}
			$sql = $sql . "course_id=$_POST[course],semester=$_POST[semester],about_student=$aboutus,email_id=$_POST[emailid],mob_no=$_POST[mobileno],status=Active WHERE student_id=$_SESSION[student_id]";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<SCRIPT>alert(Student record UPDATED successfully..);</SCRIPT>";
				echo "<script>window.location=wallpost.php;</script>";
			}	
       }
}
$_SESSION[sessionid] = rand();
if(isset($_SESSION[student_id]))
{
	$sqledit = "SELECT * FROM student WHERE student_id=$_SESSION[student_id]";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>

  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2>Student Profile</h2>
            <p>Update your profile here...</p>
            <form action="" class="contact_form" method="post" enctype="multipart/form-data" name="frmstudentprofile" onsubmit="return validateform()">
            <input  type="hidden" name="sessionid" value="<?php echo $_SESSION[sessionid]; ?>" >
              Full Name:<font color=red size=4><strong>*</strong></font>
              <input name="name" class="form-control" type="text" placeholder="Name  *" value="<?php echo $rsedit[student_name]; ?>">
               <span id="idname"></span>
             	<br>
              Roll No:<font color=red size=4><strong>*</strong></font>
              <input name="rollno" class="form-control" type="text" placeholder="Roll No *" value="<?php echo $rsedit[roll_no]; ?>" 
              <?php 
			  if(isset($_SESSION[student_id]))
			  {
				  echo " readonly";
			  }
			  ?>
              >
              Profile Image:
              <input type="file" name="profileimage" class="form-control" accept="image/*"  onchange="loadFile(event)" title="Upload image">
              <?php
              if($rsedit[student_img] == "")
              {
              	echo <img src="images/no-image.png" height="200" alt="Image preview..." id="previewimg">;
              }
              else
              {
              	echo "<img src=studentimages/$rsedit[student_img] height=200 alt=Image preview... id=previewimg>";
              }
              ?>
              <br />
              Course:
              <select name="course" class="form-control" <?php 
			  if(isset($_SESSION[student_id]))
			  {
				  echo " readonly";
			  }
			  ?>>
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
					echo "<option value=$rscourse[course_id] ";
					if(isset($_SESSION[student_id]))
			  		{
						echo " disabled ";
					}
					echo ">$rscourse[course]</option>";
					}
				}
				?>
              </select>
              Semester:<font color=red size=4><strong>*</strong></font>
              <select name="semester" class="form-control" >
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
              	<br>
              About me:
              <textarea name="aboutus" class="form-control" cols="30" rows="10" placeholder="About Us *"><?php echo $rsedit[about_student]; ?></textarea>
              Email Id:<font color=red size=4><strong>*</strong></font>
              <input name="emailid" class="form-control" type="email" placeholder="Email Id  *" value="<?php echo $rsedit[email_id]; ?>">
              <span id="idemailid"></span>
           	  <br>
              Mobile No:
              <input name="mobileno" class="form-control" type="mobile" placeholder="Mobile No  *" value="<?php echo $rsedit[mob_no]; ?>">
              <span id="idmobileno"></span>
              	<br>
              <input name="submit" type="submit" value="Update Profile">
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
      var output = document.getElementById(previewimg);
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
	 document.getElementById("idsemester").innerHTML ="";
	 document.getElementById("idemailid").innerHTML ="";
	 document.getElementById("idmobileno").innerHTML ="";
		 
	 if(!document.frmstudentprofile.name.value.match(alphaspaceExp))
	 {
		 document.getElementById("idname").innerHTML ="<font color=red>Name should contain only alphabets...</font>";
		 validatecondtion=1;
	 }
	 if(document.frmstudentprofile.name.value=="")
	 {
		 document.getElementById("idname").innerHTML ="<font color=red>Name should not be empty...</font>";
		 validatecondtion=1;
	 }
	 if(document.frmstudentprofile.semester.value=="")
	 {
		 document.getElementById("idsemester").innerHTML ="<font color=red>Kindly select your semester</font>";
		 validatecondtion=1;
	 }
	  if(document.frmstudentprofile.emailid.value=="")
	 {
		 document.getElementById("idemailid").innerHTML ="<font color=red>Email ID cannot be empty </font>";
		 validatecondtion=1;
	 }
	if(document.frmstudentprofile.mobileno.value!="")
	 {
if(document.frmstudentprofile.mobileno.value.length != 10 && document.frmstudentprofile.mobileno.value.length != 11 && document.frmstudentprofile.mobileno.value.length != 12 && document.frmstudentprofile.mobileno.value.length != 13 )
		{
		 document.getElementById("idmobileno").innerHTML ="<font color=red>Mobile Number must be equal to or more than 10 digits..</font>";
		 validatecondtion=1;
		}
		if(!document.frmstudentprofile.mobileno.value.match(numericExpression))
	    {
		 document.getElementById("idmobileno").innerHTML ="<font color=red>Only numeric values allowed....</font>";
		 validatecondtion=1;
	    }
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