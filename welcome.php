<?php
   include_once('session.php');
	echo "Success.....!\n";

	switch ($_SESSION['type']) {
    case "manager":
        echo "\t \t \tWelcome Sir , " .strtoupper($_SESSION['login_user'])." \n";
	echo "-------********---------*********----------------*********---------- \n";
	include ("manager_welcome.php");
        break;
    case "employee":
	echo "\t \t \tWelcome Mr/Mrs " .strtoupper($_SESSION['login_user'])." \n";
	echo "-------********---------*********----------------*********---------- \n";
	include ("employee_welcome.php");
        break;
    case "customer":
        echo "\t \t \tWelcome to our customer portal " .strtoupper($_SESSION['login_user'])." \n";
	echo "-------********---------*********----------------*********---------- \n";
	include ("user_welcome.php");
        break;
    default:
        echo "Your are in other planet";
}
?>
