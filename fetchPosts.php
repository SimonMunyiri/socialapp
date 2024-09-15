<?php
include 'connection.php';
$defaultProfilePhotoStudent='photos/default_photos/one.jpeg';
$fetchPosts=mysqli_query($conn,"SELECT * FROM posts  ORDER BY id DESC ");
$numFetch=mysqli_num_rows($fetchPosts);
//=======================to profile===================
if(isset($_POST['getProfile']))
{
  $student_id=$_POST['StudentID'];
  $_SESSION['StudentID']=$student_id;
  if($student_id==$userId)
  {
    header('location:myprofile.php');
  }
  else{
    header('location:students_profile.php');
  }
  
}

?>
<!DOCTYPE html>
<html>
<head>


  <style type="text/css">
    #posts_container
    {
      width:500px;
      margin: auto;
    
    }
    #post_content{
      background: white;
      padding-left:20px;
      padding-right:20px;
      padding-top:10px;
      padding-bottom: 10px;
    }
    #direct_comment{
      padding-left: 15px;
    }
    #send_comment{
      background:blue;
      color:white;
      border:none;
      padding:3px;
    }
  </style>


</head>
<body>
  <div id="posts_container">
    <?php
    if($numFetch>0)
     {
      #fetch all posts from the database
      #each post should have the description,posted photo,username of the person who posted and his/her profile photo
      #below the posted photo,there is a form containing buttons that save likes  to the database & also open page to display comments and also allow user to comment.
      #Note that the number of comments are displayed next to the blue comment text
      #number of likes are displayed as a subscript of the "like" text.
        while ($fetchPostsRow=mysqli_fetch_assoc($fetchPosts)) 
        {
             //variables for post details
             // post id
             $post_Id=$fetchPostsRow['id'];
             //posted photo
             $postedPhoto='photos/posts/'.$fetchPostsRow['photo'];
             //desc or information about the photo posted by the user
             $description=$fetchPostsRow['description'];
             //person who posted-fetch account info
             $postPhoneId=$fetchPostsRow['phone'];
             #select database table data only where there is the is above.
             #NOTE that all accounts are saved in the "register" table
             $getAccountDetails=mysqli_query($conn,"SELECT * FROM register WHERE id='$postPhoneId'");
             #check the number of user accounts that have been registerd in the database
             $getAccountDetailsNum=mysqli_num_rows($getAccountDetails);
             // fetch posts only when the account is on the site
             #this prevents displaying posts of users who deleted their accounts.
             if($getAccountDetailsNum!=0)
             {
               $getAccountDetailsRow=mysqli_fetch_assoc($getAccountDetails);
               // get the username of the user.Full Name 
               $name=$getAccountDetailsRow['FirstName']." ".$getAccountDetailsRow['LastName'];
               //profile photo
               $profilePhoto='photos/profile/'.$getAccountDetailsRow['profile_pic'];

               ?>
               <div id="post_content">
                <form action="fetchPosts.php" method="POST" enctype="multipart/form-data">

                  <input type="text" name="postId" value="<?php echo $post_Id; ?>" style="display:none;">

                  <input type="text" name="StudentID" id="StudentID" value="<?php echo $postPhoneId; ?>" style="display:none;">

                  <style type="text/css">
                    #profile_header_container{
                      display: grid;
                      grid-template-columns:4fr 1fr;

                    }
                    #profile_btn,#menu_button{
                       width:100%;
                       
                    }
                    #menu_button{
                      text-align:right;
                      padding-right:10px;                      
                      font-family:arial !important;
                      padding-top:5px; 
                    }
                    #menu_button button{
                      background:transparent;
                      border:none;
                      cursor:pointer;
                      font-size:22px;
                      font-weight: bold;

                    }
                  </style>
              <div id="profile_header_container">
                <div id="profile_btn">
                  <button type="submit" name="getProfile" style="background: transparent;border:none;">
                    <table>
                        <tr>
                          <td>
                            <?php
                            #note that you must check whether the user has updated his/her profile pic
                            #if no profile pic in the database=>a default profile photo will be displayed instead
                            if($getAccountDetailsRow['profile_pic']=="")
                            {
                              ?>
                             <img src="<?php echo $defaultProfilePhotoStudent; ?>" height="40" width="40" id="profilePicture">
                             <?php
                            }
                            else{
                              #if the user profile photo is found=>it will be automatically displayed>
                            ?>
                           <img src="<?php echo $profilePhoto; ?>" height="40" width="40" id="profilePicture">
                                <?php 
                              }
                              ?>
                              </td>
                              <td>
                                <b id="profileName"><?php echo $name; ?></b>

                              </td>
                              <td> added a new photo.</td>
                              <td><span style="color:gray;font-size:12px;">-just now</span></td>
                              
                              
                            </tr>
                          </table> 

                  </button>
                </div>


                <div id="menu_button">
                  
                
                </div>



              </div>
                   
                </form>


                 <!-- diplay posted description -->
                <?php echo $description; ?>

                <br><br>
                <!-- display posted photo -->
                <a href="<?php echo $postedPhoto; ?>">
                  <img src="<?php echo $postedPhoto; ?>"  width="250" alt="IMG_COMRADES_<?php echo $postedPhoto; ?>"/>
                </a>

                <br>
                <form enctype="multipart/form-data">

                   <input type="text" id="postname" value="<?php echo $post_Id;?>" readonly style="display:none;"/>  <!-- id of the post -->
                   <table>
                    <tr>
                      <td>
                        <button type="button" style="width:90px;height:30px;background:transparent;border:none;"  id="l<?php echo $post_Id; ?>s">
                          <span style="font-size:20px;" class="" id="liked_post_icon"></span>Like
                          <sup style="background:red;border-radius:50%;font-size:10px;color:white;padding:4px;">
                            <?php
                            #code to fetch likes from the database table "likes"
                            #note that likes are displayed along side each post henced fetched only where the post equals the id of the post.
                            #we post id of the post to update the likes table
                            $queryLikes=mysqli_query($conn,"SELECT * FROM likes WHERE post='$post_Id'");
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
                  
                    <!-- ============J Q U E R Y    C O D E  to save likes to database==================== -->
        <script type="text/javascript">
          $(document).ready(function(){
           // when the like button is cliked....
          $("#l<?php echo $post_Id; ?>s").click(function(){
            
            var pname='<?php echo $userId; ?>';//person who is liking the post
            
            var postname='<?php echo $post_Id; ?>';//value of the post Id
            
            //var post_p=$('#StudentID').val();//person who posted
            
            $.ajax(
                  {
                    type    :   "post",
                    url     :   "savelikes.php",
                    data    :   {myEmail:pname,post_id:postname},
                    success :   function(){
                      
                      
                    }
                  }
              )
           });

          
                    
                    });
       
         </script>
                  
                 </form>
                 <!-- comments -->
                 <td>
                          <!-- get the name of the person who posted -->
                          <!-- comment on a post -->
                         <form enctype="multipart/form-data">
                          <input type="text" id="post_pc" value="<?php echo $postPhoneId; ?>"style="display:none;">

                         
                         

                          <button type="button"  style="height:30px;background:transparent;border:none;color:blue;" id="<?php echo $post_Id; ?>comment">
                            <!-- <sup style=";border:1px solid yellow;background:yellow;border-radius:50%;font-size:10px;color:red;"> -->
                            <span class="" style="color:purple;font-size:20px;"></span>
                            <?php
                              
                                #fetch comments for a particular post from the database table comments

                                $comments=mysqli_query($conn,"SELECT * FROM comments WHERE post_id='$post_Id'");
                                #fetch the exact number of comments from the database
                                $commentsNum=mysqli_num_rows($comments);
                                if($commentsNum==1)
                                {
                                  #note that this is only displayed when there is only one comment for a photo/post
                                  #ensures that the information displayed to the users is grammatically correct to avoid annoying the user.
                                   echo $commentsNum.' comment';
                                }
                                elseif($commentsNum>1 && $commentsNum<1000)
                                {
                                  #in this case,there are more than one comments in the table for a particular post,
                                  #so the comments must be displayed in plural to avoid annoying the users.
                                   echo $commentsNum.' comments';
                                }
                                elseif($commentsNum>1000 && $commentsNum<1000000)
                                {
                                  #for cases where the number of comments is more than 1k and less than 1m,divide the number of comments by 1,000 and the and a "K" at the end of the resulting value.
                                  $kcomments=$commentsNum/1000;
                                   echo $kcomments.'k comments';
                                }
                                elseif($commentsNum>1000000 && $commentsNum<1000000000)
                                {
                                  #for cases where the number of comments is more than 1m and less than 1m,divide the number of comments by 1,000,000 and the and a "m" at the end of the resulting value.
                                  $kcomments=$commentsNum/1000000;
                                  echo $kcomments.'m comments';
                                }
                                else{
                                  #in case there are no comments for the post,this is the information that is displayed showing the user will be the first one to like the post
                                  echo '<b style="color:blue;">Be the first one to comment.</b>';
                                }
                               
 
                              
                              
                            ?>
                          </button>
                        </form>

                        <!-- J Q U E R Y   code to display and comments,comment-likes and replies to the comments -->
                         <script type="text/javascript">
                            $(document).ready(function(){
                             // when the like button is cliked....
                              $("#<?php echo $post_Id; ?>comment").click(function(){
                               var postname='<?php echo $post_Id; ?>';//value of the post Id                                         
                              $.ajax(
                                    {
                                      type    :   "post",
                                      url     :   "comments.php",
                                      data    :   {post_id:postname},
                                      success :   function(data){
                                        $('#showExtra').html(data);                   
                      
                                       }
                                     }
                                 )
                              });
                              
                            
                            
                           });
                        </script>

 
                        </td>  </tr></table>
                        <!-- likes ============-->
                        <hr style="border:,1px solid gray;margin:5px 0 5px 0;">
                        <form enctype="multipart/form-data">


                          <input type="text" id="postIdLikes" value="<?php echo $post_Id; ?>" readonly style="display:none;">


                          <button style="background:transparent;border:none;" id="l<?php echo $post_Id; ?>Display" type="button"><b>


                            <?php
                            #the code below displays the number of likes for a particular post
                            #NOTE that the username of one person who likes the post is displayed + all likes less 1 is displayed as others e.g "liked by Simon Kamangaru and 2k others"
                             $getLikes=mysqli_query($conn,"SELECT * FROM likes WHERE post='$post_Id'");
                             #gives the total number of likes
                             $getLikesNumNew=mysqli_num_rows($getLikes);

                             if($getLikesNumNew>0){
                              #incase the post is liked by only one person,the username of that person is displayed followed by :" likes the post"...
                              if($getLikesNumNew==1){

                                #fetching that like from the database/////////////////

                                $getLikesRow=mysqli_fetch_assoc($getLikes);

                                #the line of code below fetches the id of the person liking the post
                                #the id will be compared to the phone in the register table(Table containing user accounts info) and the fetch the username and profile photo from the table

                                $phoneAccount=$getLikesRow['friendEmail'];
                                // echo the person who liked the post
                                $reg=mysqli_query($conn,"SELECT * FROM register WHERE id='$phoneAccount'");

                                $regRow=mysqli_fetch_assoc($reg);
                                #username of the person who liked the post
                                $fullName=$regRow['FirstName']." ".$regRow['LastName'];

                                #the line of code below displays the name of the person who likes the post.
                                
                                echo "<span style='color:blue;'>".$fullName."</span> likes the post";
                              }
                              elseif($getLikesNumNew>=1){
                                 #fetching that like from the database/////////////////

                                $getLikesRow=mysqli_fetch_assoc($getLikes);

                                #the line of code below fetches the id of the person liking the post
                                #the id will be compared to the phone in the register table(Table containing user accounts info) and the fetch the username and profile photo from the table

                                $phoneAccount=$getLikesRow['friendEmail'];
                                // echo the person who liked the post
                                $reg=mysqli_query($conn,"SELECT * FROM register WHERE id='$phoneAccount'");

                                $regRow=mysqli_fetch_assoc($reg);
                                #username of the person who liked the post
                                $fullName=$regRow['FirstName']." ".$regRow['LastName'];


                                #fetching likes from the database
                                $getLikesRow=mysqli_fetch_assoc($getLikes);
                                #account id of the person liking the post
                                $phoneAccountId=$getLikesRow['friendEmail'];
                                
                                $reg=mysqli_query($conn,"SELECT * FROM register WHERE phone='$phoneAccountId'");

                                $regRow=mysqli_fetch_assoc($reg);
                                #total number of likes less 1
                                $newNum=$getLikesNumNew-1;
                                #save the details of the first person who liked the post in the variable($uname)
                                $uname=$fullName;
                                #to avoid annoying the user,the two lines of code below ensure that grammatic rules are observed before displaying the result to the user.
                                if($newNum==1){
                                echo "liked by <span style='color:blue;'>".$uname."</span> and ".$newNum." other";
                              }elseif ($newNum>1) {
                               echo "liked by <span style='color:blue;'>".$uname."</span> and ".$newNum." others";
                              }
                              elseif ($newNum>=1000 && $newNum<1000000 ) {
                                // get a new num
                                $knum=$newNum/1000;
                               echo "liked by <span style='color:blue;'>".$uname."</span> and ".$knum."k others";
                              }
                              elseif ($newNum>=1000000 && $newNum<1000000000 ) {
                                // get a new num
                                $mnum=$newNum/1000000;
                               echo "liked by <span style='color:blue;'>".$uname."</span> and ".$mnum."m others";
                              }


                              }
                             }
                            ?>
                          </b></button>
                         

                        </form>
                          <!-- J Q U E R Y   C O D E    to display likes -->
                        <script type="text/javascript">
                            $(document).ready(function(){
                             // when the like button is cliked....
                            $("#l<?php echo $post_Id; ?>Display").click(function(){
                               var postname='<?php echo $post_Id; ?>';//value of the post Id                                         
                              $.ajax(
                                    {
                                      type    :   "post",
                                      url     :   "post_likes.php",
                                      data    :   {post_id:postname},
                                      success :   function(data){
                                        $('#showExtraLikes').html(data);                   
                      
                                       }
                                     }
                                 )
                              });
                           });
                        </script>
                         


               </div>
               <p style="width:98%;margin:auto;padding:4px;background:#eee;"></p> 
               <!-- end -->
               <?php
             }
           }
         }
             
             ?>
            
             

 
                
  </div>
 
</body>
</html>