<!-- Note:This page is only visible to the hostel owners
     Meaning that this page should not appear on student's portal

     @ author-Simon Kamangaru Munyiri

 -->



 <!-- Link to font-awesome library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- link to Jquery library -->
<script  src="https://code.jquery.com/jquery-3.4.1.js"  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>



<?php
include 'db_connect.php';

#this is the photo that is displayed when the student has not set a profile photo
$defaultProfilePhotoStudent='photos/default_photos/one.jpeg';

session_start();
#Phone number of the logged in user is put into a session here
$phone=$_SESSION['phone'];
#id of the logged in user is put into a session here
$loggedInId=$_SESSION['id'];


#Do not allow a user to access this page without logging in
#incase the user types the url to this page,he/she should be redirected back to the log in page
if(!isset($loggedInId))
{
  #redirecting user to the login page
  header("location:hostelLogin.php");
}


#the code below is used to confirm payments.
#This is done manuanlly by the hostel owner
#Note that this happens asynchronously.The data will be updates to the database without refreshing the page
#In the form,we have used button of type button and note submit.Then Jquery ajax to pass the data to db 

if((isset($_POST['stdId']))&&(isset($_POST['hstId'])))
{

  $hostelId=$_POST['hstId'];
  $studentId=$_POST['stdId'];
  $saveDetailsQuery=mysqli_query($conn,"UPDATE hostel_members SET payment='Payment confirmed' WHERE userId='$studentId'");  
}


#the code below is used to confirm payments.
#This is done manuanlly by the hostel owner
#Note that this happens asynchronously.The data will be updates to the database without refreshing the page
#In the form,we have used button of type button and note submit.Then Jquery ajax to pass the data to db 

elseif((isset($_POST['stdId2']))&&(isset($_POST['hstId2'])))
{
  $hostelId2=$_POST['hstId2'];
  $studentId2=$_POST['stdId2'];
  $saveDetailsQuery=mysqli_query($conn,"UPDATE hostel_members SET checkin='Checked In' WHERE userId='$studentId2'");  
   
}


#fetching the details of the hostel,i.e,name,hostel owner name,id,phone
$getDetails=mysqli_query($conn,"SELECT * FROM hostels WHERE id='$loggedInId'");
$fecthDetails=mysqli_fetch_assoc($getDetails);
$hostelId=$fecthDetails['id'];

#php code to save new data
#edited info
if(isset($_POST['save']))
{
    #This is the name of the hostel
	  $username=$_POST['username'];

    #hostel owner national id
    $NationalId=$_POST['NationalId'];

    #the name of the person who created the account
    $account_creater=$_POST['account_creater'];

    #the phone number of the hostel owner
    $contacts=$_POST['contacts'];


    #php query code to update the new data into the database
    $editQuery=mysqli_query($conn,"UPDATE hostels SET ownerName='$account_creater',NationalId='$NationalId',HostelName='$username',PhoneNumber='$contacts' WHERE id='$hostelId'");

    #alert the user that the information has been saved into the database
    #NOTE that the information will reflect on users' page when they click the refresh button or refresh the page
    if($editQuery)
    {
	    ?>
	    <script type="text/javascript">
		    alert("We have saved the data for you.\nThe new details will reflect on your account once your refresh the page.\nClick the refresh button.");
	    </script>
	    <?php
    }
    else{
	    ?>
	    <script type="text/javascript">
		    alert("Sorry,there was a problem saving your data.\nPlease try again later");
	    </script>
	    <?php
    }

}

#logging the user out of the room
#session should be destroyed when the user logs out of the room
#the user should be redirected to a to log in page

if(isset($_POST['logout']))
{
  session_destroy();
  header("location:hostelLogin.php");

}


#NOTE: the user should not access the hostel page if he/she has not logged in
#incase the user types the URL directly he/she will be redirected to the log in page



?>

