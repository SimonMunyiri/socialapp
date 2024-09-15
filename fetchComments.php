<?php
$defaultProfilePhotoStudent='photos/default_photos/one.jpeg';
include 'connection.php';

if(isset($_POST['post_id']))
{
	$postId=$_POST['post_id'];
	echo $postId;

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
		if($get_account_info_num<=0)
		{
			//display comments with default user profile photo and profile name
			//profile name=comrade
			?>
			<table>
				<tr>
					<td>
						<img src="$defaultProfilePhotoStudent" height="70" width="70" style="border-radius:50%">
					</td>
					<td><b>Comrade comrade</b></td>
				</tr>
				<tr>
					<td colspan="2">
						<p>
							<?php echo $comment_text; ?>
						</p>
					</td>
				</tr>
			</table>
			<?php
		}
		else{
			//fetch user details and display comments below them
			//fetch all info
			$account_info=mysqli_fetch_assoc($get_account_info);
			//profile name
			$profile_name=$account_info['FirstName']." ".$account_info['LastName'];
			//profile photo
			$profile_photo='photos/profile'.$account_info['profile_pic'];
			?>
			<table>
		<tr>
			<td>
				<?php
				if($account_info['profile_pic']=="")
				{
					?>
				 <a href="myprofile.php"><img src="<?php echo $defaultProfilePhoto;?>" height="50" width="50" id="profilePicture"></a>
				 <?php
				}
				else{
				?>
				<a href="myprofile.php"><img src="<?php echo $profile_photo;?>" height="50" width="50" id="profilePicture"></a>
				<?php 
			}
			?>
			</td>
			<td>
				<b id="profileName"><?php echo $profile_name;?></b>
			</td>
			
		</tr>
	</table>
			<?php

		}
	}
}




}
?>