<?php include "header.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		#account_settings{
			padding:10px;
			font-size:20px !important;
		}
		#account_settings ul{
			margin:10px;
		}
		#account_settings ul li{
			line-height:40px;
			list-style: none;
			padding-left:20px;
			padding-right: 10px;
			cursor: pointer;
			border-bottom: 1px solid gray;
			color:blue;
		}
		#account_settings ul li a{
			color: blue;
			text-decoration:none; 
		}

	</style>
</head>
<body>
<div id="body_center">
    <div id="body_center_body">
	<div id="account_settings">
	   <p><b>Account Settings</b></p>
		<hr>
		<ul>
       	 		
       	 	<li id="newno">
                            <span class="fa fa-phone"  style="color:orange;font-size: 20px;">
                                   
                            </span> Change Phone number <b>></b>
                     </li>


       	 	<div id="change_number">
       	 	<?php
       	 	if(isset($_POST['saveNumber']))
       	 	{
       	 		$old=$_POST['old_number'];
       	 		$new=$_POST['new_number'];

                            if($old!=$phone)
                            {
                            ?>
                                   <script type="text/javascript">
                                          alert("Old phone number does not match with the one you you registered this account with!");
                                   </script>
                            <?php    
                            }
                            else
                            {
                                   $checkNewNo=mysqli_query($conn,"SELECT * FROM register WHERE phone='$new'");
                                   $checkNewNoNew=mysqli_num_rows($checkNewNo);
                                   if($checkNewNoNew>0)
                                   {
                                   ?>
                                          <script type="text/javascript">
                                                 alert("Your new number is already in use.");
                                          </script>
                                   <?php    
                                   }
                                   else
                                   {
                                          $sql=mysqli_query($conn,"UPDATE register SET phone='$new' WHERE phone='$old'");
                                          #update number in accomodation
                                          $phoneAccomodation=mysqli_query($conn,"UPDATE hostel_members SET phone='$new' WHERE phone='$old'");
                                          if($sql)
                                          {
                                                 ?>
                                                 <script type="text/javascript">
                                                        alert("Phone number changed successfully!");
                                                 </script>
                                                 <?php
                                          }
                                          else
                                          {
                                                 ?>
                                                 <script type="text/javascript">
                                                        alert("Sorry,we could not save your new phone number.Please try again later.");
                                                 </script>
                                                 <?php
                                          }   
                                   }
                                              
                            }
       	 				
       	 	}

       	 	?>
       	 	<p>
       	 	<form action="settings.php" enctype="multipart/form-data" method="post">
       	 		<table>
       	 			<tr>
       	 				<td>
       	 					<label>
                                                        <b>Old Number:</b>
                                                 </label>
       	 				</td>

       	 				<td>
                                                 <input type="number" name="old_number" style="border: none;border-bottom: 1px solid gray;" required/>
                                          </td>

       	 			</tr>
       	 						
                                   <tr>
       	 				<td>
       	 					<label>
                                                        <b>New Number:</b>
                                                 </label>
       	 				</td>

       	 				<td>
                                                 <input type="number" name="new_number" style="border: none;border-bottom: 1px solid gray;" required/>
                                          </td>
       	 			</tr>

       	 			<tr>

       	 			        <td></td>
       	 							

                                          <td>
                                                 <button type="submit" name="saveNumber" style="background: orange;color:white; border:none;padding:10px;">
                                                        SAVE NEW NUMBER
                                                 </button>
                                          </td>
       	 			</tr>
       	 		</table>
       	 					
       	 	</form>
       	</p>
       </div>
       <li>
              <span class="fa fa-user" style="color:orange;font-size: 20px;">
                     
              </span> 
              <a href="editprofile.php">Edit Profile photo <b>></b></a>
       </li>
       <li id="del">
              <span class="fa fa-trash" style="color:orange;font-size: 20px;"></span>
               Delete Account
               <span class="fa fa-sort-desc"></span>
       </li>
       </ul>
       <div id="delete_account">
       	<p>
                     <span class="fa fa-warning" style="color:red;font-size: 20px;"></span> 
                     Deleting account means that you are going to lose all your photos,chats and posts.
       	 	<br>
       	 	It's not possible to recover your data.<br>
       	 	Proceed to delete your account.<br>

       	 	<form action="deleteAccount.php" method="post" enctype="multipart/form-data">
       	 		<button type="submit" id="del_btn" name="delete_account" style="color:white;background:red;padding:6px;border:none;">
                                   <span class="fa fa-trash"></span> 
                                    DELETE ACCOUNT
                             </button>
       	 	</form>
       	</p>
       </div>
       	 	
		
 </div>
      
</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#delete_account').hide();
		$('#del').click(function(){
			$('#delete_account').fadeToggle();
		});
		$('#change_number').hide();
		$('#newno').click(function(){
			$('#change_number').fadeToggle();
		});

	});
</script>
</body>
</html>