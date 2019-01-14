<?php
	do{
	echo "Select Employee type.....................!!! \n";
	echo " \n";
	echo "1 -> Staff \n";
	echo "2 -> Manager \n";
	
	$res = readline("\n");
	if (strcasecmp("q",$res)==0){
		$res='q';
	}
	switch ($res) {
    case "1":
        echo "Create staff Account \n";
	echo "-------------------------------------------------------------------------------------\n";
	$name = readline("Name: \n");
	$branch_code = readline("Branch code: \n");
	$department = readline("Department: \n");
	$stmt = $db->prepare("INSERT INTO Employee (name,branch_code,department) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $name, $branch_code, $department);
	$stmt->execute();
 	$stmt->close();
        break;
    case "2":
        echo "Create manager Account \n";
	echo "-------------------------------------------------------------------------------------\n";
	$name = readline("Name: \n");
	$branch_code = readline("Branch code: \n");
	$department = readline("Department: \n");
	$stmt = $db->prepare("INSERT INTO Manager VALUES (?, ?, ?)");
	$stmt = $db->prepare("INSERT INTO MyGuests (name,branch_code,department) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $name, $branch_code, $department);
	$stmt->execute();
 	$stmt->close();
  	 break;
    default:
        echo "Enter valid action! \n";

	} 
	
	}while($res <> "q");
	
	include("admin_welcome.php");


?>
