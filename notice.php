<?php
include("header.php");
if(!isset($_SESSION[user_id]))
{
	echo "<script>window.location=userlogin.php;</script>";
}
if($_SESSION[sessionid] == $_POST[sessionid])
{
	if($_FILES["uploadfile"]["name"] != "")
	{
		$imgname = rand(). $_FILES["uploadfile"]["name"];
		move_uploaded_file($_FILES["uploadfile"]["tmp_name"],"noticeimages/".$imgname);
	}
	if(isset($_POST[submit]))
	{
		$title= mysqli_real_escape_string($con, $_POST[title]);
		$description= mysqli_real_escape_string($con, $_POST[description]);
		
	    if(isset($_GET[editid]))
		{
			  $sql="UPDATE notice set notice_type=$_POST[noticetype],user_id=$_POST[user],title=$title,description=$description,";
			 if($_FILES["uploadfile"]["name"] != "")
			{
			$sql = $sql . "uploads=$imgname,";
			}
			$sql = $sql . 
			 "date_time=$dt $tim,status=Active WHERE notice_id=$_GET[editid]";
				$qsql = mysqli_query($con,$sql);
				if(!$qsql)
				{
					echo mysqli_error($con);
				}
				if(mysqli_affected_rows($con) == 1)
				{
					echo "<SCRIPT>alert(Notice record UPDATED successfully..);</SCRIPT>";
					echo "<script>window.location=viewnotice.php;</script>";
				}	
	    }
		else
		{
				$sql="INSERT INTO notice(notice_type,user_id,title,description,uploads,date_time,status) values ($_POST[noticetype],$_SESSION[user_id],$title,$description,$imgname,$dt $tim,Active)";
				$qsql = mysqli_query($con,$sql);
				if(!$qsql)
				{
					echo mysqli_error($con);
				}
				if(mysqli_affected_rows($con) == 1)
				{
					echo "<SCRIPT>alert(Notice record inserted successfully.);</SCRIPT>";
					echo "<script>window.location=viewnotice.php;</script>";
				}
		}
	}
}
$_SESSION[sessionid] = rand();
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM notice WHERE notice_id=$_GET[editid]";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>

  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2>Publish Notice here</h2>
            <p>Add your notice.</p>
            <form action="" class="contact_form" method="post" enctype="multipart/form-data" name="frmnotice" onsubmit="return validateform()">
            <input  type="hidden" name="sessionid" value="<?php echo $_SESSION[sessionid]; ?>" >
            Notice Type:<font color=red size=4><strong>*</strong></font>
            <select name="noticetype" class="form-control" tabindex="1" autofocus="autofocus">
            <option value="">Select</option>
            	<?php
				$arr = array("Events","Meeting","News and Updates");				
					foreach($arr as $val)
					{
						if($val == $rsedit[notice_type])
						{
						echo "<option vaulue=$val selected>$val</option>";
						}
						else
						{
						 echo "<option value=$val>$val</option>";	
						}
					}
				?>      
              </select>
              <span id="idnoticetype"></span>
              <br />
              Title:<font color=red size=4><strong>*</strong></font>
              <input type="text" name="title" class="form-control" placeholder="title *" value="<?php echo $rsedit[title]; ?>" tabindex="2">
              <span id="idtitle"></span>
              <br />
              Description<font color=red size=4><strong>*</strong></font>:
               <script src="richtexteditor/tinymce.min.js"></script>
               <script>tinymce.init({ selector:textarea });</script>
              <textarea name="description" id="descriptions" class="form-control" cols="30" rows="10" placeholder="description *" tabindex="3"><p><?php
			  if(isset($_GET[editid]))
			  {
			  echo strip_tags(substr($rsedit[description], 0, 50000)); 
			  }
			  ?></p></textarea>
              <span id="iddescription"></span>
              <br />
              Upload Image:
      <input type="file" name="uploadfile"  class="form-control" value="<?php echo $rsedit[uploads]; ?>" accept="image/*"  onchange="loadFile(event)" tabindex="4">
              <?php
              if($rsedit[uploads] == "")
              {
              	echo <img src="images/no-image.png" height="200" alt="Image preview..." id="previewimg">;
              }
              else
              {
              	echo "<img src=noticeimages/$rsedit[uploads] height=200 alt=Image preview... id=previewimg>";
              }
              ?>
			  <br />
			  <br />
              <input name="submit" type="submit" value="submit">
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
	 var validatecondtion = 0;
	     
	 document.getElementById("idnoticetype").innerHTML ="";
	 document.getElementById("idtitle").innerHTML ="";
	 document.getElementById("iddescription").innerHTML ="";
	      
	  if(document.frmnotice.noticetype.value=="")
	 {
		 document.getElementById("idnoticetype").innerHTML ="<font color=red>Kindly select Notice type..</font>";
		 validatecondtion=1;
	 }
	  if(document.frmnotice.title.value=="")
	 {
		 document.getElementById("idtitle").innerHTML ="<font color=red>Title cannot be empty..</font>";
		 validatecondtion=1;
	 }

	  if(tinyMCE.get(descriptions).getContent() =="")
	 {
		 document.getElementById("iddescription").innerHTML ="<font color=red>Description should not be empty...</font>";
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