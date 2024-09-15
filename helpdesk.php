<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

<!DOCTYPE html>
<html>
<head>

	<style type="text/css">
		body{
		background:#eee;
	}
	*{
		margin:0 0 5px 0;
		padding:0;
		font-family:calibri;
		font-size:15px;
		
	}
		#body_center{
		width:500px;
		background:white;
		margin:auto;
		
		padding:1px 20px;
	}
		#body_center ul li{
			color:blue;
			line-height:30px;
			cursor:pointer;
			border-bottom: .5px solid gray;
			list-style: none;
		}
		#body_center ul li p{
			color:black !important;
		}
		#body_center ul li p .fa{
			font-size: 20px;
		}
		#body_center ul li p .fa-facebook{
			color:blue;
		}
		#body_center ul li p .fa-instagram{
			color:red;
		}
		#body_center ul li p .fa-envelope{
			color:green;
		}


		#feedback{
			background:green;
			color:white;
			border:none;
			height:30px;
			width:30%;
			border-radius: 8px;

		}
		#feedback:hover{
			background:yellow;
			color:blue;
		}

	</style>

</head>
<body>
<br>
	<div id="body_center">
		<h2>Comrades Helpdesk.</h2>
		<hr>

		<ul>
			<li>
				<span id="account_link">How do I create a new account?</span>
				<p id="account_details">
				   To create a new account,you click/tap the link(Create a new account?) below the log in form
				   on the <a href="index.php">log in page</a>.You can also click/tap <a href="register.php">here</a> to create a new account.
				</p>
			</li>

			<li>
				<span id="access_profile_link" >How to access your profile.</span>
				<p id="profile_info">
				   You access your profile by clicking on a menu(Profile) on the page header.You can also click on your profile photo in the homepage or click the menu button(<span class="fa fa-navicon"></span>) and then select the submenu(<i>View your profile</i>).
				</p>
			</li>

			<li>
				<span id="edit_profile_link">How to edit your profile(Photo,bio and academic info)?</span>
				<p id="edit_profile_detail">
					Open your profile page to edit bio data,profile photo and Academic info.
			    </p>
			</li>

			<li>
				<span id="developers_link">Who created the Comrades Social platform?</span>
				<p id="developer_account">
					The Comrades social platform was build by a DeKUT student taking  Electrical and Electronics Engineering.
					<br>
					<span class="fa fa-instagram"></span> Follow the developer on Instagram,<br>
					<span class="fa fa-facebook"></span> View developer's profile on facebook,<br>
					<span class="fa fa-envelope"></span> Email developer.<br>
					<a href="https://t.me/codebreakerKenya">Message Developer on Telegram</a><br>
					<a href="https://wa.me/254790267919">Message Developer on WhatsApp</a>

				</p>
			</li>




		</ul>
        <br>
        <center>
		<a href="mailto:munyirisimon6@gmail.com">
			
			<button type="button" id="feedback">
				SEND FEEDBACK
			</button>
	    </a>
	    <a href="index.php">
			<button type="button" id="feedback">
				LOG IN
			</button>
		</a>
		<a href="register.php">
			<button type="button" id="feedback">
				REGISTER
			</button>
		</a>
		</center>
		
	</div>


	<script type="text/javascript">
		$(document).ready(function(){
			$("#account_details").hide();
			$("#profile_info").hide();
			$("#edit_profile_detail").hide();
			$("#developer_account").hide();


			$("#account_link").click(function(){
				$("#account_details").slideToggle(500);
				$("#profile_info").hide();
			    $("#edit_profile_detail").hide();
			    $("#developer_account").hide();
			});

			$("#access_profile_link").click(function(){
				$("#profile_info").slideToggle(400);
				$("#edit_profile_detail").slideUp(400);
			    $("#developer_account").slideUp(400);
			    $("#account_details").slideUp(400);
			});

			$("#edit_profile_link").click(function(){
				$("#edit_profile_detail").slideToggle(400);
				$("#account_details").slideUp(400);
			    $("#profile_info").slideUp(400);
			    $("#developer_account").slideUp(400);
			});

			$("#developers_link").click(function(){
				$("#developer_account").slideToggle(400);
				$("#account_details").slideUp(400);
			    $("#profile_info").slideUp(400);
			    $("#edit_profile_detail").slideUp(400);
			});

		});
	</script>

</body>
</html>