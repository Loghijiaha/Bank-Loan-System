<?php
	include_once("config_manager.php");
	
	do {
	echo "Select your action.....................!!! \n";
	echo " \n";
	echo "1 -> View Loan details and Approoval \n";
	echo "2 -> Search customer \n";
	echo "3 -> View online transaction report \n";
	echo "Logout q \n";
	$res = readline("\n");
	if (strcasecmp("q",$res)==0){
		$res='q';
	}
	switch ($res) {
    case "1":
        echo "Latest loan applications \n";
	echo "-------------------------------------------------------------------------------------\n";
	include("view_loan_details.php");
        break;
    case "2":
        echo "Who do u want to search Sir ? \n";
	echo "-------------------------------------------------------------------------------------\n";
	include("search_customer.php");
        break;
    case "3":
        echo "Online transaction report \n";
	echo "------------------------------------------------------------------------------------\n";
	$sql = "SELECT * from online_tra_rep";
	$result = $db->query($sql);

	if ($result->num_rows > 0) {
	 echo"Total Online transaction\n";
	echo "------------------------------------------------------------------------------------\n";
   	 $row = $result->fetch_assoc();
 	 echo $row['ot']."\n";
   	 }
	$sql = "SELECT * from atm_tra_rep";

	$result = $db->query($sql);

	if ($result->num_rows > 0) {
	 echo"Total Atm transaction\n";
	echo "------------------------------------------------------------------------------------\n";
   	 $row = $result->fetch_assoc();
 	 echo $row['ot']."\n";
   	 }
	$sql = "SELECT * from Branch_Report_Online";
	$result = $db->query($sql);
	echo "Branch wise Online report\n";
echo "------------------------------------------------------------------------------------\n";
	if ($result->num_rows > 0) {
	    $i=0;
	   
   	 while($row = $result->fetch_assoc()) {
			$i++;
 	      	 	echo "Report \t".$i.": " .$row."\n";
   	 }
}
$sql = "SELECT * from Branch_Report_Online";
	$result = $db->query($sql);
	echo "Branch wise ATM report\n";
echo "------------------------------------------------------------------------------------\n";
	if ($result->num_rows > 0) {
	    $i=0;
	   
   	 while($row = $result->fetch_assoc()) {
			$i++;
 	      	 	echo "Report \t".$i.": " .$row."\n";
   	 }
}
        break;
    case "q":
        echo "Your are quiting \n";
		echo "-------------------------------------------------------------------------------------\n";	
        break;
    default:
        echo "Enter valid action! \n";

	} 
	}while($res <> "q");
	
	session_destroy();
	include("login.php");
	$db->close();

?>
