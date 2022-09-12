  <footer id="footer">
    <div class="footer_top">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="footer_widget wow fadeInDown">
            <ul class="tag_nav">
              <li><h2><a href="index.php">Home</a></h2></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="footer_widget wow fadeInDown">
            <h2>Tag</h2>
            <ul class="tag_nav">
              <li><a href="about.php">About</a></li>
              <li><a href="contact.php">Contact</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="footer_widget wow fadeInRightBig">
            <h2>Contact</h2>
            <address>
          Barak Valley Engineering College<br /> 
           Nirala, Karimganj-788701<br />
           Assam,INDIA.<br />
           7002119930<br />
           aruneshdhar72@gmail.com.com<br />
            </address>
          </div>
        </div>
      </div>
    </div>
    <div class="footer_bottom">
      <p class="copyright"><strong>Copyright &copy; 2021</strong> </p>
     
      <p class="developer"><font color=#FFFFFF> <a href="userlogin.php" style="color:#FFF">User Login Panel</a> &nbsp;&nbsp;| &nbsp; Developed By Arunesh,Swaib,Kushaldeep</font></p>
    </div>
  </footer>
</div>
<?php
if(isset($_SESSION[student_id]))
{
	include("chatbox.php");
}
?>
<script src="assets/js/jquery.min.js"></script> 
<script src="assets/js/wow.min.js"></script> 
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/jquery.li-scroller.1.0.js"></script> 
<script src="assets/js/jquery.newsTicker.min.js"></script> 
<script src="assets/js/jquery.fancybox.pack.js"></script> 
<script src="assets/js/custom.js"></script>
</body>
</html>