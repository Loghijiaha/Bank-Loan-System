<?php

	echo "1 -> Admin Usage \n";
	echo "2 -> User Usage \n";
	echo "Logout q \n";
	$res = readline("\n");
	if (strcasecmp("q",$res)==0){
		$res='q';
	}
	switch ($res) {
    case "1":
        echo "Admin panel \n";
	echo "-------------------------------------------------------------------------------------\n";
	include("admin_welcome.php");
        break;
    case "2":
        echo "User Panel \n";
	echo "-------------------------------------------------------------------------------------\n";
	include("login.php");
        break;
    case "q":
        echo "Your are quiting \n";
	echo "-------------------------------------------------------------------------------------\n";	
	exit();
        break;
    default:
        echo "Enter valid action! \n";

	} 

?>
