<?php include("connection.php");
$defaultProfilePhotoStudent='photos/default_photos/one.jpeg';
$search=mysqli_real_escape_string($conn,$_POST['search']);
$sql="SELECT * FROM register WHERE phone LIKE '%$search%' OR FirstName LIKE '%$search%' OR LastName LIKE '%$search%'";
$q=mysqli_query($conn,$sql);
$queryResult=mysqli_num_rows($q);
 if($queryResult>0)
    {
        ?><h3><u>Search Results</u><sup style='border:1px solid yellow;background:yellow;border-radius:50%;font-size:10px;color:red;'>
        <?php echo $queryResult; ?>
        </sup></h3><br>
        <?php
        // while loop to fetch images from database============================
        while($getStudentsRow=mysqli_fetch_array($q,MYSQLI_ASSOC))
        {
           $studentsProfilePhoto='photos/profile/'.$getStudentsRow['profile_pic'];
             ?>
            <form action="students.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="StudentID" value="<?php echo $getStudentsRow['id'];?>" style="display:none;">
                    <button type="submit" name="getProfile" style="background: transparent;border:none;">
                        <table>
                            <tr>
                                <td>
                                    <?php
                                    if($getStudentsRow['profile_pic']=="")
                                    {
                                        ?>
                                     <img src="<?php echo $defaultProfilePhotoStudent; ?>" height="50" width="50" id="profilePicture">
                                     <?php
                                    }
                                    else{
                                    ?>
                                   <img src="<?php echo $studentsProfilePhoto; ?>" height="50" width="50" id="profilePicture">
                                        <?php 
                                    }
                                    ?>
                                    </td>
                                    <td>
                                        <b id="profileName"><?php echo $getStudentsRow['FirstName']." ".$getStudentsRow['LastName'];?></b>
                                        <br>
                                        <?php
                                        if($getStudentsRow['course']!='')
                                        {
                                            echo '<small class="color:gray;">'.$getStudentsRow['course'].'.</small>';
                                        }
                                        elseif($getStudentsRow['course']==''&&$getStudentsRow['School']!='')
                                        {
                                            echo '<small class="color:gray;">School of '.$getStudentsRow['School'].'.</small>';
                                        }
                                        else{
                                            echo '<small class="color:gray;">Currently a student at DeKUT.</small>';
                                        }
                                        ?>
                                    </td>
                                    <td></td>
                                </tr>
                            </table> 

                    </button>
                    <p style="width:98%;margin:auto;padding:3px;background:#eee;"></p>  
                </form>
            <?php
            }

            }
            else
            {
   	            
                
                echo "<p style='color:red;'><span class='fa fa-warning'></span> There is no results matching your search</p>";
                
              
            }
                         
     
                       
                            
        ?>
        <!-- ===================================end of php code =============================================-->
