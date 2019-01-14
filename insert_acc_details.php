<?php

	echo "1 -> Saving Account\n";
	echo "2 -> Fixed Account\n";
	echo "Logout q \n";
	$res = readline("\n");

	switch ($res) {
    case "1":
        echo "Saving Account \n";
	echo "-------------------------------------------------------------------------------------\n";
	$res = readline("\n");
	$res = readline("\n");
	$stmt = $db->prepare("INSERT INTO  Savings(firstname, lastname, email) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $firstname, $lastname, $email);
        break;
    case "2":
        echo "Fixed Account \n";
	echo "-------------------------------------------------------------------------------------\n";
	$res = readline("\n");
	$res = readline("\n");
	// fixed acc
	$stmt = $db->prepare("INSERT INTO Fixeddeposit (firstname, lastname, email) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $firstname, $lastname, $email);

// set parameters and execute
$stmt->execute();
$stmt->close();
        break;
    case "q":
        echo "Your are quiting \n";
		echo "-------------------------------------------------------------------------------------\n";	
        break;
    default:
        echo "Enter valid action! \n";

	}
	
$stmt->close()
?>
