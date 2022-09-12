<div class="col-lg-4 col-md-4 col-sm-4">
        <div class="latest_post">
          <h2><span>Quiz Result</span></h2>
          <div class="latest_post_container">
            <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
            <ul class="latest_postnav">
              
              <?php
			  $sqlquizresultsidebar = "SELECT DISTINCT quiz_id, student_id FROM quiz_result ORDER BY quiz_result_id DESC limit 0,5";
			  $qsqlquizresultsidebar = mysqli_query($con,$sqlquizresultsidebar);
			  echo mysqli_error($con);
			  while($rsquizresultsidebar = mysqli_fetch_array($qsqlquizresultsidebar))
			  {
				  $scored=0;
				  	  $sqlstudent = "SELECT * FROM student WHERE student_id=$rsquizresultsidebar[student_id]";
					  $qsqlstudent = mysqli_query($con,$sqlstudent);
					  $rsstudent = mysqli_fetch_array($qsqlstudent);
  						
						$sqlquiz ="SELECT * FROM quiz WHERE quiz_id=$rsquizresultsidebar[quiz_id]";
		  				$qsqlquiz = mysqli_query($con, $sqlquiz);
		 				$rsrecquiz = mysqli_fetch_array($qsqlquiz);
						
						  	$sqlquiz_result ="SELECT * FROM quiz_result WHERE quiz_id=$rsquizresultsidebar[quiz_id] AND  student_id=$rsquizresultsidebar[student_id] ";
							$qsqlquiz_result = mysqli_query($con, $sqlquiz_result);
							$totquestionquiz_result = mysqli_num_rows($qsqlquiz_result);
							while($rsrecquiz_result = mysqli_fetch_array($qsqlquiz_result))
							{
									  if($rsrecquiz_result[correct_ans] == $rsrecquiz_result[selected_option])
									  {
										  $scored=$scored+1;
									  }
							}
			  ?>
              <li>
             <?php  $totalpercent = $scored *100/$totquestionquiz_result;
			  if($totalpercent >= 50)
				   {
				  ?>
                <div class="media"> <a href="#" class="media-left"> <img alt="" src="studentimages/<?php echo $rsstudent[student_img]; ?>"> </a>
                  <div class="media-body"> 
                  <a href="#" class="catg_title"><strong><?php echo $rsstudent[student_name]; ?></strong></a> <br />
                  <?php echo $rsrecquiz[title]; ?><br />
                  Percentage: <?php
				   echo $totalpercent;?> %
               
                  </div>
                  
                </div>
                 <?php   } ?>
              </li>
              <?php
			  }
			  ?>
              
            </ul>
            <div id="next-button"><i class="fa  fa-chevron-down"></i></div>
          </div>
        </div>
      </div>