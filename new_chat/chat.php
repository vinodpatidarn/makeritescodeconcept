<?php include 'function.php';

if(isset($_POST['hiddenTOken']) AND !empty($_POST['hiddenTOken'])){
	$reciver = $_POST['hiddenTOken'];
	$sender = $_SESSION['token'];
	$msg = $_POST['msg'];
	$time = date("yy,m,d h:i:s A");


	$insert = mysqli_query($conn,"INSERT INTO chat(sender_token,reciver_token,massgae) VALUES('$sender','$reciver','$msg')") ;
	if(!empty($insert)){
		$data = '<div class="d-flex justify-content-end mb-4 new_massage"> <div class="msg_cotainer_send"> '.$msg.' <span class="msg_time_send">'.$time.'</span> </div> <div class="img_cont_msg"> <img src="https://pbs.twimg.com/profile_images/941594824917917696/kUMIKQwH_400x400.jpg" class="rounded-circle user_img_msg"> </div> </div>';
		return exit(json_encode(["response" => ["code" => '1', "msg" => 'Msg Send SuccessFully', "data" => $data]]));
	}else{
		return exit(json_encode(["response" => ["code" => '0', "msg" => 'Something Wents Wrong!']]));
	}

}
?>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!------ Include the above in your HEAD tag ---------->
<!DOCTYPE html>
<html>
	<head>
		<title>Chat</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
		
		<script>
				$(document).ready(function(){
$('#action_menu_btn').click(function(){
	$('.action_menu').toggle();
});
	});
		</script>
	<link rel="stylesheet" type="text/css" href="css.css">
	</head>
	<!--Coded With Love By Mutiullah Samim-->
	<body>
		<div class="container-fluid h-100">
			<div class="row justify-content-center h-100">
				<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
					<div class="card-header">
						<div class="input-group">
							<input type="text" placeholder="Search..." name="search" class="form-control search">
							<div class="input-group-prepend">
								<span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
							</div>
						</div>
					</div>
					
   
					<div class="card-body contacts_body">
						<?php 
						$sender_token = $_SESSION['token'];
					$userData = mysqli_query($conn,"SELECT * FROM user_resister WHERE token != $sender_token");
					    if(mysqli_num_rows($userData) > 0)
					    {
					   while($fetch = mysqli_fetch_array($userData)):
    
?>
						<ui class="contacts">
						<li class="active">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
									<span class="online_icon"></span>
								</div>
								<a href="chat.php?reciver_token=<?php echo $fetch['token']; ?>">
								<div class="user_info">
									<span><?php echo $fetch['username']; ?></span>
									<p>Kalid is online</p>
								</div>
							</a>
							</div>
						</li>
						</ui>
						<?php
                        endwhile;
                    }
					?>
					</div>
					

					<div class="card-footer"></div>
				</div></div>
				<?php
                         if(isset($_GET['reciver_token']) AND !empty($_GET['reciver_token']))
                         {
                           $reciver_token = $_GET['reciver_token'];
				           $data = mysqli_query($conn ,"SELECT * FROM user_resister WHERE token = '$reciver_token'");
				           if(mysqli_num_rows($data) > 0)
                           {
                           	$fetchUser=mysqli_fetch_array($data);

				?>

                         
				<div class="col-md-8 col-xl-6 chat">
					<div class="card">
						<div class="card-header msg_head">
							<div class="d-flex bd-highlight">
								
								<div class="img_cont">
									<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
									<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span>Chat with <?php echo $fetchUser['username']; ?> </span>
									<p></p>
								</div>
								<div class="video_cam">
									<span><i class="fas fa-video"></i></span>
									<span><i class="fas fa-phone"></i></span>
								</div>
							</div>
							<span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
							<div class="action_menu">
								<ul>
									<li><i class="fas fa-user-circle"></i><?php echo $_SESSION['username'];?></li>

									<li><a href="logout.php"><iclass="fa fa-sign-out"></i>logout</a></li>
								</ul>
							</div>
						</div>
				
						<div class="card-body msg_card_body scrolling">
							<?php 
                              $rows = mysqli_query($conn,"SELECT * FROM chat WHERE sender_token='$sender_token' AND reciver_token = '$reciver_token' OR sender_token='$reciver_token' AND reciver_token = '$sender_token'");
                              if(mysqli_num_rows($rows) > 0 )
                              {
                              	while($massage = mysqli_fetch_array($rows)){
                              		 if($massage['sender_token'] ==  $reciver_token)
                              		{
						?>       
							<div class="d-flex justify-content-start mb-4">
								<div class="img_cont_msg">
									<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
								</div>
								<div class="msg_cotainer">
								      <?php echo $massage['massgae'];?>
									<span class="msg_time"><?php echo $massage['created_date'];?></span>
								</div>
							</div>
							<?php 
						    }else{ ?>
							<div class="d-flex justify-content-end mb-4 new_massage">
								<div class="msg_cotainer_send">
									<?php echo $massage['massgae'];?>
									<span class="msg_time_send"><?php echo $massage['created_date'];?></span>
								</div>
								<div class="img_cont_msg">
							<img src="https://pbs.twimg.com/profile_images/941594824917917696/kUMIKQwH_400x400.jpg" class="rounded-circle user_img_msg">

								</div>

							</div>
						<?php }}} ?>
							
						</div>
						
                        
						<div class="card-footer">
 						<form method="POST" id='formdata'>
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
								</div>
								
								<input type="text" id="msg" name="msg" required="" class="form-control type_msg" placeholder="Type your message...">
								<div class="input-group-append">
									<span class="input-group-text send_btn" id="button"><i class="fas fa-location-arrow"></i></span>
								</div>
							   <input type="hidden" name="hiddenTOken" value="<?php echo $_GET['reciver_token']?>">
							</div>
							</form>
						</div>
	

					</div>
				</div>
			<?php }} ?>
			</div>
		</div>
	</body>
	<script type="text/javascript">

		
$(document).ready(function(e){

$(".msg_card_body").animate({ scrollTop: $('.msg_card_body').get(0).scrollHeight }, 1);
  $(".send_btn").click(function(event) {
        var msg = $("#msg").val();
        if (msg != '') {
          $("#msgSubmit").submit();
        }else{
          swal("Oh Snap!", "Please Write Msg!", "warning");
        }
      });
	$(".send_btn").click(function(){
		$("#formdata").submit();
	});
	$("#formdata").submit(function(e){
	e.preventDefault();
	var formData = new FormData(this);
        $.ajax({
         	url :'chat.php?reciver_token=<?php echo $_GET["reciver_token"] ;?>',
         	type :'POST',
            data : formData,
            cache: false,
            dataType: 'json',
            contentType: false,
            processData: false,

              success:function(data){
              	console.log(data);
            	if(data.response.code = '1')
            	{
            		$(".msg_card_body").append(data.response.data);
            		$("#msg").val('');
            		$(".msg_card_body").animate({ scrollTop: $('.msg_card_body').get(0).scrollHeight }, 1); 
            	}
            },
            error:function(data) {
                console.log("error");
                console.log(data);
            }
        });
    });

});

	</script>
</html>
