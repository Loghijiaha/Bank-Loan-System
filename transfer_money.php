<?php
 
/**
 * PHP MySQL Transaction Demo
 */


// test the transfer method
	echo "\n";
	echo "*********************************************************************************************\n";
	$to = readline("Tranferring account number: \n");
	$amount = readline("Amount: \n");
	$username=$_SESSION['login_user'];
	$sql = "SELECT account_number From Account WHERE (Account.customer_prefix,Account.customer_id) =(SELECT prefix,customer_id FROM 	Customer_Login where username='$username')";
	$result = $db->query($sql);
	echo "Select which Saving account from you want to transfer?\n";
	if ($result->num_rows > 0) {
	    $i=0;
	   
   	 while($row = $result->fetch_assoc()) {
			$i++;
 	      	 	echo "Acount\t".$i.": " .$row['account_number']."\n";
   	 }
	$obj = new Transaction();
	$account_number = readline("Saving acount number: \n");
	$obj->transfer((int)str_replace(' ', '',$account_number) , (int)str_replace(' ', '', $to), (int)str_replace(' ', '', $amount));
	
	}else {
   	 echo "O Saving account found\n";
	   	 echo "Transfer unsuccessfull............!\n";

}	
	include("user_welcome.php");
?>

