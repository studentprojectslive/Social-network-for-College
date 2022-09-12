<?php
date_default_timezone_set(Asia/Kolkata);
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT &  ~E_WARNING);
session_start();
include("dbconnection.php");
if(isset($_POST[chatsessionid]))
{
	$stid = $_POST[chatsessionid];
}

$sqlmessage = "SELECT * FROM chat WHERE (student_id1=$_SESSION[student_id] AND student_id2=$stid) OR (student_id2=$_SESSION[student_id] AND student_id1=$stid) ";
$qsqlmessage = mysqli_query($con,$sqlmessage);
$rsmessage = mysqli_fetch_array($qsqlmessage);
$countmsg =mysqli_num_rows($qsqlmessage);
$msgid=$rsmessage[0];

	 $sqlreplymsg = "SELECT * FROM chat_message INNER JOIN student ON chat_message.student_id=student.student_id WHERE chat_message.chat_id=$msgid AND group_chat_id=0 ORDER BY chat_message.date,chat_message.time";
	$qsqlreplymsg = mysqli_query($con,$sqlreplymsg);
if(mysqli_num_rows($qsqlreplymsg) != 0)
{
	while($rsreplymsg = mysqli_fetch_array($qsqlreplymsg))
	{
?>            
		<div class="chat-box-left">
			<img src=studentimages/<?php echo $rsreplymsg[student_img]; ?> style="width: 40px; height: 40px;padding: 2px;" align=left>
			<strong style="color:#9B0305;"><?php echo $rsreplymsg[student_name]; ?>:</strong>
			<?php echo "<br>".$rsreplymsg[message]; ?>
		</div>
<?php
	}
}
?>