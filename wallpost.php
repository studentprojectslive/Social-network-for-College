<?php
include("header.php");
if(!isset($_SESSION[student_id]))
{
	echo "<script>window.location=studentlogin.php;</script>";
}
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM timeline WHERE timeline_id=$_GET[delid]";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(Timeline record deleted successfully..);</script>";
	}
}
if($_SESSION[sessionid] == $_POST[sessionid])
{
	if(isset($_POST[submit]))
	{
		$text= mysqli_real_escape_string($con, $_POST[text]);
		$sql="INSERT INTO timeline(student_id,post_type,text_message,date_time) values ($_SESSION[student_id],Text,$text,$dt $tim)";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert(Timeline record inserted successfully..);</SCRIPT>";
		}
	}
	if($_FILES["image"]["name"] != "")
	{
		$imgname = rand(). $_FILES["image"]["name"];
		move_uploaded_file($_FILES["image"]["tmp_name"],"timelineimages/".$imgname);
	}
	if(isset($_POST[submit1]))
	{
		$message= mysqli_real_escape_string($con, $_POST[message]);
		$sql="INSERT INTO timeline(student_id,post_type,text_message,image_path,date_time) values ($_SESSION[student_id],Image,$message,$imgname,$dt $tim)";
		$qsql = mysqli_query($con,$sql);
		if(!$qsql)
		{
			echo mysqli_error($con);
		}
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert(Timeline record inserted successfully..);</SCRIPT>";
		}	
	}
	if($_FILES["video"]["name"] != "")
	{
		$videoname = rand(). $_FILES["video"]["name"];
		move_uploaded_file($_FILES["video"]["tmp_name"],"timelineimages/".$videoname);
	}
	if(isset($_POST[submit2]))
	{
		$message= mysqli_real_escape_string($con, $_POST[message]);
		$sql="INSERT INTO timeline(student_id,post_type,text_message,video_path,date_time) values ($_SESSION[student_id],Video,$message,$videoname,$dt $tim)";
		$qsql = mysqli_query($con,$sql);
		if(!$qsql)
		{
			echo mysqli_error($con);
		}
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert(Timeline record inserted successfully..);</SCRIPT>";
		}
	}
}
$_SESSION[sessionid] = rand();
?>
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
            
        <!-- ################ -->
                  <div class="single_sidebar">
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#category" aria-controls="home" role="tab" data-toggle="tab">Text</a></li>
              <li role="presentation"><a href="#video" aria-controls="profile" role="tab" data-toggle="tab">Image</a></li>
              <li role="presentation"><a href="#comments" aria-controls="messages" role="tab" data-toggle="tab">Videos</a></li>
            </ul>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="category">
              
              <form action="" class="contact_form" method="post" enctype="multipart/form-data" name="frmwallpost1" onsubmit="return validateform1()">
              <input  type="hidden" name="sessionid" value="<?php echo $_SESSION[sessionid]; ?>" >
              Text:
              <textarea name="text" id="text" class="form-control" cols="30" rows="3" placeholder="text *"><?php echo $rsedit[text_message]; ?></textarea>
              <span id="idtext"></span>
              <br />
              <input name="submit" type="submit" value="submit">

              </form>
              </div>
              <div role="tabpanel" class="tab-pane" id="video">
                <div class="vide_area">
               <form action="" class="contact_form" method="post" enctype="multipart/form-data" name="frmwallpost2" onsubmit="return validateform2()">
              <input  type="hidden" name="sessionid" value="<?php echo $_SESSION[sessionid]; ?>" >
              Message:
              <textarea name="message" class="form-control" cols="30" rows="3" placeholder="message *"><?php echo $rsedit[text_message]; ?></textarea>
              Image:
              <input type="file" name="image"  class="form-control" value="<?php echo $rsedit[image_path]; ?>" accept="image/*"  onchange="loadFile(event)">
               <?php
              if($rsedit[image_path] == "")
              {
              	echo <img src="images/no-image.png" height="200" alt="Image preview..." id="previewimg">;
              }
              else
              {
              	echo "<img src=timelineimages/$rsedit[image_path] height=100 alt=Image preview... id=previewimg>";
              }
              ?>
              <br />
              <span id="idimage"></span>
              <br />
              <input name="submit1" type="submit" value="submit">
             </form>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="comments">
               <form action="" class="contact_form" method="post" enctype="multipart/form-data" name="frmwallpost3" onsubmit="return validateform3()">
              <input  type="hidden" name="sessionid" value="<?php echo $_SESSION[sessionid]; ?>" >
              Message:
              <textarea name="message" class="form-control" cols="30" rows="3" placeholder="message *"><?php echo $rsedit[text_message]; ?></textarea>
              Video:
            <input type="file" name="video"  class="form-control" value="<?php echo $rsedit[video_path]; ?>" accept="video/*" onchange="loadFile(event)">
              <span id="idvideo"></span>
              <br />
              <input name="submit2" type="submit" value="submit">
            </form>
         
              </div>

        <!--  ################  -->
        <?php   

        	$sqltimeline = "SELECT * FROM timeline order by timeline_id desc";
         $qsqltimeline = mysqli_query($con, $sqltimeline);
		 while($rstimeline = mysqli_fetch_array($qsqltimeline))
			{
						
				$sqlstudent = "SELECT * FROM student WHERE student_id=$rstimeline[student_id]";
				$qsqlstudent = mysqli_query($con, $sqlstudent);
				$rsstudent = mysqli_fetch_array($qsqlstudent);
				$dttime = strtotime($rstimeline[date_time]);
			
			 echo "<div class=single_page>
				<div class=single_page_content> 
						<div style=height:100%>
						<img src=";
							if(file_exists(studentimages/ .$rsstudent[student_img]))
							  {
									echo studentimages/ . $rsstudent[student_img];
							  }
							  else
							  {
								  echo images/no-image.png;
							  }			
						 echo " style=width:75px;height:75px;padding:5px; align=left >
						 </div>
						 <a href=#><i class=fa fa-user></i>&nbsp; $rsstudent[student_name]</a> | <a href=#><i class=fa fa-tags></i>
						 $rstimeline[post_type]</a>";
						 
						 
						 if($_SESSION[student_id] == $rsstudent[student_id])
						 {
						 echo " | <a href=wallpost.php?delid=$rstimeline[timeline_id]>Delete</a> ";
						 }
						 echo "<br>
						 <p>$rstimeline[text_message]<br>";
						if($rstimeline[post_type]== Image)
						{
						 	echo "<img src=";
								if(file_exists(timelineimages/ .$rstimeline[image_path]))
								  {
										echo timelineimages/ . $rstimeline[image_path];
								  }
								  else
								  {
									  echo images/no-image.png;
								  }
							 echo " height=400 width=700>";
					 	}	
						 
						 if($rstimeline[post_type]== Video)
						{
						 	echo "
<video height=300 width=700 controls>
  <source src=timelineimages/$rstimeline[video_path] type=video/mp4>
  Your browser does not support HTML5 video.
</video>";
						}				
echo "<br>";

				$sqlLikes = "SELECT * FROM timeline_comments WHERE timeline_id=$rstimeline[timeline_id] AND comment_type=Likes AND student_id=$_SESSION[student_id] ";
				$qsqlLikes = mysqli_query($con, $sqlLikes);
				$nooflikes = mysqli_num_rows($qsqlLikes);
				
				
				$sqlLikescount = "SELECT * FROM timeline_comments WHERE timeline_id=$rstimeline[timeline_id] AND comment_type=Likes ";
				$qsqlLikescount = mysqli_query($con, $sqlLikescount);
				$nooflikescount = mysqli_num_rows($qsqlLikescount);
				
echo "<span id=changeicon$rstimeline[timeline_id]>";
				 if(mysqli_num_rows($qsqlLikes) == 0)
				 {
					 echo "<i class=fa fa-heart-o onclick=loadlikes($rstimeline[timeline_id],$nooflikescount)>&nbsp;</i>";
				 }
				 else
				 {
					 echo "<font color=red><i class=fa fa-heart onclick=loaddislikes($rstimeline[timeline_id],$nooflikescount)>&nbsp;</i></font>";
				 }
echo "</span>";
						  	echo " | <span id=countlikes$rstimeline[timeline_id]>";
							if($nooflikescount  ==0)
							{
								echo "0 Likes";
							}
							else
							{
								echo $nooflikescount . " Likes";
							}
							echo "</span> "; 

echo "<br><span><i class=fa fa-calendar></i>&nbsp; Published on " . date("D d M Y h:i:s A",$dttime) . "</span>";	
echo "<div id=wallpostcomment$rstimeline[timeline_id]>";
include("timelinecomment.php");
echo "</div>";
?>
<textarea name=txtcmt id=txtcmt<?php echo $rstimeline[timeline_id]; ?> class=form-control style=width:100%; rows=2 placeholder=Enter comment here onkeyup="submitcomment(<?php echo $rstimeline[timeline_id]; ?>,this.value,event); "></textarea>	
	<?php												  
		echo "</div>
			  </div>";		  
    		}
			
    ?>
       </div>
        </div>
      </div> 
     </div>
     <?php include("rightsidebar.php"); ?>
    </div>
  </section>
 <?php
 include("footer.php")
 ?>
 <script type="application/javascript">
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById(previewimg);
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };

  function loadlikes(timelineid,nooflikes)
  {	
  nooflikes = nooflikes+1  
  	if(nooflikes == 0)
	{
	  document.getElementById("countlikes"+timelineid).innerHTML  = nooflikes+1 + " like";
	  document.getElementById("changeicon"+timelineid).innerHTML  = "<font color=red><i class=fa fa-heart onclick=loaddislikes(" + timelineid + "," +   nooflikes+1 + ") >&nbsp;</i></font>";
	}
	else
	{
		
	  document.getElementById("countlikes"+timelineid).innerHTML  = nooflikes  + " likes";
	  document.getElementById("changeicon"+timelineid).innerHTML  = "<font color=red><i class=fa fa-heart onclick=loaddislikes(" + timelineid + "," +   nooflikes + ") >&nbsp;</i></font>";	  
	}

	var timelineid = timelineid;
	$.post("timelinecomment.php", { timelineid: timelineid,comment_type:"Likes"},
	   function(data) {
	//	 alert("New Comment published successfully...");
		document.getElementById("countlikes"+timelineid).value="";
	   });
  }
  function loaddislikes(timelineid,nooflikes)
  {	  
nooflikes =nooflikes-1;
  	if(nooflikes == 0)
	{
	  document.getElementById("countlikes"+timelineid).innerHTML  = nooflikes  + " likes";
	  document.getElementById("changeicon"+timelineid).innerHTML  = "<i  class=fa fa-heart-o onclick=loadlikes(" + timelineid + "," + nooflikes + ")>&nbsp;</i>"; 
	}
	else
	{	  
	  document.getElementById("countlikes"+timelineid).innerHTML  = nooflikes + " like";
	  document.getElementById("changeicon"+timelineid).innerHTML  = "<i  class=fa fa-heart-o onclick=loadlikes(" + timelineid + ","  + nooflikes + ")>&nbsp;</i>"; 
	}
/*
<i class=fa fa-heart-o onclick=loadlikes($rstimeline[timeline_id],event,$nooflikes)>&nbsp;</i>
<i class=fa fa-heart onclick=loaddislikes($rstimeline[timeline_id],event,$nooflikes)>&nbsp;</i>
*/
	var timelineid = timelineid;
	$.post("timelinecomment.php", { timelineid: timelineid,comment_type:"Dislike"},
	   function(data) {
		// alert("New Comment published successfully...");
		document.getElementById("countlikes"+timelineid).value="";
	   });
  }
  
  function submitcomment(timelineid,message,e)
  	{		
		var code = (e.keyCode ? e.keyCode : e.which);
		if(code == 13) //Enter keycode
		{ 
			var txtcmt = message;	
			var timelineid = timelineid;
			document.getElementById("txtcmt"+timelineid).value="";
			$.post("timelinecomment.php", { timelineid: timelineid, txtcmt: txtcmt,comment_type:"Comment"},
			   function(data) 
			   {
				    document.getElementById("wallpostcomment"+timelineid).innerHTML  =  data;
					//	 alert("New Comment published successfully...");					
			   });
		}
	}  
</script>
 <script type="application/javascript">
 function validateform1()
 {
	 var validatecondtion = 0;
	     
	 document.getElementById("idtext").innerHTML ="";
		 
	  if(document.frmwallpost1.text.value=="")
	 {
		 document.getElementById("idtext").innerHTML ="<font color=red>Message cannot be empty...</font>";
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
 <script type="application/javascript"> 
 function validateform2()
 {
	 var validatecondtion = 0;	
	 document.getElementById("idimage").innerHTML ="";	
	 if(document.frmwallpost2.image.value=="")
	 {
		 document.getElementById("idimage").innerHTML ="<font color=red>Kindly post image.</font>";
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
 
<script type="application/javascript">
function validateform3()
{
	 var validatecondtion = 0;	 
	 document.getElementById("idvideo").innerHTML ="";	
	 if(document.frmwallpost3.video.value=="")
	 {
		 document.getElementById("idvideo").innerHTML ="<font color=red>Kindly post video...</font>";
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