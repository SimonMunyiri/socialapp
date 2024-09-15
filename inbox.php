<?php
include 'header.php';
$StudentID=$_SESSION['StudentID'];
$studentProfile=mysqli_query($conn,"SELECT * FROM register WHERE id='$StudentID'");
$studentProfileRow=mysqli_fetch_assoc($studentProfile);
$fnameStudent=$studentProfileRow['FirstName'];
$lnameStudent=$studentProfileRow['LastName'];
$profilePictureStudent='photos/profile/'.$studentProfileRow['profile_pic'];
$defaultProfilePhotoStudent='photos/default_photos/one.jpeg';

if(isset($_POST['message'])){
	$msg=$_POST['message'];
	
	$saveMsg=mysqli_query($conn,"INSERT INTO messages(my_id,message,your_id)VALUES('$userId','$msg','$StudentID')");
	#also save this as a new conversation
	#first check whether the conversation exists in the database
	#remember that myId refers to "me" and yourId refers to a "second party"...
	$checkConversation=mysqli_query($conn,"SELECT * FROM conversations WHERE myId='$userId' AND yourId='$StudentID'OR myId='$StudentID' AND yourId='$userId'");
	$results=mysqli_num_rows($checkConversation);
	if($results<=0)
	{
		#save the new conversation
		$saveConversation=mysqli_query($conn,"INSERT INTO conversations(myId,yourId)VALUES('$userId','$StudentID')");
	}
	if($saveMsg){
		echo "Message sent";
	}
	else{
		echo 'not sent';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		#messaging_container{
			border:1px solid lightblue;
			
		}#messaging_body{
			height:65%;
			overflow-y:scroll;
		}
		#messaging_form{
			width:500px;
			margin: auto;
			background:white;
			padding:0 20px;

		}
	</style>
</head>
<body>
	<div id="body_center">
		<style type="text/css">
			#chat_header{
				display: grid;
				grid-template-columns:2fr .5fr;
				background:lightblue;
				padding-left:5px;
				font-weight:bold;
				grid-gap:10px 10px;
			}
			#profile,#menu{
				width:100%;
		
				padding:0;
			}
			#menu ul li{
				list-style: none;
				float: right;
				padding-right:20px;
				padding-top:15px;
			}
			
		</style>
		<div id="messaging_container">
			<div id="chat_header">
				<div id="profile">
					<table>
		            <tr>
			            <td>
				            <?php
				            if($studentProfileRow['profile_pic']=="")
				            {
					            ?>
				             <img src="<?php echo $defaultProfilePhotoStudent;?>" height="40" width="40" id="profilePicture">
				             <?php
				            }
				            else{
				            ?>
				            <img src="<?php echo $profilePictureStudent;?>" height="40" width="40" id="profilePicture">
				            <?php 
			            }
			            ?>
			            </td>
			            <td>
				            <b id="profileName"><?php echo $fnameStudent." ".$lnameStudent;?></b>
			            </td>
			            
		            </tr>
	               </table>
				</div>
				<div id="menu">
					<!-- <ul>
						<li><button type="button" id="menu_button" style="background: transparent;border:none;font-size:20px;"><span class="fa fa-ellipsis-v"></span></button></li>
					</ul> -->
					
				</div>

				
             </div>
			<div id="messaging_body" style="padding-right: 5px;">
				<center style="font-size:12px;color:red;">----------conversation with <?php echo $fnameStudent." ".$lnameStudent;?>--------</center>
				<div id="messages"></div>

			</div>
			

		</div>
		<br>
		
	</div>
	<div id="messaging_form">
		<form action="inbox.php">
			<input type="text" id="msg" style="width:90%;border:none;border-bottom:1px solid black;" placeholder="<?php echo $fname; ?>,type a message to <?php echo $fnameStudent; ?>">
			<button type="button" style="background:transparent;border:none;" id="send"><span class="fa fa-send" style="color:green;transform: rotate(45deg);font-size: 22px;"></span></button>
		    	
		</form>
		
	</div>
<script type="text/javascript">
		//insert message to database
  
  $(document).ready(function(){
    
    $("#send").click(function()
      {
        var msg=$('#msg').val();
        
                 
        $.ajax(
                      {
                        type   : "POST",
                        url    : 'inbox.php',
                        data   : {message:msg},
                        success:function(){

                        }
                       
                      }
          )
      });
    
    // load messages===================
    setInterval(function(){
      $('#messages').load('getmessages.php');
    },500);

  });
</script>
</body>
</html>