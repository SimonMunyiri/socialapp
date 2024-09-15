<?php include "connection.php"; 

//code to open user profile
if(isset($_POST['']))
{

}
//code to open messaging page



?>
<!DOCTYPE html>
<html>
<head>

	<style type="text/css">
		#more_menu_container{
			width:200px;
			left:40%;
			background:yellow;
			position:fixed;
			position:absolute;
			top:40%;
			padding-left:10px;
			border-radius:10px;

		}
	</style>
	
</head>
<body>
   <div id="more_menu_container">
   	<form enctype="multipart/form_data" method="post" action="more_menu.php">
   		<table height="100">
   			<tr>
   				<td>
   					<button id="" style="border:none;background: transparent;" type="submit" name="view_profile">
   						<span class="fa fa-user"></span>
   					   View profile
   				    </button>
   				</td>
   			</tr>

   			<tr>
   				<td>
   					<button id="" style="border:none;background: transparent;" type="submit" name="view_profile">
   					<span class='fa fa-envelope'></span>        Message User
   					</button>
   				</td>
   			</tr>

   			<tr>
   				<td>
   					<button id="" style="border:none;background: transparent;" type="submit" name="view_profile">
   						<span class="fa fa-download"></span>
   					    Download Photo
   				    </button>
   				</td>
   			</tr>

   			
   		</table>
   		
   	</form>
   </div>
</body>
</html>