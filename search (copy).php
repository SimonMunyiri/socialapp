<?php include("header.php"); ?>
               
            </div><br/>
             

<style type="text/css">
    body{
    	background:#eee;
    }
	#container{
      width:400px;
      margin:auto;
      padding:20px;
      background:white;
	}
	#previous_searches ul{
		list-style:none;
	}
	#mode_hidden{
		font-size:10px;
		color:gray;
	}
	#active{
		height:10px;
		width:10px;
		background:purple;
		position:absolute;
		border-radius:50%;
		margin-left:38px;
		margin-top:38px;
	}
</style>
<body>
<div id="container">
  <p style="background:lightblue;padding:8px;border-radius:5px;">Search phone number or name.</p><br>
<form enctype="multipart/form-data">
	<input type="search" style="width:100%;height:30px;" id="search" placeholder="Search name or phone number">
	
</form>
<br><hr><br>




<div id="search_results"></div>

<script type="text/javascript">
  $(document).ready(function(){
    
    $('#search').keyup(function(){
      var txt=$(this).val();
          if(txt!=""){
        
        $.ajax({
          url:"php_search.php",
          method:"post",
          data:{search:txt},
          dataType:"text",
          success:function(data)
          {
            $('#search_results').html(data);
          }
        });
      }
      else{
        $('#search_results').html('Type a name or phone number to search...');
      }
      
      
    });
  });
</script>


</body>