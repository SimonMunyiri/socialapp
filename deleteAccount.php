<?php
include 'connection.php';
if(isset($_POST['delete_account']))
{
       	 		
    $del=mysqli_query($conn,"DELETE FROM register WHERE id='$userId'");
    $delPosts=mysqli_query($conn,"DELETE FROM posts WHERE phone='$userId'");
    $delMessages1=mysqli_query($conn,"DELETE FROM messages WHERE my_id='$userId'");
    $delMessages2=mysqli_query($conn,"DELETE FROM messages WHERE your_id='$userId'");
    $delConversation1=mysqli_query($conn,"DELETE FROM conversations WHERE myId='$userId'");
    $delConversation2=mysqli_query($conn,"DELETE FROM conversations WHERE yourId='$userId'");
    $delNotifications=mysqli_query($conn,"DELETE FROM notifications WHERE notification_receiver='$userId'");

    if($del)
    {
       	header('location:index.php');
    }
}

?>