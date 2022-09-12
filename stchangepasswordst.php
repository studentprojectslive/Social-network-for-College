<?php
include("header.php");
if($_SESSION[sessionid] == $_POST[sessionid])	
{
	if(isset($_POST[submit]))
	{
		$ectopass=md5($_POST[oldpassword]);
		$ectnpass=md5($_POST[newpassword]);
		$sql="UPDATE student SET password=$ectnpass WHERE student_id=$_GET[stid]";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(!$qsql)
		{
			echo mysqli_error($con);
		}
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert(Password updated successfully.);</SCRIPT>";
		}
		else
		{
		    echo "<SCRIPT>alert(Failed to update password.);</SCRIPT>";	
		}
	}
}
$_SESSION[sessionid] = rand();
?>

  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2>Change Password</h2>
            <p>You can change password here.</p>
            <form action="" class="contact_form" method="post" name="frmchangepasswordst" onsubmit="return validateform()">
            <input  type="hidden" name="sessionid" value="<?php echo $_SESSION[sessionid]; ?>" >
            New Password: 
            <input name="newpassword" class="form-control" type="password" placeholder="New Password *">
            <span id="idnewpassword"></span>
           	<br>
            Confirm Password:
            <input name="confirmpassword" class="form-control" type="password" placeholder="Confirm Password *">
            <span id="idconfirmpassword"></span>
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
	     
	 document.getElementById("idoldpassword").innerHTML ="";
	 document.getElementById("idnewpassword").innerHTML ="";
	 document.getElementById("idconfirmpassword").innerHTML ="";
	  
	 if(document.frmchangepasswordst.oldpassword.value.length < 8)
	 {
		 document.getElementById("idoldpassword").innerHTML ="<font color=red>Password must contain at least 8 characters..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmchangepasswordst.oldpassword.value=="")
	 {
		 document.getElementById("idoldpassword").innerHTML ="<font color=red>Kindly enter Old Password....</font>";
		 validatecondtion=1;
	 }
	 if(document.frmchangepasswordst.newpassword.value.length < 8)
	 {
		 document.getElementById("idnewpassword").innerHTML ="<font color=red>Password must contain at least 8 characters..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmchangepasswordst.newpassword.value=="")
	 {
		 document.getElementById("idnewpassword").innerHTML ="<font color=red>Password should not be empty..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmchangepasswordst.newpassword.value!=document.frmchangepasswordst.confirmpassword.value)
	 {
		 document.getElementById("idconfirmpassword").innerHTML ="<font color=red>Password and Confirm password are not matching..</font>";
		 validatecondtion=1;
	 }	 
	   if(document.frmchangepasswordst.confirmpassword.value=="")
	 {
		 document.getElementById("idconfirmpassword").innerHTML ="<font color=red>Confirm Password should not be empty..</font>";
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