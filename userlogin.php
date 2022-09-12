<?php
include("header.php");
if(isset($_SESSION[user_id]))
{
	echo "<script>window.location=dashboard.php;</script>";
}
if(isset($_POST[submit]))
{
	$ectpass=md5($_POST[password]);
	$sql = "SELECT * FROM user WHERE login_id=$_POST[loginid] AND password=$ectpass AND status=Active";
	$qsql = mysqli_query($con,$sql);
	if(!$qsql)
	{
		echo mysqli_error($con);
	}
	if(mysqli_num_rows($qsql) == 1)
	{
		$rs = mysqli_fetch_array($qsql);
		$_SESSION[user_id] = $rs[user_id];
		$_SESSION[user_type] = $rs[user_type];
		echo "<script>window.location=dashboard.php;</script>";
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
            <h2>Staff Login Panel</h2>
            <p>Login into your account.</p>
             <p><font color=red><strong><?php echo $msg; ?></strong></font></ p>
            <form action="" class="contact_form" method="post" name="frmuserlogin" onsubmit="return validateform()">
            <span id="idusertype"></span>
              	<br>
              Login ID:<font color=red size=4><strong>*</strong></font>
              <input name="loginid" class="form-control" type="text" placeholder="Login ID *">
              <span id="idloginid"></span>
              	<br>
              Password:<font color=red size=4><strong>*</strong></font>
              <input name="password" class="form-control" type="password" placeholder="Password *">
              <span id="idpassword"></span>
              	<br>
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
	     
	 document.getElementById("idloginid").innerHTML ="";
	 document.getElementById("idpassword").innerHTML ="";

	 if(!document.frmuserlogin.loginid.value.match(alphanumbericExp))
	 {
		 document.getElementById("idloginid").innerHTML ="<font color=red>Only alphabets and numeric values are allowed...</font>";
		 validatecondtion=1;
	 }
	  if(document.frmuserlogin.loginid.value=="")
	 {
		 document.getElementById("idloginid").innerHTML ="<font color=red>Login ID should not be empty..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmuserlogin.password.value.length < 8)
	 {
		 document.getElementById("idpassword").innerHTML ="<font color=red>Password must contain 8 characters..</font>";
		 validatecondtion=1;
	 }
	  if(document.frmuserlogin.password.value=="")
	 {
		 document.getElementById("idpassword").innerHTML ="<font color=red>Password should not be empty..</font>";
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