<!DOCTYPE html>
<html>
<head>
	<title> <?php echo $fecthDetails['HostelName']; ?> </title>

	<style type="text/css">
		body{
			background:#eee;
			margin:0;
      
		}

		#body_center{
			  width:500px;
		    background:white;
		    margin:auto;		
		    padding:1px 20px;


		}
		#about_info li{
          list-style: none;
          line-height:40px;
		}
		.hostel_nav{
			border:none;
			background:blue;
			padding:4px;
			color:#fff;
		}
		.abount_links{
			color:blue;
			cursor: pointer;
		}
	</style>

</head>
<body>
   <div id="body_center">

      <center>
      	<h2>
      		<?php echo $fecthDetails['HostelName']; ?>
      			
      	</h2>

      	<p style="color:gray;font-size:14px;">
      		<!-- display the number of unoccupied beds for a particular hostel -->



      		<?php
      		$getRooms=mysqli_query($conn,"SELECT * FROM rooms WHERE hostelId='$hostelId' AND status!='BOOKED'");
      		$getRoomsNum=mysqli_num_rows($getRooms);
      		echo $getRoomsNum." unoccupied beds";
      		?>


      	</p>
      </center>
      <hr>
      
      
     

      <div id="hostel_info">
      	<p>
          <form action="myhostel.php" method="post" enctype="multipart/form-data">
      		<a href="" style="text-decoration:none;color:blue;">


      		    <span id="refresh_page" title='Refresh the page' class="abount_links">
      		    	<span class="fa fa-refresh"></span> 
      		    	Refresh page
      		    </span>


      	    </a> 
      		 |
      		<span id="about_link" title="View about info.Visible to all." class="abount_links">
      			<span class="fa fa-info"></span> 
      		    About 
      		</span> | 


      		<span id="edit_about_link" title="Edit account details" class="abount_links">
      			<span class="fa fa-edit"></span> 
      		    Edit hostel details
      		</span>|


      		<span id="new_room" title="Add a new room to your portal." class="abount_links">
      			<span class="fa fa-plus"></span> Add Room(s)
      		</span>|

          <span id="log_out" title="Log out of <?php echo $fecthDetails['HostelName']; ?>." class="abount_links">

             
                <input type="submit" style="border: none;padding:0;color:blue;background:transparent;" name="logout" value="LOG OUT"/>
             </form>

          </span>

      	</p >
      	<ul id="about_info">

      		<li>
      			<b>Name:</b> 
      			<?php echo $fecthDetails['HostelName']; ?>
      	    </li>

      		<li>
      			<b>National Id:</b> 
      			<?php echo $fecthDetails['NationalId']; ?>
      	    </li>

      		<li>
      			<b>Account created by:</b> 
      			<?php echo $fecthDetails['ownerName']; ?>
      		</li>

      		<li>
      			<b>Contacts:</b> 
      			<?php echo $fecthDetails['PhoneNumber']; ?>
      		</li>

      		<li>
      			<b>Hostel Id:</b> 
      			<?php echo $fecthDetails['id']; ?>
      		</li>

          <li>
            <b>Hostel Rules:</b> 
            <?php
            if($fecthDetails['rules_pdf']=="")
            {
              echo "You have not uploaded rules for your hostel.<a href='hostel_rules.php'>Click to upload rules.</a>";

            }
            else
            {
              echo "Rules available";
            }
            ?>
          </li>

          <li>
            Remember students of different gender can not book the same room.
          </li>


      	</ul>
       
      	<div id="edit_about_info">
      		<form action="myhostel.php" method="POST" enctype="multipart/form-data">
      		<table>
      			<tr>
              
      				<td>
      					<lable><b>Name:</b></lable>
      				</td>

      				<td>
      					<input type="text" name="username" value="<?php echo $fecthDetails['HostelName']; ?>"/>
      				</td>

      			</tr>

             <!-- ===================================================================================== -->

      			<tr>

      				<td>
      					<lable><b>National Id:</b></lable>
      				</td>

      				<td>
      					<input type="text" name="NationalId" value="<?php echo $fecthDetails['NationalId']; ?>"/>
      				</td>

      			</tr>
             <!-- ===================================================================================== -->
              
      			<tr>

      				<td>
      					<lable><b>Account created by:</b></lable>
      				</td>

      				<td>
      					<input type="text" name="account_creater" value="<?php echo $fecthDetails['ownerName']; ?>"/>
      				</td>

      			</tr>
             <!-- ===================================================================================== -->

      			<tr>

      				<td>
      					<lable><b>Contacts:</b></lable>
      				</td>

      				<td>
      					<input type="text" name="contacts" value="<?php echo $fecthDetails['PhoneNumber']; ?>"/>
      				</td>

      			</tr>
             <!-- ===================================================================================== -->

      			<tr>
      				
      				<td>
      					<input type="submit" style="background: blue;color:white;border:none;border-radius: 5px;box-shadow:2px 2px 2px yellow;" name="save" value="SAVE DETAILS"/>
      				</td>
      			</tr>
             <!-- ===================================================================================== -->


      		</table>
      	</form>
      	</div>


      	<!-- block to add rooms to the portal -->


      	<?php

      	#==================RULES==========================================
      	#1.User must not add a room twice.
      	#2.Room number field must not be empty.
      	#3.Description field must not be filled.
      	#4.SQL injection must be prevented in every hostel input field.
      	#=================================================================



      	if(isset($_POST['save_details']))
      	{
      		#save the values of input fields to variables
      		#room number value
      		$RoomNumber=$_POST['room_number'];
          #number of beds in the room
          $beds=$_POST['beds_no'];
      		#description field value
      		$DescriptionValue=$_POST['description'];



      		#check that the room number field is not empty
      		#NOTE THAT THE QUERY CODE TO INSERT DATA INTO THE DATABASE COMES AFTER THE check,
      		#that is,you can only insert once the room number field is not empty and the bed number field must not be empty.

      		if($RoomNumber!="" && $beds!="")
      		{
            #declare variables for beds=>we have a maximum of four beds


            #this is bed number one
            $bed_one=$RoomNumber." bed 1";

            #bed number 2
            $bed_two=$RoomNumber." bed 2";

            #bed number 3
            $bed_three=$RoomNumber." bed 3";

            #bed number 4
            $bed_four=$RoomNumber." bed 4";


            #NOTE that we are saving the rooms and bed in one column in the database
            #they are saved as a single "string"
            #the bed numbers saved in the variables above is used to check whether a room has already been saved into the database to avoid inserting the same room twice.


      			#check whether the room and bed is already in the database
      			$checkRoomAvailability=mysqli_query($conn,"SELECT * FROM rooms WHERE room_bed='$bed_one' OR room_bed='$bed_two' OR room_bed='$bed_three' OR room_bed='$bed_four' AND hostelId='$hostelId'");


      			#count the number of rows that match the above criteria
      			$checkRoomAvailabilityNum=mysqli_num_rows($checkRoomAvailability);


      			#if room is found,pop up an error message 
      			if($checkRoomAvailabilityNum>0)
      			{
      				?>
      				<script type="text/javascript">
      					alert("Room and bed exists");
      				</script>
      				<?php
      			}


      			#if the room does not exist,go ahead and save the room details to the database
      			else{

               if($beds=="one")
              {

                #in this case we are quering only once ...........
                 $saveRoomQuery=mysqli_query($conn,"INSERT INTO rooms(hostelId,room,bed,room_bed,description)VALUES('$hostelId','$RoomNumber','bed 1','$bed_one','$DescriptionValue')");

                 #alert the user that the room has been saved successfully
                 if($saveRoomQuery)
                 {
                   ?>

                   <script type="text/javascript">
                     alert("Room <?php echo $RoomNumber; ?> added!");
                   </script>

                   <?php
                 }


                 else{
                ?>
                 <script type="text/javascript">
                  alert("Sorry,there was a problem that occured as we were saving your room,\n\nplease try again later.");
                </script>
                <?php
              }

              }

               if($beds=="two")
              {
                 $saveRoomQuery=mysqli_query($conn,"INSERT INTO rooms(hostelId,room,bed,room_bed,description)VALUES('$hostelId','$RoomNumber','bed 1','$bed_one','$DescriptionValue')");

                 $saveRoomQuery=mysqli_query($conn,"INSERT INTO rooms(hostelId,room,bed,room_bed,description)VALUES('$hostelId','$RoomNumber','bed 2','$bed_two','$DescriptionValue')");
                 #alert the user that the room has been saved successfully
                 if($saveRoomQuery)
                 {
                   ?>

                   <script type="text/javascript">
                     alert("Two beds added!");
                   </script>

                   <?php
                 }

                 else{
                ?>
                <script type="text/javascript">
                  alert("Sorry,there was a problem that occured as we were saving your room,\n\nplease try again later.");
                </script>
                <?php
              }

              }

              if($beds=="three")
              {
                $saveRoomQuery=mysqli_query($conn,"INSERT INTO rooms(hostelId,room,bed,room_bed,description)VALUES('$hostelId','$RoomNumber','bed 1','$bed_one','$DescriptionValue')");

                $saveRoomQuery=mysqli_query($conn,"INSERT INTO rooms(hostelId,room,bed,room_bed,description)VALUES('$hostelId','$RoomNumber','bed 2','$bed_two','$DescriptionValue')");

                $saveRoomQuery=mysqli_query($conn,"INSERT INTO rooms(hostelId,room,bed,room_bed,description)VALUES('$hostelId','$RoomNumber','bed 3','$bed_three','$DescriptionValue')");
                 #alert the user that the room has been saved successfully
                 if($saveRoomQuery)
                 {
                   ?>
                   <script type="text/javascript">
                     alert("Three beds saved!");
                   </script>
                   <?php
                 }
                 else{
                ?>
                <script type="text/javascript">
                  alert("Sorry,there was a problem that occured as we were saving your room,\n\nplease try again later.");
                </script>
                <?php
              }

              }

               if($beds=="four")
              {
                 $saveRoomQuery=mysqli_query($conn,"INSERT INTO rooms(hostelId,room,bed,room_bed,description)VALUES('$hostelId','$RoomNumber','bed 1','$bed_one','$DescriptionValue')");

                 $saveRoomQuery=mysqli_query($conn,"INSERT INTO rooms(hostelId,room,bed,room_bed,description)VALUES('$hostelId','$RoomNumber','bed 2','$bed_two','$DescriptionValue')");

                 $saveRoomQuery=mysqli_query($conn,"INSERT INTO rooms(hostelId,room,bed,room_bed,description)VALUES('$hostelId','$RoomNumber','bed 3','$bed_three','$DescriptionValue')");

                 $saveRoomQuery=mysqli_query($conn,"INSERT INTO rooms(hostelId,room,bed,room_bed,description)VALUES('$hostelId','$RoomNumber','bed 4','$bed_four','$DescriptionValue')");
                 #alert the user that the room has been saved successfully

                 if($saveRoomQuery)
                 {
                   ?>
                   <script type="text/javascript">
                     alert("Four beds added!");
                   </script>
                   <?php
                 }
                 else{
                ?>
                <script type="text/javascript">
                  alert("Sorry,there was a problem that occured as we were saving your room,\n\nplease try again later.");
                </script>
                <?php
              }

              }
      				
      				
      				
      			}

      		}
      		else
      		{
      			?>
      			<script type="text/javascript">
      				alert("Room or bed number is empty!");
      			</script>
      			<?php
      		}

      	}

      	?>

        <style type="text/css">
          #add_rooms_container input,#add_rooms_container select{
             border:none;
             border-bottom: 1px solid black;

          }
          #add_rooms_container button{
            border:none;
            background:blue;
            color:white;
            padding:4px;
            width:100%;
          }
        </style>


      	<div id="add_rooms_container">
      		<form action="myhostel.php" method="POST" enctype="multipart/form-data">
      		    <table>
                <!-- =========================================================================================== -->
      			    <tr>
      				    <td><label><b>Room Number:</b></label></td>
      				    <td><input type="number" name="room_number" placeholder="Room number" required/> <span style="color:red;">*</span></td>
      			    </tr>
                <!-- ===================================================================================== -->
                <tr>
                  <td>
                    <label><b>No of beds:</b></label>
                  </td>
                  <td>
                    <select name="beds_no">
                      <option value="">Select number of beds</option>
                      <option value="one">1</option>
                      <option value="two">2</option>
                      <option value="three">3</option>
                      <option value="four">4</option>
                    </select>
                  </td>
                </tr>

                <!-- ============================================================================================= -->

      			    <tr>
      				    <td><label><b>Room Description<br>[Optional]:</b></label></td>
      				    <td>
      				    	<textarea name="description" placeholder="Room description" style="font-family: calibri;">
      				    	</textarea>
      				    </td>
      			    </tr>

                <!-- =============================================================================================== -->

      			    <tr>
      				    <td></td>
      				    <td>
                    <button type="submit" name="save_details">
                      <span class="fa fa-upload">
                      </span>
                      SAVE ROOM
                    </button>
                   
                  </td>
      			    </tr>
                <!-- ============================================================================================== -->
      		    </table>
      		</form>
      	</div>


      	<hr>

      	<div id="hostel_members_display">
         
      		<!-- display members of the selected hostel -->
          
      		<?php
      		#note that we fetch details from the database table "hostel_members" where the "hostelId" matches the id of the logged in account
      		$getMembersQuery=mysqli_query($conn,"SELECT * FROM hostel_members WHERE hostelId='$hostelId' ORDER BY room ASC");
         
      		#count the number of records that matches the given query
      		$getMembersQueryNum=mysqli_num_rows($getMembersQuery);

          echo '<p style="background:lightblue;padding:4px;">Hostel Members.<span style="font-size:15px;">(Population: '.$getMembersQueryNum.') </span></p>';

          echo '


               <p>

                  This is a list of students who have booked  rooms in your hostel.


                  <span id="read_more" style="color:blue;cursor:pointer;">
                      ...read more
                  </span>

                  <span id="view_more">

                    When they pay,click the \'confirm button\' to confirm the payment.You should click the \'check in button\' to confirm that the student has checked into the room.Click the \'check out button\' to confirm that the student has cleared from the room.

                  
                  </span>


               </p>






          ';


      		#run the loop to fetch the code only when there are records in the database
      		if($getMembersQueryNum>0)
      		{
            $id=1;
      			while($getMembersQueryRow=mysqli_fetch_assoc($getMembersQuery))
      			{
      				#id of a user
      				$userId=$getMembersQueryRow['userId'];

              #================================================================================================
      				#fetched data is displayed inform of a table
      				#columns=>Profile photo|Name|phone|room|payment|
      				#note that name and phone are fetched from the register table where details of users of the social network are saved.
              #===============================================================================================


      				  $fetchAccountDetailsQuery=mysqli_query($conn,"SELECT * FROM register WHERE id='$userId' ");
      				  #fetch account details to display
      			    $fetchAccountDetailsRow=mysqli_fetch_assoc($fetchAccountDetailsQuery);
      			    #user profile photo path
      			    $userProfilePhotoHostel='photos/profile/'.$fetchAccountDetailsRow['profile_pic'];
      			    #name 
      			    $UserName=$fetchAccountDetailsRow['FirstName']." ".$fetchAccountDetailsRow['LastName'];
      			    #phone
      			    $PhoneNumberDisplay=$fetchAccountDetailsRow['phone'];
                #students phone number
                $students_phone=$fetchAccountDetailsRow['phone'];
      			    ?>

      			    <table>
      			    	<tr>

                    <td>
                      <?php
                       echo $id++; 
                      ?>.
                    </td>

      			    		<td>
      			    			 <?php
                        #note that you must check whether the user has updated his/her profile pic
                        #if no profile pic in the database=>a default profile photo will be displayed instead
                        if($fetchAccountDetailsRow['profile_pic']=="")
                        {

                        ?>
                        <img src="<?php echo $defaultProfilePhotoStudent; ?>" height="40" width="40" id="profilePicture">
                        <?php

                        }
                        else
                        {
                          #if the user profile photo is found=>it will be automatically displayed>
                          ?>
                          <img src="<?php echo $userProfilePhotoHostel; ?>" height="40" width="40" id="profilePicture">
                          <?php 
                        }
                       ?>
      			    		</td>

      			    		<td width="150">

      			    			<?php 
                       echo $UserName; 
                      ?>

                      <br>

                      <span style="font-size:12px;color:gray;">
                        <?php echo $students_phone; ?>                          
                      </span>

      			    		</td>

      			    		<td width="50">

      			    			<?php
                       echo "<b>Rm ".$getMembersQueryRow['room']."" 
                      ?>

      			    		</td>

      			    		<td>
                      <form enctype="multipart/form-data">
                        <br>
                        <!-- display whether the payment has been confirmed by the hostel owners -->
                       

                        <button type="button" id="confirm_payment_<?php echo $userId; ?>s" style="color:white;background: blue;border:none;padding:5px;border-radius:4px;">

                          <?php
                            $fetchConfirmQuery=mysqli_query($conn,"SELECT * FROM hostel_members WHERE userId='$userId'");
                            $fetchConfirmQueryRow=mysqli_fetch_assoc($fetchConfirmQuery);
                            if($fetchConfirmQueryRow['payment']=="")
                            {
                              echo 'Confirm payment';
                            }
                            else
                            {
                              echo 'Payment Confirmed';
                            }
                          ?>
                              
                        </button>

                       
                        <button type="button" id="check_in_<?php echo $userId; ?>" style="color:yellow;background: blue;border:none;padding:5px;border-radius:4px;">

                           <?php
                            $fetchConfirmQuery=mysqli_query($conn,"SELECT * FROM hostel_members WHERE userId='$userId'");
                            $fetchConfirmQueryRow=mysqli_fetch_assoc($fetchConfirmQuery);
                            if($fetchConfirmQueryRow['checkin']=="")
                            {
                              echo 'Check In';
                            }
                            else
                            {
                              echo 'Checked In';
                            }
                           ?>
                        </button>
                      </form>
                      
                    </td>

                    <script type="text/javascript">
                      $(document).ready(function(){
                         $("#confirm_payment_<?php echo $userId; ?>s").click(function(){

                          var studentId="<?php echo $userId; ?>";
                          var hostelId="<?php echo $hostelId; ?>";
                         
            
                         $.ajax(
                               {
                                 type    :   "post",
                                 url     :   "myhostel.php",
                                 data    :   {stdId:studentId,hstId:hostelId},
                                 success :   function(){
                                    $("#confirm_payment_<?php echo $userId; ?>s").html("Payment Confirmed");

                                    
                      
                                 }
                               }
                           )
                        });


                          $("#check_in_<?php echo $userId; ?>").click(function(){

                          var studentId2="<?php echo $userId; ?>";
                          var hostelId2="<?php echo $hostelId; ?>";
                         
            
                         $.ajax(
                               {
                                 type    :   "post",
                                 url     :   "myhostel.php",
                                 data    :   {stdId2:studentId2,hstId2:hostelId2},
                                 success :   function(){
                                    $("#check_in_<?php echo $userId; ?>").html("Checked In");

                                    
                      
                                 }
                               }
                           )
                        });

                      });
                    </script>

      			    	</tr>
      			    </table>
                <p style="padding:2px;background:#eee;"></p>
      			    <?php


      			}
      		}
      		else{
      			echo '<center><br>No booked room.</center><br>';
      		}

      		?>

      	</div>
      	
      </div>
   </div>

  <script type="text/javascript">
  	$(document).ready(function(){
  		$('#about_info').hide();
  		$("#about_link").click(function(){
  			$('#about_info').slideToggle();
  			$('#edit_about_info').slideUp();
  			$('#add_rooms_container').slideUp();
  		});


  		$('#edit_about_info').slideUp();
  		$("#edit_about_link").click(function(){
  			$('#edit_about_info').slideToggle();
  			$('#about_info').slideUp();
  			$('#add_rooms_container').hide();
  		});

  		$('#add_rooms_container').hide();
  		$("#new_room").click(function(){
  			$('#add_rooms_container').slideToggle();
  			$('#about_info').slideUp();
  			$('#edit_about_info').slideUp();
  		});


    
        $("#view_more").hide();
        $("#read_more").click(function(){
            $("#view_more").slideDown();
            $("#read_more").hide();
        });

  	});
  </script>
</body>
</html>