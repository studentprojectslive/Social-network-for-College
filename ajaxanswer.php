<?php
session_start();
error_reporting(0);
$dttim = date("Y-m-d h:i:s");
include("dbconnection.php");
if(isset($_GET['selectedqid']))
{
		$sqlquiz_result="SELECT * FROM quiz_result WHERE quiz_question_id='$_GET[selectedqid]' AND student_id='$_SESSION[student_id]'";
		$qsqlquiz_result = mysqli_query($con,$sqlquiz_result);	
		$rsquiz_result = mysqli_fetch_array($qsqlquiz_result);
		echo $rsquiz_result['selected_option'];
}
else
{
		$sqls="SELECT * FROM quiz_result WHERE quiz_question_id='$_GET[qid]' AND student_id='$_SESSION[student_id]'";
		$qsqls = mysqli_query($con,$sqls);
		echo mysqli_error($con);
		if(mysqli_num_rows($qsqls) == 1)
		{	
				$sql="UPDATE quiz_result set quiz_id='$_GET[quizid]',student_id='$_SESSION[student_id]',quiz_question_id='$_GET[qid]',selected_option='$_GET[selectedanswer]',date_time='$dttim' WHERE quiz_question_id='$_GET[qid]'";
				$qsql = mysqli_query($con,$sql);
				if(!$qsql)
				{
					echo mysqli_error($con);
				}
		}
		else
		{
				$sqlquestion="SELECT * FROM question WHERE quiz_question_id='$_GET[qid]' ";
				$qsqlquestion = mysqli_query($con,$sqlquestion);
				$rsquestionans = mysqli_fetch_array($qsqlquestion);
			
				$sql="INSERT INTO quiz_result(quiz_id,student_id,quiz_question_id,selected_option,correct_ans,date_time) values ('$_GET[quizid]','$_SESSION[student_id]','$_GET[qid]','$_GET[selectedanswer]','$rsquestionans[correct_ans]','$dttim')";
				$qsql = mysqli_query($con,$sql);
				if(!$qsql)
				{
					echo mysqli_error($con);
				}
		}
}
?>