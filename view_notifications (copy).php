<?php
include "header.php";
$notificationId=$_SESSION['notificationId'];
#get notification type
$not_type=mysqli_query($conn,"SELECT  * FROM notifications WHERE id='$notificationId'");
$not_type_num=mysqli_num_rows($not_type);

#php code to save like into the database


// if(isset($_POST['saveLike'])){
//   // save the id of the post in a variable
 

//   $uname=$userId;//person who is currently logged in ....
//   $post_Id=$_POST['postname'];
  
//   #get the number of likes on a particular post
//   $getLikes=mysqli_query($conn,"SELECT * FROM likes WHERE post='$post_Id' AND friendEmail='$uname'");
//   $getLikesNum=mysqli_num_rows($getLikes);
//   if($getLikesNum>0){
  
//     $deleteLike=mysqli_query($conn,"DELETE FROM likes WHERE post='$post_Id'"); 
    
//   }
//   else{
//       $likeQuery=mysqli_query($conn,"INSERT INTO likes(post,friendEmail)VALUES('$post_Id','$uname')");
//        $sendNotification=mysqli_query($conn,"INSERT INTO notifications(post_id,notification_type,notification_receiver)VALUES('$post_Id','like','$userId')");
//   }

   
//  }


?>
<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<div id="body_center">
		<?php
		#get notification type
        $not_type=mysqli_query($conn,"SELECT  * FROM notifications WHERE id='$notificationId'");
        $not_type_row=mysqli_fetch_assoc($not_type);
        $not_name=$not_type_row['notification_type'];
        if($not_name=='post')
        {
        	
        	#image path to the posted photo
        	$image="photos/posts/".$not_type_row['post_id'];
        	$post=mysqli_query($conn,"SELECT * FROM posts WHERE photo='$image'");
        	$postId=mysqli_fetch_assoc($post);
        	#display the photo as it appears in the notifications table
        	#remember for posts,we uploaded the posted photo and not the id of the photo
        	?>
        	<h3>Posts.</h3>
        	<hr>
        	<img src="<?php echo $image; ?>" height="400"/>
        	<br>
        	<form enctype="multipart/form-data" method="POST" action="view_notifications.php">

                   <input type="text" name="postname" value="<?php echo $postId;?>" readonly style="display:none;"/>  <!-- id of the post -->
                   <table>
                    <tr>
                      <td>
                        <button type="submit" style="width:90px;height:30px;background:transparent;border:none;" name="saveLike">
                          <span style="font-size:20px;" class="" id="liked_post_icon"></span>
                          <span id="btn_text">Like</span>
                          <sup style="background:red;border-radius:50%;font-size:10px;color:white;padding:4px;">
                            <?php
                            #code to fetch likes from the database table "likes"
                            #note that likes are displayed along side each post henced fetched only where the post equals the id of the post.
                            #we post id of the post to update the likes table
                            $queryLikes=mysqli_query($conn,"SELECT * FROM likes WHERE post='$postId'");
                            #fetch the number of likes for a particular post
                            $queryLikesNum=mysqli_num_rows($queryLikes);
                            #divide by 1000 for all likes number above 1k and below 1m.
                            #the are displayed with a K at the end of the number e.g "1.5k likes"
                            if($queryLikesNum>=1000 && $queryLikesNum<1000000)
                            {
                              $kqueryLikesNum=$queryLikesNum/1000;
                              echo $kqueryLikesNum."k";
                            }
                            #divide by 1m for likes above 1m
                            #display the resulting value with an "m" at the end e.g "2m likes"
                            else if($queryLikesNum>=1000000)
                            {
                              $mqueryLikesNum=$queryLikesNum/1000000;
                              echo $mqueryLikesNum."m";
                            }
                            else echo $queryLikesNum;
                              
                            ?>
                          </sup>
                        </button>
                      </td>
             
                  
                 </form>
        	<hr>

        	<?php
        }



        elseif($not_name=='like')
        {
        	echo $notificationId;
        	$image="photos/posts/".$not_type_row['post_id'];
         ?>
         <h2>People who liked the photo.</h2>
         Photo:<img src="<?php echo $image; ?>" height="100" width="100"/>
         <hr>
         <?php
        }
		?>
	</div>
</body>
</html>