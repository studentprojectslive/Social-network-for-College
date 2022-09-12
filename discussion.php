<?php
include("header.php");
if($_SESSION[sessionid] == $_POST[sessionid])
{
	if(isset($_POST[submit]))
	{
		$discussion_title= mysqli_real_escape_string($con, $_POST[title]);
		$discussion_description = mysqli_real_escape_string($con, $_POST[description]);
	    
		$sql="INSERT INTO discussion(course_id,semester,subject_id,discussion_title,discussion_description,date_time,student_id,status) values ($rsstudent[course_id],$rsstudent[semester],$_POST[subject],$discussion_title,$discussion_description,$dt $tim,$_SESSION[student_id],Active)";
		$qsql = mysqli_query($con,$sql);
		if(!$qsql)
		{
			echo mysqli_error($con);
		}
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert(Discussion record inserted successfully..);</SCRIPT>";
			echo "<script>window.location=discussiondisplay.php;</script>";
		}
	    
	}
}
$_SESSION[sessionid] = rand();
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM discussion WHERE discussion_id=$_GET[editid]";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>

  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2>Discussion</h2>
            <p>Add discussion details.</p>
            <form action="" class="contact_form" method="post" name="frmdiscussion" onsubmit="return validateform()">
            <input  type="hidden" name="sessionid" value="<?php echo $_SESSION[sessionid]; ?>" >

              <span id="spansubjectid">
              Subject:<font color=red size=4><strong>*</strong></font>
              <select name="subject" class="form-control">
              	<option value="">Select Subject</option>
              <?php
				$sqlsubject =  "SELECT * FROM subject WHERE status=Active AND  course_id=$rsstudent[course_id] AND semester=$rsstudent[semester] ";
				$qsqlsubject = mysqli_query($con,$sqlsubject);
				while($rssubject = mysqli_fetch_array($qsqlsubject))
				{
					if($rssubject[subject_id] == $rsedit[subject_id])
					{
					echo "<option value=$rssubject[subject_id] selected>$rssubject[subject]</option>";
					}
					else
					{					
					echo "<option value=$rssubject[subject_id]>$rssubject[subject]</option>";
					}
				}
				?>
              </select>
               </span>
               <span id="idsubject"></span>
               <br />
              Title:<font color=red size=4><strong>*</strong></font>
              <input name="title" class="form-control" type="text" placeholder=" Title *" value="<?php echo $rsedit[discussion_title]; ?>">
               <span id="idtitle"></span>
               <br />
              Description:<font color=red size=4><strong>*</strong></font>
              
			  <script src="richtexteditor/tinymce.min.js"></script>
              <script>tinymce.init({ selector:textarea });</script>
            <textarea name="description" id="descriptions" class="form-control"  rows="6" placeholder=" Description *"><?php echo $rsedit[discussion_description]; ?></textarea><span id="iddescription"></span>
               <br />
              <input name="submit" type="submit" value="submit">
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
 <script>
function loadsubject(courseid) {
    if (courseid == "")
	{
        document.getElementById("spansubjectid").innerHTML = "";
        return;
    } 
	else
	{ 
        if (window.XMLHttpRequest)
		{
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } 
		else
		{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
				
        xmlhttp.open("GET","ajaxloadsubject.php?courseid="+courseid,true);
        xmlhttp.send();
				
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("spansubjectid").innerHTML = this.responseText;
            }
        };
    }
}
</script>
<script type="application/javascript">
 function validateform()
 {
	 var validatecondtion = 0;
	
	 document.getElementById("idsubject").innerHTML ="";                     
	 document.getElementById("idtitle").innerHTML ="";
	 document.getElementById("iddescription").innerHTML ="";

	 if(document.frmdiscussion.subject.value=="")
	 {
		 document.getElementById("idsubject").innerHTML ="<font color=red>Select the subject...</font>";
		 validatecondtion=1;
	 }
	  if(document.frmdiscussion.title.value=="")
	 {
		 document.getElementById("idtitle").innerHTML ="<font color=red>Title must be entered</font>";
		 validatecondtion=1;
	 }
	  if(tinyMCE.get(descriptions).getContent() =="")
	 {
		 document.getElementById("iddescription").innerHTML ="<font color=red>Description should not be empty...</font>";
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