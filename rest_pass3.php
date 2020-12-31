<?php
include "function.php";
if($_GET['key'])
{
  $email=$_GET['key'];
 // echo $email;
  $pass=$_GET['reset'];
  //$conn = mysqli_connect('localhost','root','','yoapp');
  //mysql_select_db('sample');
  
  $select=mysqli_query($conn,"SELECT email,password from user_login WHERE email='$email' and md5(password)='$pass'");
//   print_r(mysqli_num_rows($select));
  if(mysqli_num_rows($select)==1)
  {
    ?>
   <link href="assets/css/phppot-style.css" type="text/css"
	rel="stylesheet" />
<link href="assets/css/user-registration.css" type="text/css"
	rel="stylesheet" />
<script src="vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</HEAD>
<BODY>
	<div class="phppot-container">
		<div class="sign-up-container">
			<div class="">
				<form name="reset-password" action="submit_new.php" method="post"
					onsubmit="return resetPasswordValidation()">
					<div class="signup-heading">Reset Password</div>
<?php
if (! empty($displayMessage["status"])) {
    if ($displayMessage["status"] == "error") {
        ?>
				    <div class="server-response error-msg"><?php echo $displayMessage["message"]; ?></div>
<?php
    } else if ($displayMessage["status"] == "success") {
        ?>
                    <div class="server-response success-msg"><?php echo $displayMessage["message"]; ?></div>
<?php
    }
}
?>
				<div class="error-msg" id="error-msg"></div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Password<span class="required error" id="forgot-password-info"></span>
							</div>
							<input type="hidden" name="email" value="<?php echo $email;?>">
							<input class="input-box-330" type="password" name="password"
								id="password" required>
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Confirm Password<span class="required error"
									id="confirm-password-info"></span>
							</div>
							<input class="input-box-330" type="password"
								name="confirm-password" id="confirm-password" required>
						</div>
					</div>
					<div class="row">
						<input class="btn" type="submit" style="background-color:red;color:white" name="submit_password" id="reset-btn"
							value="Reset Password">
					</div>
				</form>
			</div>
		</div>
	</div>
</BODY>
<script>
function resetPasswordValidation() {
	var valid = true;
	$("#password").removeClass("error-field");
	$("#confirm-password").removeClass("error-field");

	var Password = $('#password').val();
    var ConfirmPassword = $('#confirm-password').val();

	if (Password.trim() == "") {
		$("#forgot-password-info").html("required.").css("color", "#ee0000").show();
		$("#password").addClass("error-field");
		valid = false;
	}
	if (ConfirmPassword.trim() == "") {
		$("#confirm-password-info").html("required.").css("color", "#ee0000").show();
		$("#confirm-password").addClass("error-field");
		valid = false;
	}
	if(Password != ConfirmPassword){
        $("#error-msg").html("Both passwords must be same.").show();
        valid=false;
    }
	if (valid == false) {
		$('.error-field').first().focus();
		valid = false;
	}
	return valid;
}
</script>
	<?php

  }
}else{
	echo 'failed';
}
?>
