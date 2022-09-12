<?php
include("header.php");
if($_SESSION[sessionid] == $_POST[sessionid])
{
	if($_FILES["image"]["name"] != "")
	{
		$imgname = rand(). $_FILES["image"]["name"];
		move_uploaded_file($_FILES["image"]["tmp_name"],"timelineimages/".$imgname);
	}
	if(isset($_POST[submit]))
	{
		if(isset($_GET[editid]))
		{
	$sql="UPDATE timeline set student_id=$_SESSION[student_id],post_type=$_POST[posttype],text_message=$_POST[message],";
	if($_FILES["image"]["name"] != "")
			{
			$sql = $sql . "image_path=$imgname,";
			}
			$sql = $sql . 
	"video_path=$_POST[video],date_time=$dt $tim WHERE timeline_id=$_GET[editid]";
		$qsql = mysqli_query($con,$sql);
		if(!$qsql)
		{
			echo mysqli_error($con);
		}
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert(Timeline record UPDATED successfully..);</SCRIPT>";
		}	
	    }
		else
		{
		$sql="INSERT INTO timeline(student_id,post_type,text_message,image_path,video_path,date_time) values ($_SESSION[student_id],$_POST[posttype],$_POST[message],$imgname,$_POST[video],$dt $tim)";
		$qsql = mysqli_query($con,$sql);
		if(!$qsql)
		{
			echo mysqli_error($con);
		}
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<SCRIPT>alert(Timeline record inserted successfully..);</SCRIPT>";
		}
		}
	}
}
$_SESSION[sessionid] = rand();
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM timeline WHERE timeline_id=$_GET[editid]";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>

  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2>Timeline</h2>
            <p>Add your views.</p>
            <form action="" class="contact_form" method="post" enctype="multipart/form-data">
            <input  type="hidden" name="sessionid" value="<?php echo $_SESSION[sessionid]; ?>" >
              Post Type:
              <select name="posttype" class="form-control">
              <option value="">Select Post type</option>
              <?php
			  $arr  = array("Text","Image","Video");
			  foreach($arr as $val)
			  {
				  echo "<option value=$val>$val</option>";
			  }
			  ?>
              </select>
              Message:
              <textarea name="message" class="form-control" cols="30" rows="10" placeholder="message *"><?php echo $rsedit[text_message]; ?></textarea>
              Image:
              <input type="file" name="image"  class="form-control" value="<?php echo $rsedit[image_path]; ?>" accept="image/*"  onchange="loadFile(event)">
               <?php
              if($rsedit[image_path] == "")
              {
              	echo <img src="images/no-image.png" height="200" alt="Image preview..." id="previewimg">;
              }
              else
              {
              	echo "<img src=timelineimages/$rsedit[image_path] height=200 alt=Image preview... id=previewimg>";
              }
              ?><br />
              Video:
              <input type="file" name="video"  class="form-control" value="<?php echo $rsedit[video_path]; ?>">
              <br />
              <input name="submit" type="submit" value="submit">
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <aside class="right_content">
          <div class="single_sidebar">
            <h2><span>Popular Post</span></h2>
            <ul class="spost_nav">
              <li>
                <div class="media wow fadeInDown"> <a href="pages/single_page.html" class="media-left"> <img alt="" src="images/post_img1.jpg"> </a>
                  <div class="media-body"> <a href="pages/single_page.html" class="catg_title"> Aliquam malesuada diam eget turpis varius 1</a> </div>
                </div>
              </li>
              <li>
                <div class="media wow fadeInDown"> <a href="pages/single_page.html" class="media-left"> <img alt="" src="images/post_img2.jpg"> </a>
                  <div class="media-body"> <a href="pages/single_page.html" class="catg_title"> Aliquam malesuada diam eget turpis varius 2</a> </div>
                </div>
              </li>
              <li>
                <div class="media wow fadeInDown"> <a href="pages/single_page.html" class="media-left"> <img alt="" src="images/post_img1.jpg"> </a>
                  <div class="media-body"> <a href="pages/single_page.html" class="catg_title"> Aliquam malesuada diam eget turpis varius 3</a> </div>
                </div>
              </li>
              <li>
                <div class="media wow fadeInDown"> <a href="pages/single_page.html" class="media-left"> <img alt="" src="images/post_img2.jpg"> </a>
                  <div class="media-body"> <a href="pages/single_page.html" class="catg_title"> Aliquam malesuada diam eget turpis varius 4</a> </div>
                </div>
              </li>
            </ul>
          </div>
        </aside>
      </div>
    </div>
  </section>
 <?php
 include("footer.php")
 ?>
 <script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById(previewimg);
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>