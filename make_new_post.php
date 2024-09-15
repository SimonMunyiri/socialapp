<?php include 'connection.php';

  
  //<!-- =============php code to make a new post============= -->

  
         //$id="notofications" ;          
          if(isset($_POST['submitpost'])){
             $description=$_POST['description'];
             $file=$_FILES['image'];
             $fileName=$_FILES['image']['name'];
             $fileTmpName=$_FILES['image']['tmp_name'];
             $fileSize=$_FILES['image']['size'];
             $fileError=$_FILES['image']['error'];
             $fileType=$_FILES['image']['type'];

             $fileExt=explode('.',$fileName);
             $fileActualExt=strtolower(end($fileExt));
             $allowed=array('jpg','jpeg','png','jfif');
             if($fileName==""){
             ?>
 
              <script>alert("Select an image");</script>
        
             <?php
              }
             else if(in_array($fileActualExt,$allowed)){
                if($fileError===0){
                    $fileNameNew=uniqid('',true).".".$fileActualExt;
                    // =================
                   //fetch deatails from database
                     $row=mysqli_fetch_assoc($select);
                     

                    $sql=mysqli_query($conn,"INSERT INTO posts(phone,photo,description)VALUES('$pname','$fileNameNew','$description')");
              

                          ?>
                    <script type="text/javascript">alert("Posted!!!");</script>
                         <?php
                       $fileDestination='posts/'.$fileNameNew;
                       move_uploaded_file($fileTmpName,$fileDestination);
                      }
                      
                       else{
                        ?>
                           <script type="text/javascript">alert("Not posted!!!");</script>
                        <?php
                       }   

                    }
                }
          
   
      




 ?>
<style type="text/css">
*{
  padding:0;
  margin:0;
  font-family:calibri;
}
#container{
   border:1px solid lightblue;
   background:white
}
#body_center_content{
  margin:10px;
  padding:10px;
}


	
	
</style>

<div id="container">
<p style="background:lightblue;padding:10px;"><b>Creating a new post</b></p>
  <div id="body_center_content">
    
 <table width="300">
      
      <tr>
        <td colspan="2">
          <form action="make_new_post.php" method="POST" enctype="multipart/form-data">
            <textarea name="description" placeholder="Add a text here..." style="width:300px;height:100px;border-radius:10px;border:1px dotted purple;padding:10px;"></textarea>
           
        </td>
      </tr>
      <tr><td colspan="2"><label><span class="fa fa-photo"></span> Add a photo<input style="display:none;" type="file" name="image"></label></td></tr>
      <tr>
        <td colspan="2">
           <input type="submit" name="">
        </td>
      </tr>
      </form>
  </table> 
</div>
<script type="text/javascript">
  $(document).ready(function(){

  });
</script>

