<?php
include("header.php");
if($_SESSION[sessionid] == $_POST[sessionid])
{
	$ectpass =md5($_POST[password]);
	if($_FILES["profileimage"]["name"] != "")
	{
		$imgname = rand(). $_FILES["profileimage"]["name"];
		move_uploaded_file($_FILES["profileimage"]["tmp_name"],"studentimages/".$imgname);
	}
	if(isset($_POST[submit]))
	{
		$aboutus= mysqli_real_escape_string($con, $_POST[aboutus]);
		
		if(isset($_GET[editid]))
		{
			$sql="UPDATE student set student_name=$_POST[name],roll_no=$_POST[rollno],password=$ectpass,";
			if($_FILES["profileimage"]["name"] != "")
					{
					$sql = $sql . "student_img=$imgname,";
					}
					$sql = $sql .  "course_id=$_POST[course],semester=$_POST[semester],about_student=$aboutus,email_id=$_POST[emailid],mob_no=$_POST[mobileno],status=$_POST[status] WHERE student_id=$_GET[editid]";
				$qsql = mysqli_query($con,$sql);
				if(!$qsql)
				{
					echo mysqli_error($con);
				}
				if(mysqli_affected_rows($con) == 1)
				{
					echo "<SCRIPT>alert(Student record UPDATED successfully..);</SCRIPT>";
				}	
	    }
		else
		{
			$sql = "SELECT * FROM student WHERE roll_no=$_POST[rollno] AND (status=Active OR status=Inactive)";
			$qsql = mysqli_query($con,$sql);
			
			if(mysqli_num_rows($qsql) >= 1)
			{
				echo "<SCRIPT>alert(Roll number already exits..);</SCRIPT>";
			}
			else
			{
				$sql="INSERT INTO student(student_name,roll_no,password,student_img,course_id,semester,about_student,email_id,mob_no,status) values ($_POST[name],$_POST[rollno],$ectpass,$imgname,$_POST[course],$_POST[semester],$aboutus,$_POST[emailid],$_POST[mobileno],Active)";
				$qsql = mysqli_query($con,$sql);
				if(!$qsql)
				{
					echo mysqli_error($con);
				}
				if(mysqli_affected_rows($con) == 1)
				{
							$sql = "DELETE FROM student WHERE roll_no=$_POST[rollno] AND (status=New )";
							$qsql = mysqli_query($con,$sql);
					echo "<SCRIPT>alert(Your Account registered successfully...);</SCRIPT>";
					echo "<script>window.location=index.php;</script>";			
				}
			}
		}
	}
}
$_SESSION[sessionid] = rand();
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM student WHERE student_id=$_GET[editid]";
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
            <input  type="hidden" name="sessionid" value="<?php echo $_SESSION[sessionid]; ?>" >
              Full Name:<font color=red size=4><strong>*</strong></font>
              <input name="name" class="form-control" type="text" placeholder="Name  *" value="<?php echo $rsedit[student_name]; ?>"
              <?php
               if(isset($_SESSION[user_id]))
               {
                echo " readonly";
               }
			   ?>
                />
               <span id="idname"></span>
              	<br>
                
              Course:<font color=red size=4><strong>*</strong></font>
              <select name="course" id="course" class="form-control"  <?php 
			  if(isset($_SESSION[user_id]))
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
					if(isset($_SESSION[user_id]))
			  		{
						echo " disabled ";
					}
					echo ">$rscourse[course]</option>";
					}
				}
				?>
              </select>
               <span id="idcourse"></span>
              	<br>                                         
              Semester:<font color=red size=4><strong>*</strong></font>
              <select name="semester" id="semester" class="form-control"  <?php 
			  if(isset($_SESSION[user_id]))
			  {
				  echo " readonly";
			  }
			  ?>>  
              <option value="">Select semester</option>
              <?php
			  $arr = array("First Semester","Second Semester","Third Semester","Fourth Semester","Fifth Semester","Sixth Semester","Seventh Semester","Eighth Semester");
			  foreach($arr as $val)
			  {
				   if($val == $rsedit[semester])
				   {
				  echo "<option value=$val selected>$val</option>";
				   }
				   else
				   {
				  echo "<option value=$val ";
				  if(isset($_SESSION[user_id]))
			  		{
						echo " disabled ";
					}
				 echo ">$val</option>";
				   }
			  }
			  ?>
              </select>
               <span id="idsemester"></span>
              	<br>
                
              Roll No:<font color=red size=4><strong>*</strong> </font>
              <span id="divrollno"><input type="hidden" name="dbidrollno"></span>
              <input name="rollno" class="form-control" type="text" placeholder="Roll No  *" value="<?php echo $rsedit[roll_no]; ?>"
              <?php 
			  if(isset($_SESSION[user_id]))
			  {
				  echo " readonly";
			  }
			  ?>
              onKeyUp="validaterollno(course.value,semester.value,this.value)"
              >
               <span id="idrollno"></span>
              	<br>
              Password:<font color=red size=4><strong>*</strong></font>
              <input name="password" class="form-control" type="password" placeholder="Password  *" value="<?php echo $rsedit[password]; ?>">
               <span id="idpassword"></span>
              	<br>
              Confirm Password:<font color=red size=4><strong>*</strong></font>
              <input name="confirmpassword" class="form-control" type="password" placeholder="Confirm Password  *" value="<?php echo $rsedit[password]; ?>">
               <span id="idconfirmpassword"></span>
              	<br>
              Profile Image:
              <input type="file" name="profileimage" class="form-control" value="<?php echo $rsedit[student_img]; ?>" accept="image/*"  onchange="loadFile(event)" <?php if(isset($_SESSION[user_id]))
			  		{
						echo " disabled ";
					} ?>>
               <?php
              if($rsedit[student_img] == "")  
              {
              	echo <img src="images/no-image.png" height="200" alt="Image preview..." id="previewimg">;
              }
              else
              {
              	echo "<img src=studentimages/$rsedit[student_img] height=200 alt=Image preview... id=previewimg";
				
				echo ">";
              }
              ?><br />
 
              About me:
              <textarea name="aboutus" class="form-control" cols="30" rows="10" placeholder="About Me *" 
              <?php 
			  if(isset($_SESSION[user_id]))
			  {
				  echo " readonly";
			  }
			  ?>><?php echo $rsedit[about_student]; ?>
              </textarea>
             <br />        	
              Email Id:<font color=red size=4><strong>*</strong></font>
              <input name="emailid" class="form-control" type="email" placeholder="Email Id  *" value="<?php echo $rsedit[email_id]; ?>"
              <?php 
			  if(isset($_SESSION[user_id]))
			  {
				  echo " readonly";
			  }
			  ?>
              >
               <span id="idemailid"></span>
              	<br>
              Mobile No:
              <input name="mobileno" class="form-control" type="text" placeholder="Mobile No  *" value="<?php echo $rsedit[mob_no]; ?>"
              <?php 
			  if(isset($_SESSION[user_id]))
			  {
				  echo " readonly";
			  }
			  ?>
              >
               <span id="idmobileno"></span>
              	<br>
             <?php 
			 if(isset($_SESSION[user_id]))
			{
			?>
              Status:
              <select name="status" class="form-control">
              <option value="">Select Status</option>
              <?php
			  $arr = array("Active","Inactive");
			  foreach($arr as $val)
			  {
				   if($val == $rsedit[status])
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
            <?php
			}
			else
			{
			?>
            <input type="hidden" name="status" value="Pending"  />
            <?php
			}
			?>
              <input name="submit" type="submit" value="Click Here to Register">
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
	 document.getElementById("idrollno").innerHTML ="";
	 document.getElementById("idpassword").innerHTML ="";
	 document.getElementById("idconfirmpassword").innerHTML ="";
	 document.getElementById("idcourse").innerHTML ="";
	 document.getElementById("idsemester").innerHTML ="";
	 document.getElementById("idemailid").innerHTML ="";
	  document.getElementById("idmobileno").innerHTML ="";
		        
	 if(!document.frmstudent.name.value.match(alphaspaceExp))
	 {
		 document.getElementById("idname").innerHTML ="<font color=red>Only alphabets are allowed...</font>";
		 validatecondtion=1;
	 }
	  if(document.frmstudent.name.value=="")
	 {
		 document.getElementById("idname").innerHTML ="<font color=red>Name cannot be empty.</font>";
		 validatecondtion=1;
	 }
	 if(!document.frmstudent.rollno.value.match(numericExpression))
	 {
		 document.getElementById("idrollno").innerHTML ="<font color=red>Only numeric values allowed....</font>";
		 validatecondtion=1;
	 }
	 if(document.frmstudent.dbidrollno.value=="")
	 {
		 document.getElementById("idrollno").innerHTML ="<font color=red>Roll Number not exits..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmstudent.rollno.value=="")
	 {
		 document.getElementById("idrollno").innerHTML ="<font color=red>Kindly enter your Roll Number..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmstudent.password.value.length < 8)
	 {
		 document.getElementById("idpassword").innerHTML ="<font color=red>Password must contain at least 8 characters..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmstudent.password.value=="")
	 {
		 document.getElementById("idpassword").innerHTML ="<font color=red>Password should not be empty..</font>";
		 validatecondtion=1;
	 }
	  if(document.frmstudent.password.value!=document.frmstudent.confirmpassword.value)
	 {
		 document.getElementById("idconfirmpassword").innerHTML ="<font color=red>Password and Confirm password not matching..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmstudent.confirmpassword.value=="")
	 {
		 document.getElementById("idconfirmpassword").innerHTML ="<font color=red>Password should not be empty..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmstudent.course.value=="")
	 {
		 document.getElementById("idcourse").innerHTML ="<font color=red>Kindly select your course..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmstudent.semester.value=="")
	 {
		 document.getElementById("idsemester").innerHTML ="<font color=red>Kindly select your semester</font>";
		 validatecondtion=1;
	 }
	  if(document.frmstudent.emailid.value=="")
	 {
		 document.getElementById("idemailid").innerHTML ="<font color=red>Email ID cannot be empty. </font>";
		 validatecondtion=1;
	 }
	 if(document.frmstudent.mobileno.value!="")
	 {
if(document.frmstudent.mobileno.value.length != 10 && document.frmstudent.mobileno.value.length != 11 && document.frmstudent.mobileno.value.length != 12 && document.frmstudent.mobileno.value.length != 13 )
		{
		 document.getElementById("idmobileno").innerHTML ="<font color=red>Mobile Number must be equal to or more than 10 digits..</font>";
		 validatecondtion=1;
		}
		if(!document.frmstudent.mobileno.value.match(numericExpression))
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

function validaterollno(course,semester,rollno) {
	document.getElementById("divrollno").innerHTML = "<input type=hidden name=dbidrollno>";
    if (rollno == "") 
	{
        document.getElementById("divrollno").innerHTML = "<input type=hidden name=dbidrollno>";
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
        xmlhttp.onreadystatechange = function() 
		{
            if (this.readyState == 4 && this.status == 200) 
			{
				document.getElementById("divrollno").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxrollno.php?course="+ course + "&semester=" + semester + "&rollno="+rollno,true);
        xmlhttp.send();
    }
}
</script>	
 
 
	
	