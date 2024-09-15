
<?php include "connection.php"; 

?>
<title>Comrades</title>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewpoint" content="width=device-width,initial-scale=1">
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

#header_content{
widows:100%;
background:green;
height:50px;
padding:10px 0 0 20px;
font-size:18px;
}
	#header_content ul li{
	background:green;
     list-style: none;
     float:left;     
     text-decoration:none;
     cursor:pointer;
     color: white;
     margin-left:30px;
     
	}
	#header_content ul li a{
		text-decoration: none;
		color:white;
		background:transparent;
	}
	#body_center{
		width:500px;
		background:white;
		margin:auto;
		
		padding:1px 20px;
	}
	#profilePicture{
		border:1px solid gray;
		border-radius:50%;
	}
	#profileName{
		color:blue;
	}
	#profile{
		background:transparent;
		width:400px;
		padding:10px;
		text-transform: capitalize;
	}
	#headings{
		background:lightblue;
		padding:10px;
	}
	#small{
		color:gray;
		font-size:12px;
		background:white
	}
	#heading_title{
		color:blue;
		background:violet;
		font-size:30px;
		font-weight: bold;
		padding:10px;
	}

</style>
<body>
<div id="header_content">
	<ul>


	     <li>
	     	<a href="home.php">
	     		<span class="fa fa-home"></span> 
	     		News
	     	</a>
	     </li>


	     <li>
	     	<a href="search.php">
	     		<span class="fa fa-search"></span> 
	     		Search
	     	</a>
	     </li>


	     <li>
	     	<a href="myprofile.php">
	     		<span class="fa fa-user"></span> 
	     		Profile
	     	</a>
	     </li>



	     <li>
	     	<a href="students.php">
	     		<span class="fa fa-users"></span> 
	     		Students
	     	</a>
	     </li>



	
	     <li>
	     	<a href="message.php">
	     		<span class="fa fa-envelope"></span> 
	     		Chat
	     	</a>
	     </li>



	     <li>
		     <a href="notifications.php">
			     <span class="fa fa-bell"></span>
			     Notifications
			    
	         </a>
        </li>



	<li>
		<a href="menu.php">
			<span class="fa fa-navicon"></span> 
			Menu
		</a>
	</li>




	
	</ul>	
</div>
</body>