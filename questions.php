<?php
include("header.php");
//if($_SESSION[sessionid] == $_POST[sessionid])
{
	if(isset($_POST[submit]))
	{
		$question= mysqli_real_escape_string($con, $_POST[question]);
		$option1= mysqli_real_escape_string($con, $_POST[option1]);
		$option2= mysqli_real_escape_string($con, $_POST[option2]);
		$option3= mysqli_real_escape_string($con, $_POST[option3]);
		$option4= mysqli_real_escape_string($con, $_POST[option4]);
		
		if(isset($_GET[editid]))
		{
			$sql="UPDATE question set quiz_id=$_POST[quizid],question=$question,option1=$option1,option2=$option2,option3=$option3,option4=$option4,correct_ans=$_POST[correctanswer],status=Active WHERE quiz_question_id=$_GET[editid]";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<SCRIPT>alert(Question record UPDATED successfully..);</SCRIPT>";
			}
		}	
		else
		{
			$sql="INSERT INTO question(quiz_id,question,option1,option2,option3,option4,correct_ans,status) values ($_POST[quizid],$question,$option1,$option2,$option3,$option4,$_POST[correctanswer],Active)";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<SCRIPT>alert(Question record inserted successfully..);</SCRIPT>";
				echo "<SCRIPT>window.locations=questions.php;</SCRIPT>";
			}
		}
	}
}
$_SESSION[sessionid] = rand();
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
            <h2>Quiz</h2>
            <p>Answer the quiz.</p>
            <form action="" class="contact_form" method="post" name="frmquestions" onsubmit="return validateform()">
            <input  type="hidden" name="sessionid" value="<?php echo $_SESSION[sessionid]; ?>" >
              Quiz:
              <select name="quizid" class="form-control">
              	<?php
				$sqlquiz =  "SELECT * FROM quiz WHERE quiz_id=" . $_GET[quizid] . "";
				$qsqlquiz = mysqli_query($con,$sqlquiz);
				echo mysqli_error($con);
				while($rsquiz = mysqli_fetch_array($qsqlquiz))
				{
					if($rsquiz[quiz_id] == $_GET[quizid])
					{
					echo "<option value=$rsquiz[quiz_id] selected>$rsquiz[title]</option>";
					}
				}
				?>
              </select>
              <span id="idquizid"></span>   
              <br />
              Question:<font color=red size=4><strong>*</strong></font>
              <textarea name="question" class="form-control" placeholder="question *"><?php echo $rsedit[question]; ?></textarea>
               <span id="idquestion"></span>
              <br />
              Option 1:<font color=red size=4><strong>*</strong></font>
              <input name="option1" class="form-control" type="text" placeholder="Option 1 *" value="<?php echo $rsedit[option1]; ?>">
               <span id="idoption1"></span>
              <br />
              Option 2:<font color=red size=4><strong>*</strong></font>
              <input name="option2" class="form-control" type="text" placeholder="Option 2 *"   value="<?php echo $rsedit[option2]; ?>">
               <span id="idoption2"></span>
              <br />
              Option 3:<font color=red size=4><strong>*</strong></font>
              <input name="option3" class="form-control" type="text" placeholder="Option 3 *" value="<?php echo $rsedit[option3]; ?>">
               <span id="idoption3"></span>
              <br />
              Option 4:<font color=red size=4><strong>*</strong></font>
              <input name="option4" class="form-control" type="text" placeholder="Option 4 *" value="<?php echo $rsedit[option4]; ?>">
               <span id="idoption4"></span>
              <br />
              Correct Answer:<font color=red size=4><strong>*</strong></font>
              <select name="correctanswer" class="form-control">
              <option value="">Select Correct Answer</option>
              <?php
			  $arr  = array("Option 1","Option 2","Option 3","Option 4");
			  foreach($arr as $val)
			  {
				  if($val == $rsedit[correct_ans])
				  {
				  echo "<option value=$val selected>$val</option>";
				  }
				  else
				  {
				  echo "<option value=$val>$val</option>";
				  }
			  }
			  ?>
              </select>
               <span id="idcorrectanswer"></span>
              <br />
              <input name="submit" type="submit" value="submit">
            </form>
          </div>
        </div>
      </div>
     
    </div>
  </section>
 <?php
 include("footer.php")
 ?>
  <script type="application/javascript">
 function validateform()
 {
	 var validatecondtion = 0;
	     
	 document.getElementById("idquizid").innerHTML ="";
	 document.getElementById("idquestion").innerHTML ="";
	 document.getElementById("idoption1").innerHTML ="";
	 document.getElementById("idoption2").innerHTML ="";
	 document.getElementById("idoption3").innerHTML ="";
	 document.getElementById("idoption4").innerHTML ="";
	 document.getElementById("idcorrectanswer").innerHTML ="";
	 
	  if(document.frmquestions.quizid.value=="")
	 {
		 document.getElementById("idquizid").innerHTML ="<font color=red>Kindly select quiz id..</font>";           
		 validatecondtion=1;
	 }
	 if(document.frmquestions.question.value=="")
	 {
		 document.getElementById("idquestion").innerHTML ="<font color=red>Kindly add question..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmquestions.option1.value=="")
	 {
		 document.getElementById("idoption1").innerHTML ="<font color=red>Option can not be empty..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmquestions.option2.value=="")
	 {
		 document.getElementById("idoption2").innerHTML ="<font color=red>Option can not be empty..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmquestions.option3.value=="")
	 {
		 document.getElementById("idoption3").innerHTML ="<font color=red>Option can not be empty..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmquestions.option4.value=="")
	 {
		 document.getElementById("idoption4").innerHTML ="<font color=red>Option can not be empty..</font>";
		 validatecondtion=1;
	 }
	 if(document.frmquestions.correctanswer.value=="")
	 {
		 document.getElementById("idcorrectanswer").innerHTML ="<font color=red>Select correct answer..</font>";
		 validatecondtion=1;
	 }
	 if(validatecondtion==1)
	 {
		 return false;
	 }
	 else
	 {
		 return true;
	 }
 }
 </script>