<?php
include("dbconnection.php");
?>
Subject:<font color='red' size='4'><strong>*</strong></font>
<select name="subject" class="form-control">
    <option value="">Select Subject</option>
    <?php
    $sqlsubject =  "SELECT * FROM subject WHERE status='Active' AND course_id='$_GET[courseid]' AND semester='$_GET[semester]'";
    $qsqlsubject = mysqli_query($con,$sqlsubject);
    while($rssubject = mysqli_fetch_array($qsqlsubject))
    {
        if($rssubject['subject_id'] == $rsedit['subject_id'])
        {
        echo "<option value='$rssubject[subject_id]' selected>$rssubject[subject]</option>";
        }
        else
        {					
        echo "<option value='$rssubject[subject_id]'>$rssubject[subject]</option>";
        }
    }
    ?>
</select>