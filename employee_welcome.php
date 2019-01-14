<?php
   	include_once("config_employee.php");
	do {
	echo "Select your action.....................!!! \n";
	echo " \n";
	echo "1 -> Create New Account \n";
	echo "2 -> Search customer \n";
	echo "3 -> Insert Loan Details \n";
	echo "Logout q \n";
	$res = readline("\n");
	if (strcasecmp("q",$res)==0){
		$res='q';
	}
	switch ($res) {
    case "1":
        echo "Enter Account details \n";
        break;
    case "2":
        echo "Who do you want to search ? \n";
	include("serach_customer.php");
        break;
    case "3":
        echo "Fill up loan details for customer \n";
        break;
    case "q":
        echo "Your are quiting \n";	
        break;
    default:
        echo "Enter valid action! \n";

	} 
	}while($res <> "q");
	
	session_destroy();
	include("login.php");
$db->close();

?>
