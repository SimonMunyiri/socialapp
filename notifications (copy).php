
<?php

include 'header.php';

?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		#actual_notifications{
			
			border:1px solid lightblue;
		}
		#search{
			width:90%;
            height:30px;
            border-radius:4px;
            border:1px solid #000;
		}
		#display_notifications{
			padding:0 10px 0 10px;
		}
	</style>
</head>
<body>
	<div id="body_center">
		
	     </center>
		<div id="actual_notifications">
			<p style="background: lightblue;padding: 8px;">Notifications</p>
			<div id="display_notifications"></div>
		</div>
	</div>
	<script type="text/javascript">
	$(document).ready(function(){

         setInterval(function(){
            $('#display_notifications').load('load_notifications.php');
          },500);

	});
</script>
</body>
</html>