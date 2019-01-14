<?php
   error_reporting(E_ERROR | E_PARSE);
   include_once("config_employee.php");
   if(session_id() == '' || !isset($_SESSION)){
	   session_start();
	}
   $username = readline("Username: ");
   $passcode = readline("Passcode: ");

      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$username);
      $mypassword = mysqli_real_escape_string($db,$passcode); 
      
      $sql = "SELECT * FROM User_Login WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $type = $row['type'];
      $count = mysqli_num_rows($result);
      // If result matched $myusername and $mypassword, table row must be 1 row	
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
         $_SESSION['type'] = $type;
	echo "-------------------------------------------------------------------------------------\n";
   	include("welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid\n";
	echo $error;
		session_destroy();
	   	include("bank.php");
      }
$db->close();
?>
