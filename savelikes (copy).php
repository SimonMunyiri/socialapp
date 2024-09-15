<!-- insert likes to database  -->

<?php
include "connection.php";
        // php // code for like
if(isset($_POST['myEmail'])||isset($_POST['post_id'])){
  // save the id of the post in a variable
 

  $uname=$_POST['myEmail'];//person who is currently logged in ....
  $post_id=$_POST['post_id'];
  
  #get the number of likes on a particular post
  $getLikes=mysqli_query($conn,"SELECT * FROM likes WHERE post='$postId' AND friendEmail='$uname'");
  $getLikesNum=mysqli_num_rows($getLikes);
  if($getLikesNum>0){
  
    $deleteLike=mysqli_query($conn,"DELETE FROM likes WHERE post='$post_id'"); 
    
  }
  else{
      $likeQuery=mysqli_query($conn,"INSERT INTO likes(post,friendEmail)VALUES('$post_id','$uname')");
       $sendNotification=mysqli_query($conn,"INSERT INTO notifications(post_id,notification_type,notification_receiver)VALUES('$post_id','like','$userId')");
  }

   
     
      // notify users
     
     // }
   
      
     
    //}
 }



?>