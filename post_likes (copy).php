<style type="text/css">
	#likes_display_container{
	    /*margin-top: -5%;*/
        background: white;
        width:500px;       
		position:fixed;
		height: 100%;
		overflow-y: scroll;
		padding-bottom:10px;
		margin-left:30%;
		
		
	}
	#likes_display_container form{
		padding:2px 10px 2px 10px;
	}
	#back{
		padding:6px;
		font-weight:bold;
		border:none;
		background: purple;
		color:white;
		border-radius: 5px;
	}
</style>
<div id="likes_display_container">
<?php include 'connection.php'; 
// redirect to student's profile
if(isset($_POST['getProfile']))
{
	$student_id=$_POST['StudentID'];
	$_SESSION['StudentID']=$student_id;
	if($student_id==$userId)
	{
		header('location:myprofile.php');
	}
	else{
		header('location:students_profile.php');
	}
	
}

if(isset($_POST['post_id']))
{
	$post_id=$_POST['post_id'];
	$likes=mysqli_query($conn,"SELECT * FROM likes WHERE post='$post_id' ORDER BY id DESC");
	$likesNum=mysqli_num_rows($likes);
	echo ' <p style="padding:10px;background:lightblue;"><button id="back">BACK</button> <b>People who liked the post.</b> ('.$likesNum.')</p>';
	
			while($getStudentsRow=mysqli_fetch_assoc($likes))
			{
				// get account id
				$account_id=$getStudentsRow['friendEmail'];
				$get_account_id=mysqli_query($conn,"SELECT * FROM register WHERE id='$account_id'");
				$getStudentsRow=mysqli_fetch_assoc($get_account_id);
				$studentsProfilePhoto='photos/profile/'.$getStudentsRow['profile_pic'];
				$defaultProfilePhoto='photos/default_photos/one.jpeg';
                ?>
                <form action="post_likes.php" method="POST" enctype="multipart/form-data">
                	<input type="text" name="StudentID" value="<?php echo $getStudentsRow['id'];?>" style="display:none;">
                	<button type="submit" name="getProfile" style="background: transparent;border:none;">
                		<table>
		                    <tr>
			                    <td>
				                    <?php
				                    if($getStudentsRow['profile_pic']=="")
				                    {
				                    	?>
				                     <img src="<?php echo $defaultProfilePhoto; ?>" height="50" width="50" id="profilePicture">
				                     <?php
				                    }
				                    else{
				                    ?>
				                   <img src="<?php echo $studentsProfilePhoto; ?>" height="50" width="50" id="profilePicture">
				                        <?php 
			                        }
			                        ?>
			                        </td>
			                        <td>
			                        	<b id="profileName"><?php echo $getStudentsRow['FirstName']." ".$getStudentsRow['LastName'];?></b>
			                        	<br>
			                        	<?php
                                        if($getStudentsRow['course']!='')
                                        {
                                        	echo '<small class="color:gray;">'.$getStudentsRow['course'].'.</small>';
                                        }
                                        elseif($getStudentsRow['course']==''&&$getStudentsRow['School']!='')
                                        {
                                        	echo '<small class="color:gray;">School of '.$getStudentsRow['School'].'.</small>';
                                        }
                                        else{
                                        	echo '<small class="color:gray;">Currently a student at DeKUT.</small>';
                                        }
			                        	?>
			                        </td>
			                        <td></td>
		                        </tr>
	                        </table> 

                	</button>
                	<p style="width:98%;margin:auto;padding:3px;background:#eee;"></p>  
                </form>
                <?php
			}


			

}
?>
</div>
<script type="text/javascript">
	$(document).ready(function(){
      $('#back').click(function(){

      	$('#showExtraLikes').html("");
      });
	});
</script>