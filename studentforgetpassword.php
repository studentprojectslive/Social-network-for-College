<?php
include("header.php");
if(isset($_SESSION[student_id]))
{
	echo "<script>window.location=wallpost.php;</script>";
}
if(isset($_POST[submit]))
{
	$sql = "SELECT * FROM student WHERE roll_no=$_POST[rollno] AND email_id=$_POST[emailid] AND status=Active";
	$qsql = mysqli_query($con,$sql);
	if(!$qsql)
	{
		echo mysqli_error($con);
	}
	
	if(mysqli_num_rows($qsql) == 1)
	{
		$rs = mysqli_fetch_array($qsql);
		$_SESSION[sessionid] = rand(11111111,99999999);
		//16103
		//include("phpmailer.php");
		$pagename = "http://" . $_SERVER[SERVER_NAME].substr($_SERVER[PHP_SELF], 0, strrpos($_SERVER[PHP_SELF], /));
		$msg = "<a href=" . $pagename . "/stchangepasswordst.php?stid=$rs[student_id]&sessionid=$_SESSION[sessionid]>Recover password</a>";
		include("sendmail.php");
		sendmail($rs[email_id],$rs[student_name],$rs[email_id],"Password Recovery Mail..",$msg);
		echo "<script>alert(Password Recovery Mail sent Successfully..);</script>";
		echo "<script>window.location=index.php;</script>";
	}
	else
	{
		$msg =  "<p><font color=red><strong>Invalid Login credentials entered...</strong></font></ p>";
	}
}
?>
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2>Login</h2>
            <p>Login into your account.</p>
            <p><font color=red><strong><?php echo $msg; ?></strong></font></ p>
            <form action="" class="contact_form" method="post">
            Roll No:<font color=red size=4><strong>*</strong></font>
            <input name="rollno" class="form-control" type="text" placeholder="Login ID *">
            <br>
            Email Id:<font color=red size=4><strong>*</strong></font>
              <input name="emailid" class="form-control" type="email" placeholder="Email Id  *" value="<?php echo $rsedit[email_id]; ?>">
              <br />
            <input name="submit" type="submit" value="Recover Password">
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <aside class="right_content">
          <div class="single_sidebar">
            
          </div>
        </aside>
      </div>
    </div>
  </section>
 <?php
 include("footer.php")
 ?>