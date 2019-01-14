<?php
echo " \n";
	
	do {
	echo "1 -> View Saving Account Details \n";
	echo "2 -> View Current Account Details \n";
	echo "Quit q \n";
	$res = readline("\n");
	if (strcasecmp("q",$res)==0){
		$res='q';
	}
	$username=$_SESSION['login_user'];
	
	switch ($res) {
    case "1":
        echo "Saving Account Details \n";
	echo "********************************************************************\n";
        echo "**********************************************************************\n";
	$sql = "SELECT * From Account WHERE (Account.customer_prefix,Account.customer_id) =(SELECT prefix,customer_id FROM 	Customer_Login 		where username='$username') and Account.prefix='sav'";
	$result = $db->query($sql);
	if ($result->num_rows > 0) {
	    	$i=0;
		echo "Acount Number\tAcount Type\tBalance\n";
	        echo "-------------\t----------\t------------\n";
   	 	while($row = $result->fetch_assoc()) {
			$i++;
 	      	 	echo $row['account_number']."\t\t".
				"Saving Account\t".
				$row['account_balance']."\n";
        echo "**********************************************************************\n";
		
   	 	}
        echo "**********************************************************************\n";
	}else{
  		  echo "No saving Accounts";
        echo "**********************************************************************\n";
	}
	
        break;

    case "2":
        echo "Current Account Details \n";
	echo "************************************************************************\n";
        echo "**********************************************************************\n";
	$sql = "SELECT * From Account WHERE (Account.customer_prefix,Account.customer_id) =(SELECT prefix,customer_id FROM 	Customer_Login 		where username='$username') and Account.prefix='cur'";
	$result = $db->query($sql);
	if ($result->num_rows > 0) {
	    	$i=0;
		echo "Acount Number\tAcount Type\tBalance\n";
	        echo "-------------\t----------\t------------\n";
   	 	while($row = $result->fetch_assoc()) {
			$i++;
 	      	 	echo $row['account_number']."\t\t".
				"Saving Account\t".
				$row['account_balance']."\n";
        echo "**********************************************************************\n";
		
   	 	}
        echo "**********************************************************************\n";
	}else{
  		  echo "No Current Accounts\n";
        echo "**********************************************************************\n";
	}
        break;
    case "q":
        echo "Your are quiting \n";	
        echo "**********************************************************************\n";
	
        break;
    default:
        echo "Enter valid action! \n";

	} 
        echo "**********************************************************************\n";
	}while($res <> "q");
	

	include("user_welcome.php");
?>
