<?php
include("header.php");
if($_SESSION[sessionid] == $_POST[sessionid])
{
	if($_FILES[profileimage][name] != "")
	{
		$imgname = rand(). $_FILES[profileimage][name];
		move_uploaded_file($_FILES["profileimage"]["tmp_name"],"userprofileimages/".$imgname);
	}
	if(isset($_POST[submit]))
	{
			$sql="UPDATE user set name=$_POST[name],";
			if($_FILES[profileimage][name] != "")
			{
			$sql = $sql . "user_img=$imgname,";
			}
			$sql = $sql .
			"login_id=$_POST[loginid],status=Active WHERE user_id=$_SESSION[user_id]";
			$qsql = mysqli_query($con,$sql);
			if(!$qsql)
			{
				echo mysqli_error($con);
			}
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<SCRIPT>alert(User record UPDATED successfully.);</SCRIPT>";
				echo "<script>window.location=dashboard.php;</script>";
			}
	}
}
$_SESSION[sessionid] = rand();
if(isset($_SESSION[user_id]))
{
	$sqledit = "SELECT * FROM user WHERE user_id=$_SESSION[user_id]";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2>Update your profile</h2>
            <p>Update your profile here.</p>
            <form action="" class="contact_form" method="post" enctype="multipart/form-data"  name="frmuserprofile" onsubmit="return validateform()">
            <input  type="hidden" name="sessionid" value="<?php echo $_SESSION[sessionid]; ?>" >
              <br>
               Name:
              <input name="name" class="form-control" type="text" placeholder="Name *" value="<?php echo $rsedit[name]; ?>">
              <span id="idname"></span>
              <br>
               Profile Image:
              <input type="file" name="profileimage" class="form-control" accept="image/*"  onchange="loadFile(event)" title="Upload image">
              <?php
              if($rsedit[user_img] == "")
              {
              	echo <img src="images/no-image.png" height="200" alt="Image preview..." id="previewimg">;
              }
              else
              {
              	echo "<img src=userprofileimages/$rsedit[user_img] height=200 alt=Image preview... id=previewimg>";
              }
              ?>
              <br />
              Login Id:
              <input name="loginid" class="form-control" type="text" placeholder="Login Id *" value="<?php echo $rsedit[login_id]; ?>"
              <?php 
			  if(isset($_SESSION[user_id]))
			  {
				  echo " readonly";
			  }
			  ?>
              >
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
	
	 if(!document.frmuserprofile.name.value.match(alphaspaceExp))
	 {
		 document.getElementById("idname").innerHTML ="<font color=red>Name should contain only alphabets...</font>";
		 validatecondtion=1;
	 }
	 if(document.frmuserprofile.name.value=="")
	 {
		 document.getElementById("idname").innerHTML ="<font color=red>Name should not be empty...</font>";
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
