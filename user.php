<?php
include("header.php");
if($_SESSION[sessionid] == $_POST[sessionid])
{
	if(isset($_POST[submit]))
	{
		$encpass = md5($_POST[password]);
		if(isset($_GET[editid]))
		{
			$sql="UPDATE user  set user_type=$_POST[usertype],name=$_POST[name],login_id=$_POST[loginid],password=$encpass,status=$_POST[status] WHERE user_id=$_GET[editid]";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<SCRIPT>alert(User record UPDATED successfully.);</SCRIPT>";
				echo "<script>window.location=viewuser.php;</script>";
			}			
		}
		else
		{
			$sql="INSERT INTO user(user_type,name,login_id,password,status) values ($_POST[usertype],$_POST[name],$_POST[loginid],$encpass,$_POST[status])";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<SCRIPT>alert(User record inserted successfully.);</SCRIPT>";
				echo "<script>window.location=viewuser.php;</script>";
			}
		}
	}
}
$_SESSION[sessionid] = rand();
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM user WHERE user_id=$_GET[editid]";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2>Add User</h2>
            <form action="" class="contact_form" method="post" name="frmuser" onsubmit="return validateform()" >
            <input  type="hidden" name="sessionid" value="<?php echo $_SESSION[sessionid]; ?>" >
            User Type:<font color=red size=4><strong>*</strong></font>
             <select name="usertype" class="form-control">
              <option value="">Select User Type</option>
             <?php
			  $arr = array("Staff","Admin");
			  foreach($arr as $val)
			  {
				  if($val == $rsedit[user_type])
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
              <span id="idusertype"></span>
              	<br>
               Name:<font color=red size=4><strong>*</strong></font>
              <input name="name" class="form-control" type="text" placeholder="Name *" value="<?php echo $rsedit[name]; ?>">
              <span id="idname"></span>
              <br>
              Login Id:<font color=red size=4><strong>*</strong></font>
              <input name="loginid" class="form-control" type="text" placeholder="Login Id *" value="<?php echo $rsedit[login_id]; ?>">
              <span id="idloginid"></span>
              <br>
              Password:<font color=red size=4><strong>*</strong></font>
              <input name="password" class="form-control" type="password" placeholder="Password *" value="<?php echo $rsedit[password]; ?>">
              <span id="idpassword"></span>
              <br>
              Confirm Password:<font color=red size=4><strong>*</strong></font>
              <input name="confirmpassword" class="form-control" type="password" placeholder="confirmpassword *" value="<?php echo $rsedit[password]; ?>">
              <span id="idconfirmpassword"></span>
              <br>
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
              <span id="idstatus"></span>
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
		var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		var alphanumbericExp = /^[a-zA-Z0-9]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
	 
	 var validatecondtion = 0;
	     
	 document.getElementById("idusertype").innerHTML ="";
	 document.getElementById("idname").innerHTML ="";
	 document.getElementById("idloginid").innerHTML ="";
	 document.getElementById("idpassword").innerHTML ="";
	 document.getElementById("idconfirmpassword").innerHTML ="";
	 document.getElementById("idstatus").innerHTML ="";
	 
	 if(document.frmuser.usertype.value=="")
	 {
		 document.getElementById("idusertype").innerHTML ="<font color=red>Kindly select User type..</font>";
		 validatecondtion=1;
	 }
	 if(!document.frmuser.name.value.match(alphaspaceExp))
	 {
		 document.getElementById("idname").innerHTML ="<font color=red>Name should contain only alphabets...</font>";
		 validatecondtion=1;
	 }
	 if(document.frmuser.name.value=="")
	 {
		 document.getElementById("idname").innerHTML ="<font color=red>Name should not be empty...</font>";
		 validatecondtion=1;
	 }
	 if(!document.frmuser.loginid.value.match(alphanumbericExp))
	 {
		 document.getElementById("idloginid").innerHTML ="<font color=red>Only alphabets and numeric values are allowed...</font>";
		 validatecondtion=1;
	 }
	 if(document.frmuser.loginid.value=="")
	 {
		 document.getElementById("idloginid").innerHTML ="<font color=red>Login ID should not be empty..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmuser.password.value.length < 8)
	 {
		 document.getElementById("idpassword").innerHTML ="<font color=red>Password must contain at least 8 characters..</font>";
		 validatecondtion=1;                                
	 }                                                    
	 if(document.frmuser.password.value=="")              
	 {
		 document.getElementById("idpassword").innerHTML ="<font color=red>Password should not be empty..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmuser.password.value!=document.frmuser.confirmpassword.value)
	 {
		 document.getElementById("idconfirmpassword").innerHTML ="<font color=red>Password and Confirm password are not matching..</font>";
		 validatecondtion=1;
	 }	 
	 if(document.frmuser.confirmpassword.value=="")
	 {
		 document.getElementById("idconfirmpassword").innerHTML ="<font color=red>Confirm password should not be empty.</font>";
		 validatecondtion=1;
	 }
	 if(document.frmuser.status.value=="")
	 {
		 document.getElementById("idstatus").innerHTML ="<font color=red>Kindly select your status..</font>";
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