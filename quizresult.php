<?php
include("header.php");
$_SESSION[sessionid] = rand();
$_SESSION[quizid1] =$_SESSION[quizid];
unset($_SESSION[quizid]);
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM question WHERE quiz_question_id=$_GET[editid]";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2>Quiz result</h2>
<div id="printdiv">
<?php
$scored=0;
$slno =1;
  	$sql ="SELECT * FROM quiz_result WHERE quiz_id=$_GET[quizid] AND student_id=$_SESSION[student_id] ";
  	$qsql = mysqli_query($con, $sql);
	$noqresult = mysqli_num_rows($qsql);	
	if($noqresult == 0)
	{
		  	$sqlquizq ="SELECT * FROM question WHERE quiz_id=$_GET[quizid] ";
			$qsqlquizq = mysqli_query($con, $sqlquizq);
			while($rsrecquizq = mysqli_fetch_array($qsqlquizq))
			{
		
				$sql="INSERT INTO quiz_result(quiz_id,student_id,quiz_question_id,selected_option,correct_ans,date_time) values ($_GET[quizid],$_SESSION[student_id],$rsrecquizq[0],Null,0,$dttim)";
				$qsql = mysqli_query($con,$sql);
				if(!$qsql)
				{
					echo mysqli_error($con);
				}
			}
	}

  	echo $sql ="SELECT * FROM quiz_result WHERE quiz_id=$_GET[quizid] AND student_id=$_SESSION[student_id] ";
  	$qsql = mysqli_query($con, $sql);
	while($rsrec = mysqli_fetch_array($qsql))
	{
		  	$sqlquizq ="SELECT * FROM question WHERE quiz_question_id=$rsrec[quiz_question_id] ";
			$qsqlquizq = mysqli_query($con, $sqlquizq);
			$rsrecquizq = mysqli_fetch_array($qsqlquizq);
?>

<table border="1" class="table table-striped table-bordered" cellspacing="0" style="width:100%">
  <tr>
    <th height="29" colspan="2" style="color:#039" scope="col">&nbsp;<span id="idq"><?php echo $slno; ?>) <?php echo $rsrecquizq[question]; ?></span></th>
    </tr>
  <tr>
    <th colspan="2" scope="col"> 1.&nbsp;
      &nbsp;<span id="ido1"><?php echo $rsrecquizq[option1];  ?></span></th>
    </tr>  
  <tr>
    <th colspan="2" scope="col">2.&nbsp;
      &nbsp;<span id="ido2"><?php echo $rsrecquizq[option2]; ?></span></th>
    </tr>
  <tr>
    <th colspan="2" scope="col">3.&nbsp;
      &nbsp;<span id="ido3"><?php echo $rsrecquizq[option3]; ?></span></th>
    </tr>
  <tr>
    <th colspan="2" scope="col">4.&nbsp;
      &nbsp;<span id="ido4"><?php echo $rsrecquizq[option4]; ?></span></th>
    </tr>
  <tr>
    <th colspan="2" scope="col">Your Answer
      &nbsp;<span id="ido4">
	  <?php     
	  if($rsrecquizq[correct_ans] == $rsrec[selected_option])
	  {
		  $scored=$scored+1;
		  echo "<img src=images/right.jpg width=50 height=50>";
	  }
	  else
	  {
		    echo "<img src=images/wrong.jpg width=50 height=50>";		  
	  }
	  echo $rsrec[selected_option] . " " . $rsrecquizq[selected_option];
	  
	  ?>
      </span></th>
    </tr>    
  <tr>
    <th colspan="2" scope="col">Correct Answer
      &nbsp;<span id="ido4">
	  <?php
      echo $rsrecquizq[correct_ans];
	  ?>
      </span></th>
    </tr>
 </table>
<?php
$slno++;
	}
	$count=0;
?>
<table border="1" class="table table-striped table-bordered" cellspacing="0" style="width:100%">
  <tr>
    <th height="29" colspan="2" style="color:#039" scope="col">&nbsp;<span id="idq">Total marks</span></th>
     <th height="29" colspan="2" style="color:#039" scope="col">&nbsp;<span id="idq"><?php 
	 		$sqlquizq ="SELECT * FROM question WHERE quiz_id=$_GET[quizid] ";
			$qsqlquizq = mysqli_query($con, $sqlquizq);
	 echo mysqli_num_rows($qsqlquizq); 
	 ?></span></th>
    </tr>
  <tr>
    <th height="29" colspan="2" style="color:#039" scope="col">&nbsp;<span id="idq">Scored marks</span></th>
     <th height="29" colspan="2" style="color:#039" scope="col">&nbsp;<span id="idq"><?php echo $scored; ?></span></th>
    </tr>  
    <tr>
    <th height="29" colspan="2" style="color:#039" scope="col">&nbsp;<span id="idq">Percentage</span></th>
     <th height="29" colspan="2" style="color:#039" scope="col">&nbsp;<span id="idq"><?php echo number_format((float) ($scored/mysqli_num_rows($qsqlquizq)*100), 2, ., ); ?>%</span></th>
    </tr>
</table>    

</div>
 <hr />
<form method="post" action="">
  	<input name="submit" type="button" value="Print" onclick="printtext(printdiv)">
</form>
          </div>
        </div>
      </div> 
     <?php include("rightsidebar.php"); ?>
    </div>
  </section>
 <?php
 include("footer.php")
 ?>  
 <?php include("datatables.php"); ?>
 <script type="application/javascript">
function printtext(divName)
{
	    var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
 </script>