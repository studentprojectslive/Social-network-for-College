<?php
include("header.php");
//Codings of Meeting
$sqlmaxmeeting ="SELECT max(notice_id) FROM notice WHERE notice_type=Meeting ";
$qsqlmaxmeeting = mysqli_query($con, $sqlmaxmeeting);
$rsrecmaxmeeting = mysqli_fetch_array($qsqlmaxmeeting);

$sqlnoticemeeting ="SELECT * FROM notice WHERE notice_id=$rsrecmaxmeeting[0]";
$qsqlnoticemeeting = mysqli_query($con, $sqlnoticemeeting);
$rsrecnoticemeeting = mysqli_fetch_array($qsqlnoticemeeting);
//Codings of Meeting ends here

//Codings of News
$sqlmaxnews ="SELECT max(notice_id) FROM notice WHERE notice_type=News and Updates ";
$qsqlmaxnews = mysqli_query($con, $sqlmaxnews);
$rsrecmaxnews = mysqli_fetch_array($qsqlmaxnews);

$sqlnoticenews ="SELECT * FROM notice WHERE notice_id=$rsrecmaxnews[0]";
$qsqlnoticenews = mysqli_query($con, $sqlnoticenews);
$rsrecnoticenews = mysqli_fetch_array($qsqlnoticenews);
//Codings of News ends here

//Codings of Events
$sqlmaxevents ="SELECT max(notice_id) FROM notice WHERE notice_type=Events ";
$qsqlmaxevents = mysqli_query($con, $sqlmaxevents);
$rsrecmaxevents = mysqli_fetch_array($qsqlmaxevents);

