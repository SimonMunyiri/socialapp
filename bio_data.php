<?php
include 'connection.php';
// user's bio data info is updated here.
//the data saved is fetched on this page and passed asynchronously to profile of the student.
//The data has no restriction.Student can be vulgar,funny,e.t.c
//page fetches bio data only from register table in mysql db(comrades)

$bio=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM register where id='$userId'"));
if($bio['bio_data']==""){
	echo 'I love DeKUT.';
}
else{
   echo $bio['bio_data']." ";

}

?>
