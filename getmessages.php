<?php
include "connection.php";
$StudentID=$_SESSION['StudentID'];
$studentProfile=mysqli_query($conn,"SELECT * FROM register WHERE id='$StudentID'");
$studentProfileRow=mysqli_fetch_assoc($studentProfile);
$fnameStudent=$studentProfileRow['FirstName'];
$lnameStudent=$studentProfileRow['LastName'];
$profilePictureStudent='photos/profile/'.$studentProfileRow['profile_pic'];
$defaultProfilePhotoStudent='photos/default_photos/one.jpeg';

//get messages from database
$getSentMessages=mysqli_query($conn,"SELECT * FROM messages");
// $getReceivedMessages=mysqli_query($conn,"SELECT * FROM messages WHERE  myEmail='$id' AND friendEmail='$logUserId'");
//get the total number of messages
$getSentMessagesNum=mysqli_num_rows($getSentMessages);

if($getSentMessagesNum>0){
 //fetch all messages 
  while($getMessagesRow=mysqli_fetch_assoc($getSentMessages))
  {
  if(($getMessagesRow['my_id']==$userId)&&($getMessagesRow['your_id']==$StudentID)){
  ?>
  <br>
  <div style="background:green;color:white;border-radius:10px;padding:5px;max-width:400px;margin-left:220px;">
    <?php echo $getMessagesRow["message"]; ?><br>
    <span class="fa fa-check" style="font-size:10px;color:red; "></span>
    
              	 		    
  </div>
  
  <br>
  <?php
  }
  elseif(($getMessagesRow['your_id']==$userId)&&($getMessagesRow['my_id']==$StudentID)){
                    
                      ?>             	 		
              	 		<div style="margin-left:10px;max-width:250px;border-radius:10px;">
              	 		     <div style="background:#eee;border-radius:10px;padding:5px;">
                              <?php echo $getMessagesRow["message"]; ?>

                            
                          </div>
              	 		 </div>
              	 	
              	 		<br>
              	 		<?php
                    
              	 	}
              	 	
              	 		
              	 	}

              	 	
              	 
              	
                }

             

           ?>