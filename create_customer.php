<?php
	do {
	echo "Logout q \n";
	echo " Address \n";
	$number= readline("No: \n");
	$road_name= readline("Road name: \n");
	$city= readline("City: \n");
	$phone_number= readline("Phone number: \n");
	$stmt = $db->prepare("INSERT INTO Customer(number,road_name,city,phone_number) VALUES (?, ?, ?,?)");
	$stmt->bind_param("ssss", $number, $road_name, $city,$phone_number);
	$stmt->execute();
	$stmt->close();
	$sql = 'SELECT fields FROM table ORDER BY id DESC LIMIT 1';
	$result = $db->query($sql);

	if ($result->num_rows > 0) {
	$customer_id=$row['customer_id'];
   	 }
	}

	echo "Select Customer type.....................!!! \n";
	echo " \n";
	echo "1 -> Indivudual \n";
	echo "2 -> Organization \n";
	
	$res = readline("\n");
	if (strcasecmp("q",$res)==0){
		$res='q';
	}
	switch ($res) {
    case "1":
        echo "Individual \n";
	echo "-------------------------------------------------------------------------------------\n";
	$firstname = readline("First name: \n");
	$lastname = readline("Last name: \n");
	$dob = readline("Date of birth: \n");
	$age = readline("Age: \n");
	$nationility = readline("Nationility: \n");
	$stmt = $db->prepare("INSERT INTO Individual VALUES (?, ?, ?,?)");
	$stmt->bind_param("sssss",$customer_id, $firstname, $lastname, $dob,$age,$nationality);
	$stmt->execute();
	$stmt->close();
	echo "1 -> Adult \n";
	echo "2 -> Child \n";
	$adOrChi = readline("\n");
		switch ($adOrChi) {
   	 case "1":
   	     echo "Adult \n";
	     echo "-------------------------------------------------------------------------------------\n";


	$NIC_no = readline("NIC number: \n");
	$stmt = $db->prepare("INSERT INTO Adult VALUES (?, ?)");
	$stmt->bind_param("ss", $customer_id, $NIC_no);
	$stmt->execute();
	$stmt->close();
   	     break;
   	 case "2":
   	     echo "Child \n";
		echo "-------------------------------------------------------------------------------------\n";

	$guardian_customer_id = readline("Guardian customer ID: \n");
	$stmt = $db->prepare("INSERT INTO Child VALUES (?, ?)");
	$stmt->bind_param("ss", $customer_id, $guardian_customer_id);
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
        break;
    case "2":
        echo "Organization\n";
	echo "-------------------------------------------------------------------------------------\n";
	$name= readline("Organization name: \n");
	$stmt = $db->prepare("INSERT INTO Organization VALUES (?, ?)");
	$stmt->bind_param("ss", $customer_id, $name);
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
	}while($res <> "q");
	include("admin_welcome.php");

?>
