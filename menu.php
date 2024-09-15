<?php include "header.php"?>
<style type="text/css">
	#body_center{
		width:500px;
		background:white;
		margin:auto;
		
		padding:20px;
	}


	#body_center ul li{
		line-height:35px;
		list-style:none;
		border-bottom:.5px solid gray;
		cursor:pointer;
		font-size:30px;
	}


	#body_center ul li{
		text-decoration:none;
		color:#000;
		padding-left:10px;
		transition:.4s;
	}


	#body_center ul li:hover{
		background: lightgray;
	}


	#body_center ul li a{
		color:blue;
		text-decoration: none;
	}

	
	#menu_icon{
		color:orange;
	}
</style>
<div id="body_center">
	
<ul>


	<li title="View your profile,edit profile,view hostel and book hostel.Account username:<?php echo $fname.' '.$lname;?>">
		<a href="myprofile.php">
			<span class="fa fa-user" id="menu_icon"></span> 
			View your profile
		</a>
	</li>



	<li title="View what other students are going through everyday">
		<a href="home.php">
			<span class="fa fa-home"  id="menu_icon"></span> 
		   News
	    </a>
	</li>

	
	<li title="Search students and other users.">
		<a href="search.php">
			<span class="fa fa-search" id="menu_icon"></span> 
		    Search
		</a>
	</li>


	
	<li title="Start a private chat with other students.">
		<a href="message.php">
			<span class="fa fa-envelope" id="menu_icon"></span> 
			Chat
		</a>
	</li>

	<!-- <li title="Follow,unfollow,view your followers and their profiles.">
		<a href="followers_home.php">
			<span class="" id="menu_icon"></span> 
			Followers
		</a>
	</li> -->



	<li title="All students">
		<a href="students.php" >
			<span class="fa fa-users" id="menu_icon"></span> 
			Students
		</a>
	</li>


	<li title="View your notifications(Posts,chats,likes,comments,e.t.c)">
		<a href="notifications.php">
			<span class="fa fa-bell" id="menu_icon"></span> 
			Notifications
		</a>
	</li>


	<li title="Book hostel,view rooms available,change hostel">
		<a href="accomodation.php">
			<span style="color:red;">Accomodition</span>-book hostel online.
		</a>
	</li>


	<li title="help?">
		<a href="helpdesk.php">
			<span class="fa fa-question" id="menu_icon"></span> 
			Help
		</a>
	</li>

	<li  title="About us">
		<a href="aboutus.php">
			<span class="fa fa-info" id="menu_icon"></span>
			About Us
		</a>
	</li>


	<li title="Change phone number,delete account,edit personal info.">
		<a href="settings.php"><span class="fa fa-cog" id="menu_icon"></span> 
			Settings
		</a>
	</li>
	
	
	<?php;
    if(isset($_POST['logout']))
        {
        	
        	//session_destroy();
        	header("location:index.php");


        }
 ?>


	<li title="Log out from this account(<?php echo $fname.' '.$lname;?>)">
		<form method="POST" enctype="multipart/form-data" action="menu.php">

			<button type="submit" name="logout" style="background: transparent;border:none;color:blue">

				Log Out
			</button>
		</form>
	
    </li>

    
</ul> 
</div>