<?php
session_start();
date_default_timezone_set(Asia/Kolkata);
include("dbconnection.php");
$dttime = date("Y-m-d h:i:s");
$sqlmessage = "SELECT * FROM group_chat WHERE course_id=$_POST[coursetitle] AND semester=$_POST[semester] ";
$qsqlmessage = mysqli_query($con,$sqlmessage);
$rsmessage = mysqli_fetch_array($qsqlmessage);
$countmsg =mysqli_num_rows($qsqlmessage);
$msgid=$rsmessage[0];
if($countmsg != 0)
{
?>
<ul class="media-list">
<?php
	$sqlchat_message = "SELECT * FROM chat_message INNER JOIN student ON chat_message.student_id = student.student_id WHERE chat_message.group_chat_id=$msgid ";
	$qsqlchat_message = mysqli_query($con,$sqlchat_message);
	echo mysqli_error($con);
	while($rschat_message = mysqli_fetch_array($qsqlchat_message))
	{
?>
    <li class="media">
		<div class="media-body">
			<div class="media">
				<a class="pull-left" href="#">
					<img class="media-object img-circle" width="50px" src="studentimages/<?php echo $rschat_message[student_img]; ?>"  />
				</a>
				<div class="media-body" >
				   <strong><?php echo $rschat_message[student_name]; ?></strong><br>
					<?php
					echo $rschat_message[message];
					?>
					<br />
				   <small class="text-muted">Sent on <?php echo date("d-M-Y h:i:s A",strtotime($rschat_message[date] . " ". $rschat_message[time])); ?></small>
					<hr />
				</div>
			</div>
		</div>
    </li>
<?php
	}
?>	
 </ul>
 <?php
}
?>