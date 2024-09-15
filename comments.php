<?php
include 'connection.php';
$defaultProfilePhotoStudent='photos/default_photos/one.jpeg';
if(isset($_POST['post_id']))
{
	$postId=$_POST['post_id'];
	

?>

<style type="text/css">
		#comment_container{
	     margin-top:-5%;
        background: white;
        width:500px;       
		position:fixed;
		height: 100%;
		padding-bottom:10px;
	
	}
	
	
	
	#back{
		padding:6px;
		font-weight:bold;
		border:none;
		background: purple;
		color:white;
		border-radius: 5px;
	}
	#comment_form{
		margin-left:10px;
	}
	#comment_form input{
		width:400px;
		height:30px;
	}
	#comment_text{
		padding-left:10px;
	}
	#comment_form button{
       height:30px;
       background:blue;
       border:none;
       color:white;
       padding:0 5px 0 5px;
	}
	#comment_body{
		margin:10px;
	}
	#comments_display{
		height:85%;
		overflow-y: scroll;
	}
	</style>

	<!DOCTYPE html>
	<html>
	<head>
	
	</head>
	<body>
	     <div id="comment_container">
	         <div id="comment_header">
	           	<p style="padding:10px;background:lightblue;"><button id="back">BACK</button> <b>Comments.</b></p>
	           	<div id="comments_display">
	           		<?php
	           		// fetch comments from database where post id== to the selected post
$getComments=mysqli_query($conn,"SELECT * FROM comments WHERE post_id='$postId'");
// get the actual number of comments
$getCommentsNum=mysqli_num_rows($getComments);
if($getCommentsNum>0)
{
	while($getCommentsRow=mysqli_fetch_assoc($getComments))
	{
		// get the id of the user who commented on the post
		$user_who_commented_id=$getCommentsRow['user_id'];
		// comment 
		$comment_text=$getCommentsRow['comment'];
		//get the account details of the person who commented-name and profile photo
		$get_account_info=mysqli_query($conn,"SELECT * FROM register WHERE id='$user_who_commented_id'");
		// if the user is not in the register table-display default details for the user.
		// get the number of records to check whether user is in the database
		$get_account_info_num=mysqli_num_rows($get_account_info);
	
			//fetch user details and display comments below them
			//fetch all info
			$account_info=mysqli_fetch_assoc($get_account_info);
			//profile name
			$profile_name=$account_info['FirstName']." ".$account_info['LastName'];
			
			?>
			<table>
		<tr>
			<td>
				<?php
				if($account_info['profile_pic']=="")
				{

					?>

				 <img src="<?php echo $defaultProfilePhoto;?>" height="50" width="50" id="profilePicture">
				 <?php
				}
				else{
				?>
				<img src="photos/profile/<?php echo $account_info['profile_pic']; ?>" height="50" width="50" id="profilePicture">
				<?php 
			}
			?>
			</td><td><b id="profileName"><?php echo $profile_name;?></b></td>
			
			
		</tr>
		<tr>
			<td></td>
			<td style="">
				
						<p style="background:#eee;padding:5px;border-radius:5px;margin-top:-4%;margin-right:10px;">
				        
				        <?php echo $comment_text;?></p>
				   
				
			</td>
		</tr>
		
	</table>
	
			<?php

		}
	
}
?>

	           	</div>
	        
	        </div> 
	        <div id="comment_form">
			<form enctype="multipart/form-data">
				<input type="text" name="comment" id="comment_text" placeholder="<?php echo $fname; ?>, comment on the post.">
	            <button id="post_comment" type="button">POST</button>
	            			
			</form>
	         
        </div>
	    </div>
<script type="text/javascript">
	$(document).ready(function(){
      $('#back').click(function(){
      	$('#showExtra').html("");
      });
      // upload comment to databse
      $('#post_comment').click(function(){
      	var pname='<?php echo $active_id; ?>';//person who is commenting on the post
         
        var postname='<?php echo $postId; ?>';//value of the post Id

        var comm=$('#comment_text').val();
            $.ajax(
                  {
                    type    :   "POST",
                    url     :   "saveComments.php",
                    data    :   {comment:comm,userId:pname,postId:postname},
                    success :   function(data){
                      alert(data);
                      
                    }
                  }
              );

             });


    
	});
</script>
</body>
</html>


<?php } ?>