<?php
include 'db_connect.php';
if(isset($_POST['book_room']))
{
	$select_room=$_POST['select_room'];
	echo $select_room;
}
?>