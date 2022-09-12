<?php
include("header.php");
?>
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="single_page">
            <ol class="breadcrumb">
              <li><a href="index.php">Home</a></li>
              <li><a href="#"><?php echo $_GET[noticetype]; ?></a></li>
            </ol>
	<?php   
    if(isset($_GET[noticeid]))
    {
        $sqlnotice = "SELECT * FROM notice WHERE notice_id=$_GET[noticeid]";
        $qsqlnotice = mysqli_query($con,$sqlnotice);
        $rsnotice = mysqli_fetch_array($qsqlnotice);

        $sqlnoticeuser = "SELECT * FROM user WHERE user_id=$rsnotice[user_id]";
        $qsqlnoticeuser = mysqli_query($con,$sqlnoticeuser);
        $rsnoticeuser = mysqli_fetch_array($qsqlnoticeuser);
    }
    ?>
            <h1><?php echo "$rsnotice[title]";?></h1>
            <div class="post_commentbox"> <a href="#"><i class="fa fa-user"></i><?php echo $rsnoticeuser[name]; ?></a> <span><i class="fa fa-calendar"></i><?php echo"$rsnotice[date_time]";?></span> <a href="#"><i class="fa fa-tags"></i></a><?php echo "$rsnotice[notice_type]";?></div>
            <div class="single_page_content"> <img class="img-center" src="<?php 
			if(file_exists("noticeimages/" .$rsnotice[uploads]))
				  {
				  		echo "noticeimages/" . $rsnotice[uploads];
				  }
				  else
				  {
					  echo "images/no-image.png";
				  }			
			?>">
              <p><?php echo "$rsnotice[description]";?></p>
             
             

            </div>
            <div class="social_link">
              <ul class="sociallink_nav">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
              </ul>
            </div>
            <div class="related_post">
              <h2>Related Post <i class="fa fa-thumbs-o-up"></i></h2>
              <ul class="spost_nav wow fadeInDown animated">
              <?php
              $sql ="SELECT * FROM notice WHERE notice_type=$_GET[noticetype]";
              $qsql = mysqli_query($con, $sql);
              while($rsrec = mysqli_fetch_array($qsql))
              {
				?>
                <li>
                  <div class="media"> <a class="media-left" href="single_page.php?noticeid=<?php echo $rsrec[notice_id]; ?>&noticetype=<?php echo $_GET[noticetype]; ?>"> <img src="<?php 
			if(file_exists("noticeimages/" .$rsnotice[uploads]))
				  {
				  		echo "noticeimages/" . $rsrec[uploads];
				  }
				  else
				  {
					  echo "images/no-image.png";
				  }			
			?>" alt=""> </a>
                    <div class="media-body"> <a class="catg_title" href="single_page.php?noticeid=<?php echo $rsrec[notice_id]; ?>&noticetype=<?php echo $_GET[noticetype]; ?>"><?php echo $rsrec[title]; ?></a> </div>
                  </div>
                </li>
              <?php
			  }
			  ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
<?php
//Codings of News
$sqlmaxnews ="SELECT notice_id FROM notice WHERE status=Active ORDER BY rand() limit 1 ";
$qsqlmaxnews = mysqli_query($con, $sqlmaxnews);
$rsrecmaxnews = mysqli_fetch_array($qsqlmaxnews);

$sqlnoticenews ="SELECT * FROM notice WHERE notice_id=$rsrecmaxnews[0]";
$qsqlnoticenews = mysqli_query($con, $sqlnoticenews);
$rsrecnoticenews = mysqli_fetch_array($qsqlnoticenews);
//Codings of News ends here

//Codings of Events
$sqlmaxevents ="SELECT notice_id FROM notice WHERE status=Active ORDER BY rand() limit 1";
$qsqlmaxevents = mysqli_query($con, $sqlmaxevents);
$rsrecmaxevents = mysqli_fetch_array($qsqlmaxevents);

$sqlnoticeevents ="SELECT * FROM notice WHERE notice_id=$rsrecmaxevents[0]";
$qsqlnoticeevents = mysqli_query($con, $sqlnoticeevents);
$rsrecnoticeevents = mysqli_fetch_array($qsqlnoticeevents);
//Codings of Events ends here

?>
      <nav class="nav-slit"> <a class="prev" href="#"> <span class="icon-wrap"><i class="fa fa-angle-left"></i></span>
        <div>
          <h3><?php
          echo $rsrecnoticenews[title];
		  ?></h3>
          <img src="<?php 
			if(file_exists("noticeimages/" . $rsrecnoticenews[uploads]))
				  {
				  		echo "noticeimages/" . $rsrecnoticenews[uploads];
				  }
				  else
				  {
					  echo "images/no-image.png";
				  }			
			?>" alt=""/> </div>
        </a> <a class="next" href="#"> <span class="icon-wrap"><i class="fa fa-angle-right"></i></span>
        <div>
          <h3><?php
          echo $rsrecnoticeevents[title];
		  ?></h3>
          <img src="<?php 
			if(file_exists("noticeimages/" . $rsrecnoticeevents[uploads]))
				  {
				  		echo "noticeimages/" . $rsrecnoticeevents[uploads];
				  }
				  else
				  {
					  echo "images/no-image.png";
				  }			
			?>" alt=""/> </div>
        </a> </nav>

      <?php include("rightsidebar.php"); ?>
    </div>
  </section>
<?php
include("footer.php");
?>