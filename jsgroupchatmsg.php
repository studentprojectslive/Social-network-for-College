<?php
session_start();
date_default_timezone_set(Asia/Kolkata);
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT &  ~E_WARNING);
include("dbconnection.php");
$dttime = date("Y-m-d h:i:s");

$dt= date("Y-m-d"); $tim = date("h:i:s");

$sqlmessage = "SELECT * FROM group_chat WHERE course_id=$_POST[coursetitle] AND semester=$_POST[semester] ";
	
$qsqlmessage = mysqli_query($con,$sqlmessage);
$rsmessage = mysqli_fetch_array($qsqlmessage);
$countmsg =mysqli_num_rows($qsqlmessage);
$msgid=$rsmessage[0];

	if($countmsg == 0)
	{
		$sql = "INSERT INTO group_chat(course_id,semester) VALUES($_POST[coursetitle],$_POST[semester])";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);	
		$msgid = mysqli_insert_id($con);
	}
	if($_POST[textmsg] != "")
	{
		$msg = mysqli_real_escape_string($con,$_POST[textmsg]);
		$sql = "INSERT INTO chat_message(group_chat_id,student_id,date,time,message,message_status) VALUES($msgid,$_SESSION[student_id],$dt,$tim,$msg,Active)";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	}
?>
<!--   <hr class="hr-clas" /> -->