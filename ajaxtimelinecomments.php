<?php
include("dbconnection.php");
	 	//	Coding to view comment	
		$sqlcomments = "SELECT * FROM timeline_comments WHERE timeline_id=$rstimeline[timeline_id] AND comment_type=Comment";
		$qsqlcomments = mysqli_query($con, $sqlcomments);
		while($rscomments = mysqli_fetch_array($qsqlcomments))
		{
			$dtcommentstime = strtotime($rscomments[date_time]);
			
				$sqlcommentsstudent = "SELECT * FROM student WHERE student_id=$rscomments[student_id]";
				$qsqlcommentsstudent = mysqli_query($con, $sqlcommentsstudent);
				$rscommentsstudent = mysqli_fetch_array($qsqlcommentsstudent);
				
					echo "<div id=comment style=background-color:gold;>
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
					<div>
					<hr>";
		}	
						 	
?>