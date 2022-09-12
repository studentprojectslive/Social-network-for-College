<?php
session_start();
include("dbconnection.php");
$sqlstudentchat ="SELECT * FROM student WHERE status=Active AND student_id != $_SESSION[student_id]";
if(isset($_GET[txtstudent]))
{
	$sqlstudentchat =$sqlstudentchat  . " AND student_name LIKE %$_GET[txtstudent]%";
}
$qsqlstudentchat = mysqli_query($con,$sqlstudentchat);
while($rsstudentchat = mysqli_fetch_array($qsqlstudentchat))
{
	
?>
                        <div class="chat-box-online-left" style="cursor:pointer;" onClick="loaduserchat(<?php echo $rsstudentchat[student_id]; ?>)"  >
                            <!--<i style="right: 0; color:#CCC; vertical-align:middle;" class="fa fa-circle" aria-hidden="true" ></i>-->
                            &nbsp;<img src="studentimages/<?php echo $rsstudentchat[student_img]; ?>" class="img-circle" /><?php echo $rsstudentchat[student_name]; ?>&nbsp; 
<!--( <small>Active from 3 hours</small> ) -->
                        </div>
                       <!--  <hr class="hr-clas-low" /> -->
<?php
}
?>