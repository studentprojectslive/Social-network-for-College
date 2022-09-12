<?php
include("header.php");
if(isset($_SESSION[student_id]))
{
	echo "<script>window.location=wallpost.php;</script>";
}
if(isset($_POST[submit]))
{
	$ectpass=md5($_POST[password]);
	$sql = "SELECT * FROM student WHERE roll_no=$_POST[rollno] AND password=$ectpass AND status=Active";
	$qsql = mysqli_query($con,$sql);
	if(!$qsql)
	{
		echo mysqli_error($con);
	}
	
	if(mysqli_num_rows($qsql) == 1)
	{
		$rs = mysqli_fetch_array($qsql);
		$_SESSION[student_id] = $rs[student_id];
		echo "<script>window.location=wallpost.php;</script>";
	}
	else
	{
		$msg =  "<p><font color=red><strong>Invalid Login ID and password entered..</strong></font></p>";
	}
}
?>
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2>Student Login Panel</h2>
            <p>Login into your account.</p>
            <p><font color=red><strong><?php echo $msg; ?></strong></font></ p>
            <form action="" class="contact_form" method="post" name="frmstudentlogin" onsubmit="return validateform()">
            Roll No:<font color=red size=4><strong>*</strong></font>
            <input name="rollno" class="form-control" type="text" placeholder="Roll No *">
            <span id="idrollno"></span>
              	<br>
            Password:<font color=red size=4><strong>*</strong></font>
            <input name="password" class="form-control" type="password" placeholder="Password *">
            <span id="idpassword"></span>
              	<br>
            <input name="submit" type="submit" value="Login">
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
		var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		var alphanumbericExp = /^[a-zA-Z0-9]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
	 
	 var validatecondtion = 0;
	     
	 document.getElementById("idrollno").innerHTML ="";
	 document.getElementById("idpassword").innerHTML ="";
	
	if(!document.frmstudentlogin.rollno.value.match(numericExpression))
	 {
		 document.getElementById("idrollno").innerHTML ="<font color=red>Only numeric values allowed....</font>";
		 validatecondtion=1;
	 }
	 if(document.frmstudentlogin.rollno.value=="")
	 {
		 document.getElementById("idrollno").innerHTML ="<font color=red>Kindly enter your rollno..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmstudentlogin.password.value.length < 8)
	 {
		 document.getElementById("idpassword").innerHTML ="<font color=red>Password must be 8 characters..</font>";
		 validatecondtion=1;
	 }
	  if(document.frmstudentlogin.password.value=="")
	 {
		 document.getElementById("idpassword").innerHTML ="<font color=red>Kindly enter your password..</font>";
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