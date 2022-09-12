<?php
session_start();		
include("dbconnection.php");
$dttime= date("Y-m-d h:i:s");		
if($_POST[comment_type] =="Comment")
{
		$sql="INSERT INTO timeline_comments(comment_type,student_id,timeline_id,message,date_time) values (Comment,$_SESSION[student_id],$_POST[timelineid],$_POST[txtcmt],$dttime)";
		$qsql = mysqli_query($con,$sql);
		if(!$qsql)
		{
			echo mysqli_error($con);
		}
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert(Timeline Comment record inserted successfully..);</SCRIPT>";
		}
}
if($_POST[comment_type] =="Likes")
{
		$sql="INSERT INTO timeline_comments(comment_type,student_id,timeline_id,date_time) values (Likes,$_SESSION[student_id],$_POST[timelineid],$dttime)";
		$qsql = mysqli_query($con,$sql);
		if(!$qsql)
		{
			echo mysqli_error($con);
		}
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert(Timeline Comment record inserted successfully..);</SCRIPT>";
		}
}
if($_POST[comment_type] =="Dislike")
{
		$sql="DELETE from timeline_comments where comment_type=Likes and student_id=$_SESSION[student_id]";
		$qsql = mysqli_query($con,$sql);
		if(!$qsql)
		{
			echo mysqli_error($con);
		}
}
	 	//	Coding to view comment	
		$sqlcomments = "SELECT * FROM timeline_comments WHERE ";
		if(isset($_POST[timelineid]))
		{
		$sqlcomments = $sqlcomments ." timeline_id=$_POST[timelineid] ";
		}
		else
		{		
		$sqlcomments = $sqlcomments ." timeline_id=$rstimeline[timeline_id] ";
		}
		$sqlcomments = $sqlcomments ." AND comment_type=Comment";
		$qsqlcomments = mysqli_query($con, $sqlcomments);
		while($rscomments = mysqli_fetch_array($qsqlcomments))
		{
				$dtcommentstime = strtotime($rscomments[date_time]);
			
				$sqlcommentsstudent = "SELECT * FROM student WHERE student_id=$rscomments[student_id]";
				$qsqlcommentsstudent = mysqli_query($con, $sqlcommentsstudent);
				$rscommentsstudent = mysqli_fetch_array($qsqlcommentsstudent);
				
					echo "<div  style=background-color:#FFBBFF;>
					<img src=";
							if(file_exists(studentimages/ .$rscommentsstudent[student_img]))
							  {
									echo studentimages/ . $rscommentsstudent[student_img];
							  }
							  else
							  {
								  echo images/no-image.png;
							  }			
					echo " style=width:75px;height:75px;padding:5px; align=left >
					<strong>$rscommentsstudent[student_name]</strong><br />".$rscomments[message]."
					<br><span><i class=fa fa-calendar></i>&nbsp; Published on " . date("D d M Y h:i:s A",$dtcommentstime) . "</span>					
						<hr></div> ";
		}
?>
