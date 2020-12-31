<?php
include "function.php";
if(isset($_POST['submit_email']) AND $_POST['email'])
{
    $email = $_POST['email'];
  //$conn = mysqli_connect('localhost','root','','yoapp');
  //mysqli_select_db('sample');
  $select= mysqli_query($conn,"SELECT email,password FROM user_login WHERE email ='$email'");
  if(mysqli_num_rows($select)==1)
  {
    while($row=mysqli_fetch_array($select))
    {
      $email=$row['email'];
      $pass=md5($row['password']);
    }
    $link="<a href=http://$_SERVER[HTTP_HOST]/shopping/reset_pass.php?key=".$email."&reset=".$pass."'>Click To Reset password</a>";
    require('vendor/autoload.php');
    $mail = new PHPMailer();
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    // enable SMTP authentication
    $mail->SMTPAuth = false;                  
    // GMAIL username
    $mail->Username = "info@yoappstore.com";
    // GMAIL password
    $mail->Password = "isoft@1209";
    $mail->SMTPSecure = "";  
    // sets GMAIL as the SMTP server
    $mail->Host = "webmail.isoftzone.com";
    // set the SMTP port for the GMAIL server
    $mail->Port = "25";
    $mail->From=$email;
    $mail->FromName='YoAppStore';
    $mail->AddAddress($email,'I AM WHOLE SALER');
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body    = 'Click On This Link to Reset Password '.$link.'';
    if($mail->Send())
    {
      echo "Check Your Email and Click on the link sent to your email";
    }
    else
    {
      echo "Mail Error - >".$mail->ErrorInfo;
    }
  }	
}
?>
