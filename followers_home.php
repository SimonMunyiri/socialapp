<?php
#followers page
#allow a user to follow any student in the list
#allow user to unfollow any student
include 'header.php';
?>



<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		.followers_nav_buttons{
			border:none;
			color:white;
			padding:5px;
			background:blue;
			width:48%;
		}
	</style>
</head>
<body>
	<div id="body_center">
		<div id="followers_header">
			<button type="button" class="followers_nav_buttons" id="followers">
				Followers
			</button>

			<button type="button" class="followers_nav_buttons" id="following">
				Following
			</button>
		</div>

		<div id="followers_container">
			<div id="followers_display">
			</div>
			<div id="following_display">
			</div>
		</div>		
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#followers").click(function(){
              $("#followers_display").load("followers.php");
			});
		});
	</script>
</body>
</html>
