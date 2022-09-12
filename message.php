<?php
include("header.php");
$_SESSION[randomid] = rand();
?>

<!-- contact section -->
<section id="contact" class="parallax-section" style="background-color:#CCF">
	<div class="container">
		<div class="row">

			<div class="col-md-offset-1 col-md-11 col-sm-11 wow fadeIn" data-wow-delay="0.9s">
            
<div id="chatsidebar" style="min-height:500px; max-height:500px; overflow-y: scroll;">
	<?php
	include("jsadminchatlist.php");
	?>
</div>
<div id="chatcontent" style="min-height:500px; max-height:500px; "> 
	<?php
	include("jsadminchat.php");
	?>
</div>

			</div>
			<div class="col-md-2 col-sm-1"></div>
		</div>
	</div>
</section>


<?php
include("footer.php");
?>
<style type="text/css">
#chatsidebar {float: left; width: 250px; background: #eee; padding:5px;}
#chatcontent {overflow: hidden; background: #F8EEF8; padding:5px;}
</style>