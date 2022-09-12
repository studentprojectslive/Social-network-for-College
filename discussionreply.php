<?php
include("header.php");
if($_SESSION[sessionid] == $_POST[sessionid])
{
	if($_FILES["uploads"]["name"] != "")
	{
		$imgname = rand(). $_FILES["uploads"]["name"];
		move_uploaded_file($_FILES["uploads"]["tmp_name"],"discussionreplyimages/".$imgname);
	}
	if(isset($_POST[submit]))
	{
		if(isset($_GET[editid]))
		{
	$sql="UPDATE discussion_reply set discussion_id=$_POST[discussiontitle],student_id=$_SESSION[student_id],user_id=$_SESSION[user_id],message=$_POST[message],";
	if($_FILES["uploads"]["name"] != "")
			{
			$sql = $sql . "uploads=$imgname,";
			}
			$sql = $sql . 
	"date_time=$dt $tim WHERE discussion_reply_id=$_GET[editid]";
		$qsql = mysqli_query($con,$sql);
		if(!$qsql)
		{
			echo mysqli_error($con);
		}
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert(Discussion reply record UPDATED successfully..);</SCRIPT>";
		}	
	    }
		else
		{
		$sql="INSERT INTO discussion_reply(discussion_id,student_id,user_id,message,uploads,date_time) values ($_POST[discussiontitle],$_SESSION[student_id],$_SESSION[user_id],$_POST[message],$imgname,$dt $tim)";
		$qsql = mysqli_query($con,$sql);
		if(!$qsql)
		{
			echo mysqli_error($con);
		}
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert(Discussion reply record inserted successfully);</SCRIPT>";
		}
		}
	}
}
$_SESSION[sessionid] = rand();
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM discussion_reply WHERE discussion_reply_id=$_GET[editid]";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2>Discussion Reply</h2>
            <p>Add your replies.</p>
            <form action="" class="contact_form" method="post" enctype="multipart/form-data" name="frmdiscussionreply" onsubmit="return validateform()" >
            <input  type="hidden" name="sessionid" value="<?php echo $_SESSION[sessionid]; ?>" >
            Discussion Title:
            <select name="discussiontitle" class="form-control" >
            <option value="">Select Title</option>
              	<?php
				$sqldiscussion =  "SELECT * FROM discussion WHERE status=Active";
				$qsqldiscussion = mysqli_query($con,$sqldiscussion);
				while($rsdiscussion = mysqli_fetch_array($qsqldiscussion))  
				{                                                               
					if($rsdiscussion[discussion_id] == $rsedit[discussion_id])
					{
					echo "<option value=$rsdiscussion[discussion_id] selected>$rsdiscussion[discussion_title]</option>";
					}
					else
					{					
					echo "<option value=$rsdiscussion[discussion_id]>$rsdiscussion[discussion_title]</option>";
					}
				}
				?>
              </select>
              <span id="iddiscussiontitle"></span>
              <br />
              Message:
              <textarea name="message" class="form-control" cols="30" rows="10" placeholder="message *"><?php echo $rsedit[message]; ?></textarea>
              <span id="idmessage"></span>
              	<br>
              Uploads:
              <input type="file" name="uploads"  class="form-control" value="<?php echo $rsedit[uploads]; ?>" accept="image/*" onchange="loadFile(event)">
              <?php
              if($rsedit[uploads] == "")
              {
              	echo <img src="images/no-image.png" height="200" alt="Image preview..." id="previewimg">;
              }
              else
              {
              	echo "<img src=discussionreplyimages/$rsedit[uploads] height=200 alt=Image preview... id=previewimg>";
              }
              ?>
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
	     
	 document.getElementById("iddiscussiontitle").innerHTML ="";
	 document.getElementById("idmessage").innerHTML ="";
		
	 if(document.frmdiscussionreply.discussiontitle.value=="")
	 {
		 document.getElementById("iddiscussiontitle").innerHTML ="<font color=red>Kindly select discussion title..</font>";
		 validatecondtion=1;
	 }	  
	  if(document.frmdiscussionreply.message.value=="")
	 {
		 document.getElementById("idmessage").innerHTML ="<font color=red>Message cannot be empty...</font>";
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