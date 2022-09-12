<?php
session_start();
session_destroy();
?>
<script>

		localStorage.removeItem(visiblechat1);
		delete window.localStorage["visiblechat1"];

		localStorage.removeItem(visiblechat2);
		delete window.localStorage["visiblechat2"];

		localStorage.removeItem(visiblechat3);
		delete window.localStorage["visiblechat3"];

</script>
<?php
echo "<script>window.location=index.php;</script>";
?>