<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM discussion_reply WHERE discussion_reply_id=$_GET[delid]";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(Discussion reply record deleted successfully..);</script>";
	}
}
if($_SESSION[sessionid] == $_POST[sessionid])
{
	if(isset($_POST[brnreply]))
	{
		if($_FILES["uploads"]["name"] != "")
		{
			$imgname = rand(). $_FILES["uploads"]["name"];
			move_uploaded_file($_FILES["uploads"]["tmp_name"],"discussionreplyimages/".$imgname);
		}
			$sql="INSERT INTO discussion_reply(discussion_id,student_id,user_id,message,uploads,date_time) values ($_GET[discussionid],$_SESSION[student_id],$_SESSION[user_id],$_POST[message],$imgname,$dt $tim)";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<SCRIPT>alert(You have published reply for this discussion forum..);</SCRIPT>";
			}
	}
}
$_SESSION[sessionid] = rand();

$sqlsubject = "SELECT * FROM subject WHERE status=Active AND course_id=$rsstudent[course_id] AND semester=$rsstudent[semester] ";
$qsqlsubject = mysqli_query($con,$sqlsubject);
$rssubject = mysqli_fetch_array($qsqlsubject);
?>
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="single_page">
            <ol class="breadcrumb">
              <li><a href="discussiondisplay.php">Home</a></li>
              <li><a href="#"><?php echo "$_GET[subject]"; ?></a></li>
            </ol>
	<?php   
    if(isset($_GET[discussionid]))
    {
       $sqldiscussion ="SELECT * FROM discussion WHERE discussion_id=$_GET[discussionid]";
       $qsqldiscussion = mysqli_query($con, $sqldiscussion);
       $rsrecdiscussion = mysqli_fetch_array($qsqldiscussion);

       $sqlstudent = "SELECT * FROM student WHERE student_id=$rsrecdiscussion[student_id]";
	   $qsqlstudent = mysqli_query($con,$sqlstudent);
	   $rsstudent = mysqli_fetch_array($qsqlstudent);
    }
    ?>
    
    <div style=height:100%>
						<img src=
							<?php if(file_exists(studentimages/ .$rsstudent[student_img]))
							  {
									echo studentimages/ . $rsstudent[student_img];
							  }
							  else
							  {
								  echo images/no-image.png;
							  } ?>			
						style=width:75px;height:75px;padding:5px; align=left >
						 </div>
						<b> <a href=#><i class=fa fa-user></i> <?php echo "$rsstudent[student_name]"; ?></a> | <a href=#><i class=fa fa-tags></i>
						 <?php echo "$_GET[subject]";?></a>
                          <span> | <i class="fa fa-calendar"></i> <?php echo "$rsrecdiscussion[date_time]";?></span></b>
                         
                         
            <h1><font color="#3300CC"><?php echo "$rsrecdiscussion[discussion_title]";?></font></h1>
          <?php  /*<div class="post_commentbox"> <a href="#"><i class="fa fa-user"></i><?php echo "$rsstudent[student_name]"; ?></a> <span><i class="fa fa-calendar"></i><?php echo "$rsrecdiscussion[date_time]";?></span> <a href="#"><i class="fa fa-tags"></i></a><?php echo "$_GET[subject]";?></div>*/ ?>
            <div >
            <hr /> 
              <p><?php echo "$rsrecdiscussion[discussion_description]";?></p>
             
             

            </div>

            <div class="related_post"> 
              <h2><i class="fa fa-reply "></i> Discussion Reply </h2>
       <form action="" class="contact_form" method="post" enctype="multipart/form-data" name="frmsingledis" onsubmit="return validateform()" >
              <input  type="hidden" name="sessionid" value="<?php echo $_SESSION[sessionid]; ?>" >
              <textarea name="message" class="form-control" cols="30" rows="3" placeholder="Type message here"><?php echo $rsedit[text_message]; ?></textarea>
             <span id="idmessage"></span>
             <br />
              Attach files:
              <input type="file" name="uploads"  class="form-control" value="<?php echo $rsedit[image_path]; ?>"   onchange="loadFile(event)">
             <span id="iduploads"></span>
             <br />
              <input name="brnreply" type="submit" value="Post Comment">
</form>
				<br />
              <ul class="spost_nav wow fadeInDown animated">

<?php  
	 $sql ="SELECT * FROM discussion_reply WHERE discussion_id=$_GET[discussionid] order by discussion_reply_id DESC";
	 $qsql = mysqli_query($con, $sql);
	 while($rsrec = mysqli_fetch_array($qsql))
	  {
		  $sqlstudent = "SELECT * FROM student WHERE student_id=$rsrec[student_id]";
		  $qsqlstudent = mysqli_query($con,$sqlstudent);
		  $rsstudent = mysqli_fetch_array($qsqlstudent);
		  
		  $sqluser = "SELECT * FROM user WHERE user_id=$rsrec[user_id]";
		  $qsqluser = mysqli_query($con,$sqluser);
		  $rsuser = mysqli_fetch_array($qsqluser);
		  
		  $dtcommentstime = strtotime($rsrec[date_time]);
		  echo "<li style=background-color:#FFBBFF;width:100%><div id=comment style=background-color:#FFBBFF;width:100%>";
					if($rsrec[user_id] != 0)
					{
						echo "<img src=";
							if(file_exists(userprofileimages/ .$rsuser[user_img]))
							  {
									echo userprofileimages/ . $rsuser[user_img];
							  }
							  else
							  {
								  echo images/no-image.png;
							  }		
					echo " style=width:75px;height:75px;padding:5px; align=left >";
					}
					if($rsrec[student_id] != 0)
					{
					echo "<img src=";
					        if(file_exists(studentimages/ .$rsstudent[student_img]))
							  {
									echo studentimages/ . $rsstudent[student_img];
							  }
							  else
							  {
								  echo images/no-image.png;
							  }	
					echo " style=width:75px;height:75px;padding:5px; align=left>";
					}
					echo "<strong>";
					if($rsrec[user_id] != 0)
					{
					echo $rsuser[name];
					}
					if($rsrec[student_id] != 0)
					{
					echo $rsstudent[student_name];
					}
					 if(($_SESSION[student_id] == $rsstudent[student_id])&&($_SESSION[user_id] == $rsuser[user_id]))
					 {
					echo " | &nbsp;<a href=single_page_discussion.php?discussionid=$_GET[discussionid]&subject=$_GET[subject]&delid=$rsrec[discussion_reply_id] onclick=return deleteconfirm()>Delete</a>";
					 }
					echo "</strong><br>".$rsrec[message]."<div>";
					if($rsrec[uploads] != "")
					{
						echo "<strong><a href=discussionreplyimages/$rsrec[uploads] download ><font color=blue>Download attached file</font></a></strong>";
					}
					echo "<br><span style=color:black;><i class=fa fa-calendar></i>&nbsp; Published on " . date("D d M Y h:i:s A",$dtcommentstime) . "</span></li>";
					
	  }
?>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <?php include("rightsidebar.php"); ?>
    </div>
  </section>
<?php
include("footer.php");
?>
<script type="application/javascript">
function validateform()
 {
	 var validatecondtion = 0;  
	     
	 document.getElementById("idmessage").innerHTML ="";
	  document.getElementById("iduploads").innerHTML ="";
		 
	  if((document.frmsingledis.message.value=="")&&(document.frmsingledis.uploads.value==""))
	 {
		  document.getElementById("iduploads").innerHTML ="<font color=red>Reply cant be empty...</font>";
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
 