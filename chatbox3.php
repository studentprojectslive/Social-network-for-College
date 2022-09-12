<?php
session_start();
include("dbconnection.php");
if(isset($_POST[chatstudent_id]))
{
	$_SESSION[chat3student_id] = $_POST[chatstudent_id];
}

$sqlstudent = "SELECT * FROM student INNER JOIN course ON student.course_id = course.course_id  WHERE student_id=$_SESSION[chat3student_id]";
$qsqlstudent = mysqli_query($con,$sqlstudent);
$rsstudent = mysqli_fetch_array($qsqlstudent);
?> 
                <div class="chat-box-div">
                    <div class="chat-box-head"  style="cursor:pointer;" onClick="chat3sessiontoggle()">
                        <?php echo $rsstudent[student_name]; ?>
                            <div class="btn-group pull-right">
                                    <a href="#" onClick="chat3close()"><span class="fa fa-times-circle" style="font-size: 30px;color:darkred;"></span>&nbsp;</a>
                            </div>
                    </div>
        <div class="panel-body chat-box-main" id="chatmessage3" style="background-color:#F8F8F8;height:250px;">                        
            <?php
			$stid = $_SESSION[chat3student_id];
			include("jsloadmsg.php");
            ?>
        </div> 
        
        <div class="chat-box-footer"  id="chatmessagefooter3">
            <div class="input-group">
                <input type="text" class="form-control" id="txtchat3" placeholder="Press Enter key to Send.."  onkeyup="submitchat(<?php echo $stid; ?>,Student,this.value,event)">
                <span class="input-group-btn">
       <button class="btn btn-info" type="button" onClick="submitbtnchat(<?php echo $stid; ?>,Student,txtchat3.value,event)">SEND</button>
                </span>
            </div>
        </div>

                </div>
<?php
/*                          
<div class="chat-box-div">
    <div class="chat-box-head">
       Online Chat
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="fa fa-cogs"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#"><span class="fa fa-map-marker"></span>&nbsp;Invisible</a></li>
                                    <li><a href="#"><span class="fa fa-comments-o"></span>&nbsp;Online</a></li>
                                    <li><a href="#"><span class="fa fa-lock"></span>&nbsp;Busy</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><span class="fa fa-circle-o-notch"></span>&nbsp;Logout</a></li>
                                </ul>
                            </div>
        </div>
        
        <div class="panel-body chat-box-main" id="chatmessage" style="background-color:#F8F8F8">                        
            <?php
            include("jschatmsg.php");
            ?>
        </div> 
    
    <div class="chat-box-footer"  id="chattext">
        <div class="input-group">
            <input type="text" class="form-control" id="txtchat" placeholder="Press Enter key to Send.."  onkeyup="submitchat(<?php echo $_SESSION["chatid"]; ?>,Customer,this.value,event);">
            <span class="input-group-btn">
                <button class="btn btn-info" type="button" onclick="submitchat(<?php echo $_SESSION["chatid"]; ?>,Customer,this.value,event);">SEND</button>
            </span>
        </div>
    </div>
</div>
*/
?>