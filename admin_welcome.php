<?php

   include_once("config_admin.php");
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
      if($count == 1 && $type=='admin') {
        
	echo "-------------------------------------------------------------------------------------\n";
		do {
	echo "Welcome Admin.....................!!! \n";
	echo " \n";
	echo "1 -> Create customer \n";
	echo "2 -> Create employee \n";
	echo "Logout q \n";
	$res = readline("\n");
	if (strcasecmp("q",$res)==0){
		$res='q';
	}
	switch ($res) {
    case "1":
        echo " Create customer \n";
	echo "-------------------------------------------------------------------------------------\n";
	include("create_customer.php");
        break;
    case "2":
        echo "Create employee  \n";
	echo "-------------------------------------------------------------------------------------\n";
	include("create_employee.php");
        break;
    case "q":
        echo "Your are quiting \n";
		echo "-------------------------------------------------------------------------------------\n";	
        break;
    default:
        echo "Enter valid action! \n";

	} 
	}while($res <> "q");
	include("bank.php");


      }else {
         $error = "Your Login Name or Password is invalid \n";
	echo $error;
	include("bank.php");
      }
	
?>
