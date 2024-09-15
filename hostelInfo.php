<?php
include 'header.php';
$hostel_id=$_SESSION['hostel_id'];
if(!isset($_SESSION['hostel_id']))
{
  header('location:index.php');
}

$hostelInfo=mysqli_query($conn,"SELECT * FROM hostels WHERE id='$hostel_id'");
$hostelInfoRow=mysqli_fetch_assoc($hostelInfo);
#fetch the number of rooms
$roomsQuery=mysqli_query($conn,"SELECT * FROM rooms WHERE hostelId='$hostel_id'");
$roomsQueryNum=mysqli_num_rows($roomsQuery);



#code to submit booked room
if(isset($_POST['book']))
{
	$select_room=$_POST['select_room'];

	if($select_room==""){
		?>
		<script type="text/javascript">
			alert("Please select a room");
		</script>
		<?php
	}
	else
	{
       $saveInfo=mysqli_query($conn,"INSERT INTO hostel_members(hostelId,userId,phone,room)VALUES('$hostel_id','$userId','$phone','$select_room')");

       #update that the room has been booked
       $saveBooked=mysqli_query($conn,"UPDATE rooms SET status='BOOKED' WHERE hostelId='$hostel_id' AND room_bed='$select_room'");
       #save the gender of the person who booked the room
       $saveGender=mysqli_query($conn,"UPDATE rooms SET gender='$gender' WHERE hostelId='$hostel_id' AND room_bed='$select_room'");
    
       if($saveInfo)
       {
       	?>
       	<script type="text/javascript">
       		alert("Room booked successfully.");
       	</script>
       	<?php
       }
       else{
       	?>
       	<script type="text/javascript">
       		alert("Sorry,we were unable to save your room details.Please try again later.");
       	</script>
       	<?php
       }
	}
}


?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		.hostel{
			font-family:Times New Roman !important;
		}
		h1{
			text-transform: uppercase;
			font-weight: bold;
			color:blue;
			font-size:25px;
		}
		#select_room option{
            width:400px;
            height:40px !important;
		}
		#book_btn{
           background:green;
           height:35px;
           width:100px;
           border:none;
           border-radius:5px;
           color:white;

		}
	</style>
