<?php
include "connection.php";

if(isset($_POST['getProfile']))
{
	$student_id=$_POST['StudentID'];
	$_SESSION['StudentID']=$student_id;
	
	header('location:students_profile.php');
		
}

#fetch a list of followers followed by followers suggestions
#in the list of followers, the user can unfollow...
#in the list of suggestions, the user can only follow

#fetch the list of ids of people who are following the user
$fetchFollowersSql=mysqli_query($conn,"SELECT * FROM followers WHERE following_id='$userId'");
#then count the total number of records that match a the above query
$fetchFollowersNum=mysqli_num_rows($fetchFollowersSql);
#check whether there are followers in the db
if($fetchFollowersNum>0)
{
	#display a list of followers
	while($fetchFollowersSqlRow=mysqli_fetch_assoc($fetchFollowersSql))
	{
		$id=$fetchFollowersSqlRow['following_id'];
		$getAccount=mysqli_query($conn,"SELECT * FROM register WHERE id='$userId'");
		$getAccountRow=mysqli_fetch_assoc($getAccount);

		$studentsProfilePhoto='photos/profile/'.$getAccountRow['profile_pic'];
			?>
			<table width="200">
		        <tr>
			        <td>
			        	<form action="followers.php" method="POST" enctype="multipart/form-data">
			        		<input type="text" name="StudentID" value="<?php echo $getAccountRow['id'];?>" style="display:none;">
			        		<button name="getProfile" type="submit" style="background: transparent;border:none;">
			        			<?php
				                if($getAccountRow['profile_pic']=="")
				                {
				                ?>
				                    <img src="<?php echo $defaultProfilePhoto; ?>" height="50" width="50" id="profilePicture">
				                <?php
				                }
				                else
				                {
				                ?>
				                    <img src="<?php echo $studentsProfilePhoto; ?>" height="50" width="50" id="profilePicture">
				                <?php 
			                    }
			                    ?>
			        		</button>
			        	</form>
				        
			        </td>
			        <td>
			            <b id="profileName">
			            	<?php echo $getAccountRow['FirstName']." ".$getAccountRow['LastName'];?>		            	
			            </b>

			            
			           
			        </td>
			        
		        </tr>
	        </table>
	        <p style="background:#eee;padding:2px;"></p>
	        <?php

	}


}
else
{
	echo "<center>You do not have followers.";
	echo "<br><hr>";
	echo "Suggestions<br>";
	echo "</center>";
	#display a list of suggestions...
	#first fetch a list of students taking the same course as the user.
	#then display a list of students in the same school/college
	#then display followers of followers

	#students taking the same course...
	#to achieve this,check in the register table for students taking the same course as the logged in account.
	$sameCourseSuggestions=mysqli_query($conn,"SELECT * FROM register WHERE course='$course' AND id!='$userId'");
	$sameCourseSuggestionsNum=mysqli_num_rows($sameCourseSuggestions);
	if($sameCourseSuggestionsNum>0)
	{

		while ($sameCourseSuggestionsRow=mysqli_fetch_assoc($sameCourseSuggestions)) 
		{
			// display the list
			$studentsProfilePhoto='photos/profile/'.$sameCourseSuggestionsRow['profile_pic'];
			?>
			<table width="300">
		        <tr>
			        <td>
			        	<form action="followers.php" method="POST" enctype="multipart/form-data">
			        		<input type="text" name="StudentID" value="<?php echo $sameCourseSuggestionsRow['id'];?>" style="display:none;">
			        		<button name="getProfile" type="submit" style="background: transparent;border:none;">
			        			<?php
				                if($sameCourseSuggestionsRow['profile_pic']=="")
				                {
				                ?>
				                    <img src="<?php echo $defaultProfilePhoto; ?>" height="50" width="50" id="profilePicture">
				                <?php
				                }
				                else
				                {
				                ?>
				                    <img src="<?php echo $studentsProfilePhoto; ?>" height="50" width="50" id="profilePicture">
				                <?php 
			                    }
			                    ?>
			        		</button>
			        	</form>
				        
			        </td>
			        <td>
			            <b id="profileName">
			            	<?php echo $sameCourseSuggestionsRow['FirstName']." ".$sameCourseSuggestionsRow['LastName'];?>		            	
			            </b>

			            <br>
			            
			            <?php
                         if($sameCourseSuggestionsRow['course']!="")
                         {
                         	echo "taking ".$sameCourseSuggestionsRow['course'];
                         }
                         elseif($sameCourseSuggestionsRow['bio_data']=="")
                         {
                         	"I love DeKUT";
                         }
                         else
                         {
                         	echo $sameCourseSuggestionsRow['bio_data'];
                         }
			            ?>
			            
			           
			        </td>
			        <td>
			        	<form enctype="multipart/form-data">
			        		<button type="button" id="<?php echo $sameCourseSuggestionsRow['id'];?>follow" style="color:white;background:blue;border-radius:8px;border:none;padding:5px;margin-top:12px;">
			        			Follow
			        		</button>
			        	</form>
			        </td>
		        </tr>
	        </table> 
	        <p style="background:#eee;padding:2px;"></p>
	          <script type="text/javascript">
                 $(document).ready(function(){
                     $("#<?php echo $sameCourseSuggestionsRow['id'];?>follow").click(function(){
                        
                        var myId="<?php echo $userId; ?>";
                        var friendId="<?php echo $sameCourseSuggestionsRow['id'];?>";
                        $.ajax(
                        {
                            type    :   "post",
                            url     :   "followers.php",
                            data    :   {mId:myId,frId:friendId},
                            success :   function(){
                                $("#<?php echo $sameCourseSuggestionsRow['id'];?>follow").html("following...");
                                $("#<?php echo $sameCourseSuggestionsRow['id'];?>follow").css("background","transparent");
                                $("#<?php echo $sameCourseSuggestionsRow['id'];?>follow").css("color","black");
                                $("#<?php echo $sameCourseSuggestionsRow['id'];?>follow").css("border","1px solid blue");
                                $("#<?php echo $sameCourseSuggestionsRow['id'];?>follow").css("border-radius","5px");
                            }
                        }
                    )
                });
            });
</script>
	        <?php
			
		}
	}
	else
	{
		echo "No suggestions";
	}


}


