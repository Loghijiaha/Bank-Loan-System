<?php
$sql = "SELECT * FROM Loan";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
echo "Loan id\tCustomer id\tPurpose\t      Amount\t       Period\t    Interest rate\t   No of installments\tApproved?\n" ;
echo "-------\t----------\t-------\t       ------\t       ------\t    --------------\t      ----------------\t-----------\n";
    while($row = $result->fetch_assoc()) {
       		 echo  $row["loan_id"].
		"\t" . $row["customer_id"].
	      	"\t        " . $row["purpose"].
	     	 "\t" . $row["loan_amount"].
	     	 "\t   " . $row["period"].
	     	 "\t    " . $row["interest_rate"].
	     	 "\t                       " . $row["no_of_installments"].
	   	   "\t         " . ($row["approved"] == 1 ? 'Yes' : 'No')."\n" ;
    }
} else {
    echo "No results\n";
}

$res = readline("Do you want to approve any loan ?  Press y if not press n \t\n");
	echo "-------------------------------------------------------------------------------------\n";
if ($res == "y"){
	
	$stmt = $db->prepare("UPDATE Loan SET approved=1 WHERE loan_id=?");
	$stmt->bind_param('s', $id);
	$id = readline("Loan id : \n");
	echo "-------------------------------------------------------------------------------------\n";
	/* Execute the prepared Statement */
	$status = $stmt->execute();
	/* BK: always check whether the execute() succeeded */
	if ($status === false) {
  	trigger_error($stmt->error, E_USER_ERROR);
	}
	printf("%d Row inserted.\n", $stmt->affected_rows);

}

?> 
