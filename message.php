<?php include "header.php"; 
$defaultProfilePhotoStudent='photos/default_photos/one.jpeg';

if(isset($_POST['to_inbox']))
{
  $student_id=$_POST['StudentID'];
  $_SESSION['StudentID']=$student_id;
 
    header('location:inbox.php');
 
  
}

?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
	
    #new_conversation{
      border: none;
      color:white;
      padding:5px;
      background:green;
      height:30px;
      border-radius:5px;
    }
    #con_con{
      margin:0 0 30% 0;
    }
    #all_users{
      position:absolute;
      position: fixed;
      margin-left:28%;
    }
    #messaging_container{
      height:90%;
      overflow-y: scroll;
    }
    #body_center{
      padding:10px !important;
    }
	</style>
</head>
<body>
<div id="all_users"></div>
<div id="body_center">

   
	   <div id="messaging_container">
        <div id="display_conversations">
           
         </div>
            
     </div>
       
</div>
   

<script type="text/javascript">
  $(document).ready(function(){
    
    $('#search').keyup(function(){
      var txt=$(this).val();
          if(txt!=""){
        
        $.ajax({
          url:"search_to_chat.php",
          method:"post",
          data:{search:txt},
          dataType:"text",
          success:function(data)
          {
            $('#messaging_container').html(data);
          }
        });
      }
      else{
        $('#messaging_container').html("");
      }
      
      
    });

    // display contacts to select
    $('#new_conversation').click(function(){
       $('#all_users').load("chat_students.php");
    });

    //load posts without refreshing
    setInterval(function(){
      $('#display_conversations').load('conversations.php');
    },500);

   
  });
</script>
</body>
</html>