<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
include 'function.php';
if(isset($_POST['submit_password']) &&  $_POST['submit_password'])
{
  $email=$_POST['email'];
  $password = $_POST['password'];
  $pass=password_hash($password, PASSWORD_DEFAULT);
 // $conn = mysqli_connect('localhost','root','','yoapp');
  $select = mysqli_query($conn,"UPDATE user_login SET password = '$pass' WHERE email = '$email'");
  if(!empty($select)){
  //$select = mysqli_query($conn "UPDATE user_login SET password='$pass' WHERE email='$email'");
  header('location:index.php');
  
}
}
?>
