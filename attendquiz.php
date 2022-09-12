<?php
include("header.php");
if(isset($_GET[quizstid]))
{
	$_SESSION[quizid] = $_GET[quizstid];
	echo "<script>window.location=attendquiz.php?quizid=" . $_SESSION[quizid] . ";</script>";		
}

if(!isset($_SESSION[quizid]))
{
	echo "<script>window.location=quizresult.php?quizid=" . $_SESSION[quizid1] . ";</script>";	
}


$_SESSION[sessionid] = rand();
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM question WHERE quiz_question_id=$_GET[editid]";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
if(isset($_GET[submit]))
{
	$_SESSION[quizid] = $_GET[quizid];
	echo "<script>window.location=quizresult.php?quizid=" . $_SESSION[quizid] . ";</script>";
}
?>

  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2>Quiz</h2>
            <p>Answer the quiz.</p>
<?php
  	$sql ="SELECT * FROM question WHERE quiz_id=$_GET[quizid]";
  	$qsql = mysqli_query($con, $sql);
	while($rsrec = mysqli_fetch_array($qsql))
	{
		$qid[] = $rsrec[quiz_question_id];
		$q[] = $rsrec[question];
		$o1[]=$rsrec[option1];
		$o2[]=$rsrec[option2];
		$o3[]=$rsrec[option3];
		$o4[]=$rsrec[option4];
	}
	$count=0;
?> 
<div id="">  
  <table border="1" class="table table-striped table-bordered" cellspacing="0" style="width:100%">
  	<input type="hidden" name="qid" id="qid" value="<?php echo $qid[$count]; ?>" />
  <tr>
    <th height="29" colspan="2" style="color:#039" scope="col">&nbsp;<span id="idq"><?php echo $q[$count]; ?></span></th>
    </tr>
  <tr>
    <th colspan="2" scope="col"> 1.&nbsp;
      <input name="option" id="option1"  type="radio" value="Option 1" onclick="submitanswer(qid.value,this.value)">&nbsp;<span id="ido1"><?php echo $o1[$count]; ?></span></th>
    </tr>  
  <tr>
    <th colspan="2" scope="col">2.&nbsp;
      <input name="option" id="option2"   type="radio" value="Option 2" onclick="submitanswer(qid.value,this.value)">&nbsp;<span id="ido2"><?php echo $o2[$count]; ?></span></th>
  </tr>
  <tr>
    <th colspan="2" scope="col">3.&nbsp;
      <input name="option" id="option3"   type="radio" value="Option 3" onclick="submitanswer(qid.value,this.value)">&nbsp;<span id="ido3"><?php echo $o3[$count]; ?></span></th>
  </tr>
  <tr>
    <th colspan="2" scope="col">4.&nbsp;
      <input name="option" id="option4"   type="radio" value="Option 4" onclick="submitanswer(qid.value,this.value)">&nbsp;<span id="ido4"><?php echo $o4[$count]; ?></span></th>
    </tr>
 </table>              
</div>
<?php
for($i=0;$i< mysqli_num_rows($qsql);$i++)
{
?>
 <input name="submit" type="submit" value="<?php echo $i+1; ?>" onclick="selectquestion(<?php echo $qid[$i]; ?>,<?php echo $q[$i]; ?>,<?php echo $o1[$i]; ?>,<?php echo $o2[$i]; ?>,<?php echo $o3[$i]; ?>,<?php echo $o4[$i]; ?>)">
<?php
}
?>
 <hr />
<form method="get" action="">
 	<input type="hidden" name="quizid" value="<?php echo $_GET[quizid]; ?>"  />
  	<input name="submit" type="submit" value="Finish">
</form>
          </div>
        </div>
      </div>
     <?php include("rightsidebar.php"); ?>
    </div>
  </section>
<?php
include("footer.php");
include("datatables.php");
?>
<script type="application/javascript">
 function selectquestion(qid,q,o1,o2,o3,o4)
 {
	
	 document.getElementById("qid").value = qid;
	 document.getElementById("idq").innerHTML = q;
	 document.getElementById("ido1").innerHTML = o1;
	 document.getElementById("ido2").innerHTML = o2;
	 document.getElementById("ido3").innerHTML = o3;
	 document.getElementById("ido4").innerHTML = o4;	     
	 
		if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) 
			{
            //  alert(this.responseText);
			  	if(this.responseText == "")
				{
					document.getElementById("option1").checked = false;
					document.getElementById("option2").checked = false;
					document.getElementById("option3").checked = false;
					document.getElementById("option4").checked = false;
				}
				else
				{
				  if(this.responseText=="Option 1")
				  {
					  document.getElementById("option1").checked = true;
				  }
				  if(this.responseText=="Option 2")
				  {
					  document.getElementById("option2").checked = true;
				  }
				  if(this.responseText=="Option 3")
				  {
					  document.getElementById("option3").checked = true;
				  }
				  if(this.responseText=="Option 4")
				  {
					  document.getElementById("option4").checked = true;
				  }
				}
            }
        };
        xmlhttp.open("GET","ajaxanswer.php?selectedqid="+qid,true);
        xmlhttp.send();	
 }
function submitanswer(qid,selectedanswer)
{
		if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //alert(this.responseText);
            }
        };
        xmlhttp.open("GET","ajaxanswer.php?qid="+qid+"&selectedanswer="+selectedanswer+"&quizid=<?php echo $_GET[quizid]; ?>",true);
        xmlhttp.send();	
}
 </script>