#insert follower details into the db
#note that this details are from JQuery code....not directly from html form
# we are inserting data into the database directly without refreshing the page
if( isset($_POST['mId']) && isset($_POST['frId']) )
{
	#fetch the id of the logged in user and friend's id storing them in their respective variables
	$myId=$_POST['mId'];
	$friendId=$_POST['frId'];
	#check whether the follower is available in the database
	$checkDb=mysqli_query($conn,"SELECT * FROM followers WHERE myId='$myId' AND following_id='$friendId'");
	$checkDbNum=mysqli_num_rows($checkDb);
	if($checkDbNum<=0)
	{
       #now save the data into the database
	   $saveDataQuery=mysqli_query($conn,"INSERT INTO followers(myId,following_id)VALUES('$myId','$friendId')");
	   #whenever the data is saved,the bg-color of the button changes 
	}
	else
	{
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				 $("#<?php echo $sameCourseSuggestionsRow['id'];?>follow").html("following...");
                 $("#<?php echo $sameCourseSuggestionsRow['id'];?>follow").css("background","transparent");
                 $("#<?php echo $sameCourseSuggestionsRow['id'];?>follow").css("color","black");
                 $("#<?php echo $sameCourseSuggestionsRow['id'];?>follow").css("border","1px solid blue");
                 $("#<?php echo $sameCourseSuggestionsRow['id'];?>follow").css("border-radius","5px");
			});
		</script>
		<?php
	}
	

}


?>

