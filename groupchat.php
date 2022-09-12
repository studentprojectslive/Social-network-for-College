<?php
include("header.php");
?>
  <section id="contentSection">
    <div class="row">
<link href="bootstrap-chat-example/assets/css/bootstrap.css" rel="stylesheet" />
  <div >
<div class="row">
    <h3 class="text-center" >Group Chat </h3>
<center>
 <form action="" class="contact_form" method="get" name="frmsubject" onsubmit="return validateform()">
 <table  id="example" class="table table-striped table-bordered" cellspacing="0" >
  <tbody>
    <tr>
      <th scope="col">      
                    Course :<font color=red size=4><strong>*</strong></font>
            <select name="coursetitle" id="coursetitle" class="form-control">
              <option value="">Select Course</option>
              <?php
				$sqlcourse =  "SELECT * FROM course WHERE status=Active";
				$qsqlcourse = mysqli_query($con,$sqlcourse);
				while($rscourse = mysqli_fetch_array($qsqlcourse))
				{
					if($rscourse[course_id] == $_GET[coursetitle])
					{
					echo "<option value=$rscourse[course_id] selected>$rscourse[course]</option>";
					}
					else
					{					
					echo "<option value=$rscourse[course_id]>$rscourse[course]</option>";
					}
				}
				?>
                </select>
</th>
		  <th scope="col"> 
             Semester:<font color=red size=4><strong>*</strong></font>
              <select name="semester" id="semester" class="form-control">   
              <option value="">Select semester</option>
              <?php
			  $arr = array("First Semester","Second Semester","Third Semester","Fourth Semester","Fifth Semester","Sixth Semester");
			  foreach($arr as $val)
			  {
				   if($val ==  $_GET[semester])
				   {
				  echo "<option value=$val selected>$val</option>";
				   }
				   else
				   {
				  echo "<option value=$val>$val</option>";
				   }
			  }
			  ?>
              </select></th>
      <th scope="col"><br><input name="submit" type="submit" value="Submit"></th>
    </tr>
  </tbody>
</table>
	</form>
</center>
<br>
<?php
	if(isset($_GET[submit]))
	{
?>		
    <div class="col-md-8">
        <div class="panel panel-info">
            <div class="panel-heading">
                CHAT MESSAGES
            </div>
            <div class="panel-body"  style="height: 450px;overflow-y: scroll;" id="divchatmsg">
            <?php
				include("groupchatmsg.php");
			?>
            </div>
            <div class="panel-footer">
                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter Message"  name="grptextmsg" id="grptextmsg" onKeyUp="submitgroupchat(coursetitle.value,semester.value,grptextmsg.value,event)" />
                                    <span class="input-group-btn">
                                        <button class="btn btn-info" type="button" onClick="submitgroupchatbtn(coursetitle.value,semester.value)">SMILE</button>
                                    </span>
                                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4" >
          <div class="panel panel-primary">
            <div class="panel-heading">
              STUDENTS
            </div>	
            <div class="panel-body"   style="height: 500px;overflow: scroll;">
                <ul class="media-list">


<?php
$sqlstudentchat ="SELECT * FROM student WHERE status=Active AND course_id=$_GET[coursetitle] AND semester=$_GET[semester]";
$qsqlstudentchat = mysqli_query($con,$sqlstudentchat);
while($rsstudentchat = mysqli_fetch_array($qsqlstudentchat))
{
	
?>
                                    <li class="media">

                                        <div class="media-body">
            <div class="media">
                <a class="pull-left" href="#">
                    <img src="studentimages/<?php echo $rsstudentchat[student_img]; ?>" style="width: 50px;height:50px;" class="img-circle" />
                </a>
                
                <div class="media-body" >
                    <h5><?php echo $rsstudentchat[student_name]; ?> </h5>
						<?php
							$sqlchat_message = "SELECT date,time from chat_message WHERE student_id=$rsstudentchat[student_id] ";
							$qsqlchat_message = mysqli_query($con,$sqlchat_message);
							$rschat_message = mysqli_fetch_array($qsqlchat_message);
							if(mysqli_num_rows($qsqlchat_message) >= 1)
							{
							echo <small class="text-muted">Last Active on ;
							echo $rschat_message[date] . " " . $rschat_message[time];
							echo </small>;
							}
					   ?>               
                </div>
            </div>
                                        </div>
                                    </li>
<?php
}
?>
                                </ul>
                </div>
            </div>
        
    </div>
<?php
	}
?>
</div>
  </div>
            
            
    </div>
  </section>
 <?php
 include("footer.php")
 ?>
  <script type="application/javascript">
function deleteconfirm()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
 </script>
 <?php
 include("datatables.php");
 ?>
<script type="application/javascript">
	
// Chat insert message code  semester
function submitgroupchat(coursetitle,semester,textmsg,e)
{
	if(textmsg != "")
	{
		var code = (e.keyCode ? e.keyCode : e.which);
		if(code == 13) //Enter keycode
		{
			//alert(coursetitle + semester + textmsg);
			document.getElementById("grptextmsg").value="";
			$.post("jsgroupchatmsg.php", { coursetitle: coursetitle, semester: semester, textmsg: textmsg});
		}
	}
}
function submitgroupchatbtn(coursetitle,semester,smiley)
{
	var smiley = "<?php
		$arrsmile = array("smile1.gif","smile2.gif","smile3.gif","smile4.gif","smile5.gif");
		//$k = array_rand($arrsmile);
		echo "<img src=smile/".$arrsmile[rand(0,4)]." style=/max-height:250px;max-width:230px;/ >";
		?>";
			$.post("jsgroupchatmsg.php", { coursetitle: coursetitle, semester: semester, textmsg: smiley});
}
//##################Chat message ends here

    	 var chatdata1 = "";
         function loadgroupchat()
         {
			 var coursetitle = "<?php echo $_GET[coursetitle]; ?>";
			 var semester = "<?php echo $_GET[semester]; ?>";		 
			//alert(localStorage[visiblechat1]);
			 				//Load message to chat box 1
								 $.post("groupchatmsg.php", { coursetitle: coursetitle,semester: semester},
								   function(data) 
								   {
										//alert(data);	
										  if(data == chatdata1)
										  {
										  }
										  else
										  {
												chatdata1 = data;
												$("#divchatmsg").html(data);
												$(#divchatmsg).animate({ scrollTop: $(#divchatmsg).prop(scrollHeight)}, 1000);
												//document.getElementById("sound").innerHTML  ="<audio autoplay ><source src=onlinechat/mp3/surprise.mp3 type=audio/mp3 >";
										  }
								   });
         }	

          $(document).ready(function(){
			  loadgroupchat();
			  /*
			  	loadchatuserlist(); // Users list
			  	load_chat123box();	// 1st, 2nd, 3rd chat panel		  	
            	auto_load(); //Call auto_load() function when DOM is Ready
			  	chat1toggle();
			  	chat2toggle();
			  	chat3toggle();
				*/
          });
     
          //Refresh auto_load() function after 10000 milliseconds
          setInterval(loadgroupchat,1000);

</script>