<?php
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select username from User_Login where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['login_user'])){
	include("login.php");
   }
?>
