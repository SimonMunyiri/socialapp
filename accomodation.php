<?php
include 'header.php';
if(isset($_POST['open_account_btn']))
{
	$hostel_id=$_POST['hostel_id'];
	$_SESSION['hostel_id']=$hostel_id;
	header('location:hostelInfo.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		#hostel_list{
			border:1px solid lightblue;
		}
		#actual_hostel_list{
			padding:10px;
		}
		#hostel_change_links li
		{
			color:blue;
			list-style: none;
			margin-left: 20px;
			cursor:pointer;
			text-decoration: underline;
			line-height:30px;

		}
		#room_hostel_info{
			padding-left:30px;
		}
	</style>
</head>
<body>
	<div id="body_center">
		<center>
			<br>

			<p style="background:black;padding:10px;margin-top:-10px;opacity: .7;">
				<span style="color:white;font-size:30px;">
					<b>DeKUT STUDENTS ACCOMODATION</b>
				</span>
			</p>
		</center>
		
		<p>
			<?php
         	# check whether the user has booked a room -->
         	$check_user_accomodation=mysqli_query($conn,"SELECT * FROM hostel_members WHERE userId='$userId' OR phone='$phone'");
         	$check_user_accomodation_num=mysqli_num_rows($check_user_accomodation);
         	if($check_user_accomodation_num>0)
         	{
         		#fetch hostel details
         		$check_user_accomodation_row=mysqli_fetch_assoc($check_user_accomodation);
         		$hostel_id=$check_user_accomodation_row['hostelId'];
         		$room_number=$check_user_accomodation_row['room'];
         		#fetch the name of the hostel
         		$hostel_account=mysqli_query($conn,"SELECT * FROM hostels WHERE id='$hostel_id'");
         		$hostel_name=mysqli_fetch_assoc($hostel_account);
         		$landlord_phone=$hostel_name['PhoneNumber'];
         		
         		$landlord_name=$hostel_name['ownerName'];
         		
         		?>
         		<div id="room_info_container">
         	<?php
         	# check whether the user has booked a room -->
         	$check_user_accomodation=mysqli_query($conn,"SELECT * FROM hostel_members WHERE userId='$userId' OR phone='$phone'");
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
         	}
         	else{
         		echo "<p style='background: lightgreen;padding:8px;border-radius:4px;'>Room status: *No records found!</p>";
         		#   *Allow user to book a room
         		?>
         		
         		<form action="hostelInfo.php" enctype="multipart/form-data" method="POST">

         			<select name="select_room" id="select_room">
         				<option value="">Select a room</option>
         				<?php
         				$selectRoom=mysqli_query($conn,"SELECT * FROM rooms WHERE hostelId='$hostel_id' AND status=''");
         				$selectRoomNum=mysqli_num_rows($selectRoom);
         				if($selectRoomNum>0)
         				{
         					while ($selectRoomRow=mysqli_fetch_assoc($selectRoom)) {
         						$room=$selectRoomRow['room'];
                    $bed=$selectRoomRow['bed'];
                  
         						echo "<option value=".$room.">".$room."</option>";
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
         		<?php
         		
         	}
         	else{
         		?>
         		<p>
			     Welcome to the official room booking page for all students studying in Dedan Kimathi University of Technology.
		        </p>
		<br>
		<div id="images">
			<img src="photos/accomodation/defaults/catholic hostels.jpg" style="width:30%;">
			<img src="photos/accomodation/defaults/ken.jpg" style="width:30%;">
			<img src="photos/accomodation/defaults/big.jpg" style="width:30%;">
		</div>
		<hr>
		<br>
		<p>
			To book a room,select(click/tap) the name of a hostel.You will be redirected to a page containing all information about the hostel you selected.Select a room that you want to stay in the click the 'book room' button.Your details will be sent to the caretaker/owners of the hostel.
		</p>
		<br>

		<div id="hostel_list">
			<p style="background: lightblue;padding:8px;">List of hostels</p>
			<div id="actual_hostel_list">
			
			<?php
			#fetch hostel information from database
			#remember you are fetching details of all hostels available in the database
			$hostelAccountQuery=mysqli_query($conn,"SELECT * FROM hostels");
			$hostelAccountNum=mysqli_num_rows($hostelAccountQuery);
			if($hostelAccountNum>0)
			{
				$id=1;
				while($hostelAccountRow=mysqli_fetch_assoc($hostelAccountQuery))
				{
					#display all information in a table format
					?>
					<form action="accomodation.php" method="POST" enctype="multipart/form-data">
						<input type="text" name="hostel_id" value="<?php echo $hostelAccountRow['id']; ?>" style="display:none;"/>
						<button type="submit" name="open_account_btn" style="border:none;background: transparent;">
							<table>
						        <tr>
							        <td><?php echo $id++.". "; ?></td>
							        <td><img src="photos/accomodation/defaults/catholic hostels.jpg" style="border-radius:50%;" height="50" width="50"> </td>
							        <td>
								        <b><?php echo $hostelAccountRow['HostelName']; ?></b>
								        <br>
								        <span style="color:gray;font-size:13px;">Hostel owned by <?php echo $hostelAccountRow['ownerName']; ?></span>
							        </td>
							
						            </tr>
					            </table>							
						    </button>
					    
					    <p style="padding:2px;background:#eee;"></p>
					</form>
					<?php
				}
			}
			else
			{
				echo "<center>No hostels found!</center>";
			}

			?>
		   </div>
		</div>
         		<?php
         	}
         	?>
         	
		</p>
		
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#room_hostel_info').hide();
			$("#new_room").click(function(){
				$('#room_hostel_info').slideToggle();
			});
		});
	</script>


</body>
</html>