$sqlnoticeevents ="SELECT * FROM notice WHERE notice_id=$rsrecmaxevents[0]";
$qsqlnoticeevents = mysqli_query($con, $sqlnoticeevents);
$rsrecnoticeevents = mysqli_fetch_array($qsqlnoticeevents);
//Codings of Events ends here
?>
  <section id="sliderSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="slick_slider">

          
          <div class="single_iteam"> <a href="single_page.php?noticeid=<?php echo $rsrecnoticenews[notice_id]; ?>&noticetype=News and Updates"><img src="<?php 
				  if(file_exists("noticeimages/" . $rsrecnoticenews[uploads]))
				  {
				  		echo "noticeimages/" . $rsrecnoticenews[uploads];
				  }
				  else
				  {
					  echo "images/no-image.png";
				  }
				  ?>"></a>
            <div class="slider_article">
               <h2><a class="slider_tittle" href="single_page.php?noticeid=<?php echo $rsrecnoticenews[notice_id]; ?>&noticetype=News and Updates"><?php echo $rsrecnoticenews[title]; ?></a></h2>
                   <p><?php echo substr($rsrecnoticenews[description], 0, 200); ?></p>
            </div>
          </div>
          
          
           <div class="single_iteam"> <a href="single_page.php?noticeid=<?php echo $rsrecnoticeevents[notice_id]; ?>&noticetype=Events"><img src="<?php 
				  if(file_exists("noticeimages/" . $rsrecnoticeevents[uploads]))
				  {
				  		echo "noticeimages/" . $rsrecnoticeevents[uploads];
				  }
				  else
				  {
					  echo "images/no-image.png";
				  }
				  ?>"></a>
                  
            <div class="slider_article">
                <h2><a class="slider_tittle" href="single_page.php?noticeid=<?php echo $rsrecnoticeevents[notice_id]; ?>&noticetype=Events"><?php echo $rsrecnoticeevents[title]; ?></a></h2>
                    <p><?php echo substr($rsrecnoticeevents[description], 0, 200); ?></p>
            </div>
          </div>
          
        
         <div class="single_iteam"> <a href="single_page.php?noticeid=<?php echo $rsrecnoticemeeting[notice_id]; ?>&noticetype=Meeting"><img src="<?php 
				  if(file_exists("noticeimages/" . $rsrecnoticemeeting[uploads]))
				  {
				  		echo "noticeimages/" . $rsrecnoticemeeting[uploads];
				  }
				  else
				  {
					  echo "images/no-image.png";
				  }
				  ?>"></a>
                  
            <div class="slider_article">
                <h2><a class="slider_tittle" href="single_page.php?noticeid=<?php echo $rsrecnoticemeeting[notice_id]; ?>&noticetype=Meeting"><?php echo $rsrecnoticemeeting[title]; ?></a></h2>
               <p><?php echo substr($rsrecnoticemeeting[description], 0, 200); ?></p>
            </div>
          </div>
        
         
        </div>
      </div>
     <?php include("rightsidebar.php"); ?>
    </div>
  </section>
  
  
 
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="single_post_content">
            <h2><span>Events</span></h2>
            <div class="single_post_content_left">
              <ul class="business_catgnav  wow fadeInDown">
                <li>
       <figure class="bsbig_fig"> <a href="single_page.php?noticeid=<?php echo $rsrecnoticeevents[notice_id]; ?>&noticetype=Events" class="featured_img"> 
                  <img src="<?php 
				  if(file_exists("noticeimages/" . $rsrecnoticeevents[uploads]))
				  {
				  		echo "noticeimages/" . $rsrecnoticeevents[uploads];
				  }
				  else
				  {
					  echo "images/no-image.png";
				  }
				  ?>"> </a>
                  
                  <span class="overlay"></span>
                    <figcaption> <a href="single_page.php?noticeid=<?php echo $rsrecnoticeevents[notice_id]; ?>&noticetype=Events"><?php echo $rsrecnoticeevents[title]; ?></a> </figcaption>
                  </figure>
                </li>
              </ul>
            </div>
            <div class="single_post_content_right">
              <ul class="spost_nav">
			 <?php
               $sql ="SELECT * FROM notice WHERE notice_type=Events";
              $qsql = mysqli_query($con, $sql);
              while($rsrec = mysqli_fetch_array($qsql))
              {
                   if(file_exists("noticeimages/" . $rsrec[uploads]))
                      {
                            $imgname =  "noticeimages/".$rsrec[uploads];
                      }
                      else
                      {
                          $imgname =   "images/no-image.png";
                      }
                 echo "<li>
                      <div class=media wow fadeInDown> <a href=single_page.php?noticeid=$rsrec[notice_id]&noticetype=Events class=media-left><img src=$imgname></a>          
                     <div class=media-body> <a href=single_page.php?noticeid= $rsrec[notice_id]&noticetype=Events class=catg_title>$rsrec[title]</a> </div>
                      </div>
                    </li>";
              }
                    ?>
              </ul>
            </div>
          </div>
          <div class="fashion_technology_area">
            <div class="fashion">
              <div class="single_post_content">
                <h2><span>News and Updates</span></h2>
                <ul class="business_catgnav wow fadeInDown">
                  <li>                                                  
                    <figure class="bsbig_fig"> <a href="single_page.php?noticeid=<?php echo $rsrecnoticenews[notice_id]; ?>&noticetype=News and Updates" class="featured_img"> <img alt="" src="<?php 
				  if(file_exists("noticeimages/" . $rsrecnoticenews[uploads]))
				  {
				  		echo "noticeimages/" . $rsrecnoticenews[uploads];
				  }
				  else
				  {
					  echo "images/no-image.png";
				  }
				  ?>" height="250"> <span class="overlay"></span> </a>
                      <figcaption> <a href="single_page.php?noticeid=<?php echo $rsrecnoticenews[notice_id]; ?>&noticetype=News and Updates"><?php echo $rsrecnoticenews[title]; ?></a></figcaption>
                    </figure>
                  </li>
                </ul>
                
                <ul class="spost_nav">
					  <?php
                   $sql ="SELECT * FROM notice WHERE notice_type=News and Updates";
                  $qsql = mysqli_query($con, $sql);
                  while($rsrec = mysqli_fetch_array($qsql))
                  {
                       if(file_exists("noticeimages/" . $rsrec[uploads]))
                          {
                                $imgname =  "noticeimages/".$rsrec[uploads];
                          }
                          else
                          {
                              $imgname =   "images/no-image.png";
                          }
                     echo "<li>
                      <div class=media wow fadeInDown> <a href=single_page.php?noticeid=$rsrec[notice_id]&noticetype=News and Updates class=media-left><img src=$imgname></a>          
                     <div class=media-body> <a href=single_page.php?noticeid=$rsrec[notice_id]&noticetype=News and Updates class=catg_title>$rsrec[title]</a> </div>
                        </div>
                      </li>";
                  }
                    ?>
                </ul>
              </div>
            </div>
            <div class="technology">
              <div class="single_post_content">
                <h2><span>Meeting</span></h2>
                <ul class="business_catgnav wow fadeInDown">
                  <li>                                                  
                    <figure class="bsbig_fig"> <a href="single_page.php?noticeid=<?php echo $rsrecnoticemeeting[notice_id]; ?>&noticetype=Meeting" class="featured_img"> <img src="<?php 
				  if(file_exists("noticeimages/" . $rsrecnoticemeeting[uploads]))
				  {
				  		echo "noticeimages/" . $rsrecnoticemeeting[uploads];
				  }
				  else
				  {
					  echo "images/no-image.png";
				  }
				  ?>" height="250"> <span class="overlay"></span> </a>
                      <figcaption> <a href="single_page.php?noticeid=<?php echo $rsrecnoticemeeting[notice_id]; ?>&noticetype=Meeting"><?php echo $rsrecnoticemeeting[title]; ?></a></figcaption>
                    </figure>
                  </li>
                </ul>
                
                <ul class="spost_nav">
					  <?php
                   $sql ="SELECT * FROM notice WHERE notice_type=Meeting";
                  $qsql = mysqli_query($con, $sql);
                  while($rsrec = mysqli_fetch_array($qsql))
                  {
                       if(file_exists("noticeimages/" . $rsrec[uploads]))
                          {
                                $imgname =  "noticeimages/".$rsrec[uploads];
                          }
                          else
                          {
                              $imgname =   "images/no-image.png";
                          }
                     echo "<li>
                        <div class=media wow fadeInDown> <a href=single_page.php?noticeid=$rsrec[notice_id]&noticetype=Meeting class=media-left> <img  src=$imgname> </a>
                          <div class=media-body> <a href=single_page.php?noticeid=$rsrec[notice_id]&noticetype=Meeting class=catg_title>$rsrec[title]</a> </div>
                        </div>
                      </li>";
                  }
                    ?>
              </ul>
            </div>
          </div>
        </div>

    </div>
  </section>
<?php
include("footer.php");
?>