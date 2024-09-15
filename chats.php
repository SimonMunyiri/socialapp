<?php
$defaultProfilePhotoStudent='photos/default_photos/one.jpeg';
include 'connection.php';
$StudentID=$_SESSION['StudentID'];
if(isset($_POST['getProfile']))
{
  $student_id=$_POST['StudentID'];
  $_SESSION['StudentID']=$student_id;
 
    header('location:inbox.php');
 
  
}

$getMessages=mysqli_query($conn,"SELECT * FROM messages");
$getMessagesNum=mysqli_num_rows($getMessages);
if($getMessagesNum>0)
{
	while($getMessagesRow=mysqli_fetch_assoc($getMessages))
	{   
		
		$sent_messages=$getMessagesRow['your_id'];
		$received_messages=$getMessagesRow['my_id'];
		$acc_id=$getMessagesRow['id'];
		$get_account_details=mysqli_query($conn,"SELECT * FROM register WHERE id='$acc_id'");
		$get_account_details_num=mysqli_num_rows($get_account_details);
		$get_account_details_row=mysqli_fetch_assoc($get_account_details);
		$studentsProfilePhoto='photos/profile/'.$get_account_details_row['profile_pic'];

		if($sent_messages==$userId){
			?>
           <form action="message.php" method="POST" enctype="multipart/form-data">
                  <input type="text" name="StudentID" value="<?php echo $get_account_details_row['id'];?>" style="display:none;">
                  <button type="submit" name="getProfile" style="background: transparent;border:none;">
                    <table>
                        <tr>
                          <td>
                            <?php
                            if($get_account_details_row['profile_pic']=="")
                            {
                              ?>
                             <img src="<?php echo $defaultProfilePhotoStudent; ?>" height="50" width="50" id="profilePicture">
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
                                <b id="profileName"><?php echo $get_account_details_row['FirstName']." ".$get_account_details_row['LastName'];?></b>
                               
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
}
else{
	echo "<br><h1 style='color:gray;text-align:center;'>We can't find chats for you.</h1><br>";
}
?>