</head>
<body>
	<div id="body_center" class="hostel">
       <center>
       	<h1><?php echo $hostelInfoRow['HostelName']; ?></h1>
        <span style="color:gray;font-size:13px;">Dedan Kimathi University of Technology</span>
        <br>
        <span style="color:gray;font-size:13px;">Hostel Owner(s):<?php echo $hostelInfoRow['ownerName']; ?>, </span>
        <br>
       	<span style="color:gray;font-size:13px;"><span class="fa fa-phone"></span> Contact us:<?php echo $hostelInfoRow['PhoneNumber']; ?>. </span>
        

       </center>
       <hr>
       <!-- ==================================================================================== -->
       <!--||
       || if the user has booked a room
       	   ||*display information about the booked room
       	   ||     
       	   
        -->

        <!-- on the other hand,if the user has not booked a room... -->
        <!--    
        	    *Should display a room that has been booked by a particular gender

         -->
         <!-- in both cases,the user should only see rooms that have not been booked -->
         <!-- strickly a room should not be booked twice -->
         <!--=============================================================================================  -->

         <div id="room_info_container">
         	<?php
         	# check whether the user has booked a room -->
         	$check_user_accomodation=mysqli_query($conn,"SELECT * FROM hostel_members WHERE userId='$userId'");
         	$check_user_accomodation_num=mysqli_num_rows($check_user_accomodation);
         	if($check_user_accomodation_num>0)
         	{
         		#display information about the booked room
         		#    -Room status
         		#    -Duration
       	        #    -Payment status

         		echo "<p style='background:lightgreen;padding:8px;'>Room status: Booked</p>";

         		

         		#fetch the hostel id and get the details of the hostel  from "hostels" table
            $hostelRow=mysqli_fetch_assoc($check_user_accomodation);
            #hostel id of the booked hostel
            $hostelCId=$hostelRow['hostelId'];
            #fetch the details of the hostel with the id fetched above
         		$hostelInfoQuery=mysqli_query($conn,"SELECT * FROM hostels WHERE id='$hostelCId'");
         		$hostelInfoRow=mysqli_fetch_assoc($hostelInfoQuery);
            #hostel name
         		$Hostel_Name=$hostelInfoRow['HostelName'];
            #hostel rules for download
            $hostel_rules='hostel_rules/'.$hostelInfoRow['rules_pdf'];

         		
            ?>

           <style type="text/css">
              #downloads ul li{
                list-style: none;
                padding-left:10px;
                line-height:25px;
              }
            </style>

            <div style="border:1px solid lightblue" id="downloads">


              <p style="background: lightblue;padding:5px;"><b>Downloads.</b></p>

              <ul>
                <li>
                  <span class="fa fa-download"> <a style="color:blue;" download='Room Inventory' href="http://localhost/comrades/trial.php">Download room inventory here.</a>
                </li>

                <li>
                  <span class="fa fa-download"> <a style="color:blue;" href="">Download clearance form.</a>
                </li>

                <li>
                  <span class="fa fa-download"> </span>

                  
                    <a style="color:blue;" download="<?php echo $Hostel_Name; ?> rules." href="<?php echo $hostel_rules; ?>">
                      Download hostel rules.
                    </a>
                </li>

              </ul>
            </div>

            <style type="text/css">
              #room_mates,#hostel_info{
                border:1px solid lightblue;
              }
              #hostel_info ul{
                padding-left:10px;
              }
              #hostel_info ul li{
                list-style:none;
                line-height:30px;
              }
              #more_info{
                margin:10px;
              }
            </style>

            <div id="hostel_info">
              <p style="background: lightblue;padding:5px;"><b>Booked Hostel Info.</b></p>

              <ul>
                <li><b>Hostel Name:</b><?php echo $Hostel_Name; ?></li>
                <li><b>Room:</b><?php echo $hostelRow['room']; ?></li>
                <li><b>Payment Status:</b>
                  <?php
                  if($hostelRow['payment']=="")
                  {
                    echo "Not confirmed yet.";
                  }
                  else
                  {
                    echo "Confirmed.";
                  }
                  ?>
                </li>
                <li><b>Check in status:</b>
                   <?php
                  if($hostelRow['checkin']=="")
                  {
                    echo "You have not checked into your room.";
                  }
                  else
                  {
                    echo "You checked in.";
                  }
                  ?>
                </li>
                <li><a title="We value the feedback of all DeKUT students." href="mailto:munyirisimon6@gmail.com">Send feedback.</a><li>
              </ul>
              <hr style="margin:10px;border:.1px solid gray;">
              <p id="more_info">
                Make sure you pay your rent before the deadline date stated by the hostel owner(s) 
                of <b><?php echo $Hostel_Name; ?></b>.When you pay,the hostel owner(s) will confirm your payment 
                and you can thereafter check into your room.In case you delete your account accidentally,remember to contact the owners of <b><?php echo $Hostel_Name; ?></b> to confirm your payments and check into your room again.Remember,this is only possible when you have already checked into your room.So take care not to lose your account before you check into your room.
              </p>
              <br>
            </div>


           



            <?php





       	   // *provide an option of changing the room
       	   // *Student should view roomies' info-e.g have access to profile,phone number,e.t.c
       	   // *Gender Room booking criteria-NOT YET SORTED==================================*****
            #NOTE:make sure only students of the same gender books a room.
         	}
         	else{
         		echo "<p style='background: lightgreen;padding:8px;border-radius:4px;'>Room status: *No records found!</p>";
         		#   *Allow user to book a room
         		?>
         		
         		
            <form action="hostelInfo.php" method="POST" enctype="multipart/form-data">
         			<select name="select_room" id="select_room">
         				<option value="">Select a room</option>
         				<?php
                #first check the status of a room
                #if the room is booked,get the gender of the first person who books the room
                #select the database again to make the room visible to people of the gender of the first person who booked the room

         				$selectRoom=mysqli_query($conn,"SELECT * FROM rooms WHERE hostelId='$hostel_id' AND status=''");
                $selectRoomNum=mysqli_num_rows($selectRoom);
                
                if($selectRoomNum>0)
                {
                  while($selectRoomRow=mysqli_fetch_assoc($selectRoom))
                  {
                    $vacantBed=$selectRoomRow['room_bed'];
                    $roomStatus=$selectRoomRow['status'];
                    $bookedGender=$selectRoomRow['gender'];
                    $bookedRoom=$selectRoomRow['room'];
                   
                      
                          ?>
                              <option value="<?php echo $vacantBed; ?>"><?php echo $vacantBed; ?></option>
                          <?php                       
                    
                    }
                    
                   
                 
                  }

                    

            
         				?>         				
         			</select>
              

         			<br>

         			<button type="submit" name="book" id="book_btn">
         				SUBMIT
         			</button>
         		</form>
         		<hr>
         		<?php
         	}
         	?>
         </div>

         <br>

        

	</div>
</body>
</html>