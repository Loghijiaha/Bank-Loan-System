<?php
   include_once("config.php");
echo "Select your action.....................!!! \n";
echo " \n";
	
	do {
	echo "1 -> View Account Details \n";
	echo "2 -> Transfer Fund \n";
	echo "3 -> Apply Online Loan \n";
	echo "Logout q \n";
	$res = readline("\n");
	if (strcasecmp("q",$res)==0){
		$res='q';
	}
	switch ($res) {
    case "1":
        echo "Inquiry\n";
	echo "***********************************************************************************************\n";
	include("view_account_details.php");
        break;
    case "2":
        echo "Ready to transfer \n";
        echo "***********************************************************************************************\n";
	include("transfer_money.php");
        break;
    case "3":
        echo "You are now in loan section \n";
	echo "***********************************************************************************************\n";
	include("online_loan.php");
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

?>
