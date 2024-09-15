<?php
#include the main file which contains all main variables and also establishes a connection to the database
include 'connection.php';
#fetch conversations from "conversations table"
#myId is for conversations that "I" have started whereas yourId is for conversations that a "Second party" started
$defaultProfilePhoto='photos/default_photos/one.jpeg';

if(isset($_POST['to_inbox']))
{
  $student_id=$_POST['StudentID'];
  $_SESSION['StudentID']=$student_id;
  header('location:inbox.php');
  
  
}
$fetchBlankSql=mysqli_query($conn,"SELECT * FROM conversations  WHERE myId='$userId' OR yourId='$userId'  ORDER BY id DESC");

$fetchBlankSqlNum=mysqli_num_rows($fetchBlankSql);
if($fetchBlankSqlNum<=0){

  ?>
   <div id="front_page_container">
     <div id="actual_content" style="border:1px solid lightblue;">
      <p style="background:lightblue;padding:8px;font-weight:bold;font-size:20px;">Comrades Messenger</p>
      <br><br>
     <center>
        <img src="photos/default_photos/msg2.jpeg" height="200" style="border-radius:50%;box-shadow:2px 2px 2px #eee;border:1px solid #eee;">
        <br><br>
        <p>Once you start a new conversation,you will see it listed here.</p>
         <br>
        <button type="button" id="new_conversation" style="height:30px;border:none;background:green;padding:5px;border-radius:5px;color:white;box-shadow:2px 2px 2px orange;">
          Start a new conversation
        </button>
    </center>
    <br><br><br><br><br><br>
   
     </div>
    
   </div>
  <?php


}
else{

$fetchConversationsSql=mysqli_query($conn,"SELECT * FROM conversations  ORDER BY id DESC");

$fetchConversationsNum=mysqli_num_rows($fetchConversationsSql);

if($fetchConversationsNum>0)
{
  
 echo '<p style="background:lightblue;padding:8px;font-weight:bold;font-size:20px;">Comrades Messenger</p>';
  while($fetchConversationsRow=mysqli_fetch_assoc($fetchConversationsSql))
  {
    #display conversations that I started
    if($fetchConversationsRow['myId']==$userId)
    {
      $friendId=$fetchConversationsRow['yourId'];
      $getAccount=mysqli_query($conn,"SELECT * FROM register WHERE id='$friendId'");
      $row=mysqli_fetch_assoc($getAccount);
      $profilePictureStudent='photos/profile/'.$row['profile_pic'];
      
      ?>
     <form action="conversations.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="StudentID" value="<?php echo $row['id'];?>" style="display:none;">
            <button type="submit" name="to_inbox" style="background: transparent;border:none;">
                <table>
                    <tr>
                        <td>
                            <?php
                            if($row['profile_pic']=="")
                            {
                            ?>
                                <img src="<?php echo $defaultProfilePhoto; ?>" style="border-radius:50%;" height="40" width="40" id="profilePicture">
                                <?php
                            }
                            else{
                                ?>
                                <img src="<?php echo $profilePictureStudent; ?>" style="border-radius:50%;" height="40" width="40" id="profilePicture">
                                <?php 
                            }
                            ?>
                        </td>


                        <td>
                            <b id="profileName">
                                <?php echo $row['FirstName']." ".$row['LastName'];?>                                
                            </b>
                            <br>
                           
                            <span style="color:gray;font-size:13px;" id="con_msg">Click to chat</span>
                            
                        </td>

                        <td>
                          <?php

                          ?>
                        </td>

                    </tr>
                    </table> 

                </button>
                <p style="width:98%;margin:auto;padding:1px;background:#eee;"></p>  
            </form>


      <?php
    }
  
    #display conversations that a second party started
    if($fetchConversationsRow['yourId']==$userId)
    {
       $friendId=$fetchConversationsRow['myId'];
      $getAccount=mysqli_query($conn,"SELECT * FROM register WHERE id='$friendId'");
      $row=mysqli_fetch_assoc($getAccount);
       $profilePictureStudent='photos/profile/'.$row['profile_pic'];
      
      ?>

      <form action="conversations.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="StudentID" value="<?php echo $row['id'];?>" style="display:none;">
            <button type="submit" name="to_inbox" style="background: transparent;border:none;">
                <table>
                    <tr>
                        <td>
                            <?php
                            if($row['profile_pic']=="")
                            {
                            ?>
                                <img src="<?php echo $defaultProfilePhoto; ?>" style="border-radius:50%;" height="40" width="40" id="profilePicture">
                                <?php
                            }
                            else{
                                ?>
                                <img src="<?php echo $profilePictureStudent; ?>" style="border-radius:50%;" height="40" width="40" id="profilePicture">
                                <?php 
                            }
                            ?>
                        </td>


                        <td>
                            <b id="profileName">
                                <?php echo $row['FirstName']." ".$row['LastName'];?>                                
                            </b>
                            <br>
                            <?php
                            
                            

                            ?>
                            <span style="color:gray;font-size:13px;" id="con_msg">Click to chat</span>
                            
                        </td>

                        <td></td>

                    </tr>
                    </table> 

                </button>
                <p style="width:98%;margin:auto;padding:1px;background:#eee;"></p>  
            </form>

        
      <?php
    }
  }
  ?>
<button type="button" id="new_conversation" style="height:30px;border:none;background:green;padding:5px;border-radius:5px;color:white;box-shadow:2px 2px 2px orange;position: absolute;bottom:8px;left:65%;">
    <span class="fa fa-envelope"></span>
</button>
<?php
}
}

?>
<script type="text/javascript">
  // display contacts to select
    $('#new_conversation').click(function(){
       $('#all_users').load("chat_students.php");
    });


   
     
  
</script>
