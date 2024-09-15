<?php
include "db_connect.php";

	if((isset($_POST['comment']))&&(isset($_POST['userId']))&&(isset($_POST['postId'])))
     {
	    $comment=$_POST['comment'];
	    $userId=$_POST['userId'];
	    $postId=$_POST['postId'];
	    $saveComment=mysqli_query($conn,"INSERT INTO comments(comment,user_id,post_id)VALUES('$comment','$userId','$postId')");
	    $sendNotification=mysqli_query($conn,"INSERT INTO notifications(post_id,notification_type,notification_receiver)VALUES('$postId','comment','$userId')");
		if($saveComment){
			echo 'Commented';
		}
	     

      }
  
?>